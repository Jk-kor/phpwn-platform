<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Affiche le profil d'un utilisateur.
     * Sans paramètre : profil de l'utilisateur connecté (privé).
     * Avec ?id=X : profil public d'un autre utilisateur.
     */
    public function show(Request $request)
    {
        $id = $request->query('id');

        // Profil public d'un autre utilisateur
        if ($id && $id != Auth::id()) {
            $user = User::findOrFail($id);

            $createdChallenges = $user->challenges()->where('is_active', true)->get();
            $solvedCount = $user->submissions()->where('is_valid', true)->count();

            return view('account.public', compact('user', 'createdChallenges', 'solvedCount'));
        }

        // Profil privé : utilisateur connecté
        $user = Auth::user();

        // Challenges créés par l'utilisateur
        $createdChallenges = $user->challenges()->orderByDesc('created_at')->get();

        // Challenges achetés (via factures complétées)
        $purchasedChallenges = InvoiceItem::whereHas('invoice', function ($q) use ($user) {
            $q->where('user_id', $user->id)->whereIn('status', ['paid', 'completed']);
        })->with('challenge')->get();

        // Factures
        $invoices = $user->invoices()->orderByDesc('created_at')->take(5)->get();

        // Score total : nombre de flags validés
        $totalScore = $user->submissions()->where('is_valid', true)->count();

        return view('account.index', compact(
            'user',
            'createdChallenges',
            'purchasedChallenges',
            'invoices',
            'totalScore'
        ));
    }

    /**
     * Ajouter des crédits au solde (simulation).
     */
    public function addCredits(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:10000',
        ]);

        $user = Auth::user();
        $user->balance += $request->amount;
        $user->save();

        return back()->with('success', number_format($request->amount, 2) . ' € ajoutés à votre solde !');
    }
}
