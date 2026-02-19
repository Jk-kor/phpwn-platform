<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InvoiceItem;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Response;

class ChallengeController extends Controller
{
    /**
     * Page principale — liste des challenges actifs
     */
    public function index()
    {
        // Récupérer uniquement les challenges actifs, par ordre chronologique inverse
        $challenges = Challenge::with('author')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('welcome', compact('challenges'));
    }

    /**
     * Afficher le formulaire de création de challenge
     */
    public function create()
    {
        return view('challenges.create');
    }

    /**
     * Enregistrer un nouveau challenge en base de données
     */
    public function store(Request $request)
    {
        // 1. Validation (vérification des champs obligatoires)
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'difficulty' => 'required|string',
            'price' => 'required|numeric|min:0',
            'flag_hash' => 'required|string',
            'description' => 'required|string',
            'challenge_file' => 'nullable|file|mimes:zip,tar,gz,txt,pdf,exe,bin|max:20480',
        ]);

        // Traitement du fichier uploadé
        $filePath = null;
        if ($request->hasFile('challenge_file')) {
            // Stockage sécurisé dans storage/app/challenges (non accessible publiquement)
            $filePath = $request->file('challenge_file')->store('challenges');
        }

        // 2. Sauvegarde dans la base de données
        Challenge::create([
            'title' => $request->title,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'price' => $request->price,
            'flag_hash' => hash('sha256', $request->flag_hash),
            'description' => $request->description,
            'author_id' => Auth::id(),
            'image_url' => 'default.png',
            'file_path' => $filePath,
            'is_active' => true,
        ]);

        // 3. Redirection vers la page principale après succès
        return redirect()->route('home')->with('success', 'Challenge créé avec succès !');
    }

    /**
     * Afficher la page de détail d'un challenge (description, téléchargement, soumission de flag)
     */
    public function show(Request $request, $id)
    {
        $challenge = Challenge::with('author')->findOrFail($id);

        // Bloquer l'accès aux challenges inactifs pour les non-admins
        if (! $challenge->is_active && (! $request->user() || $request->user()->role !== 'admin')) {
            abort(404);
        }

        $purchased = false;
        $userSolved = false;
        if ($request->user()) {
            $purchased = InvoiceItem::where('challenge_id', $challenge->id)
                ->whereHas('invoice', function ($q) use ($request) {
                    $q->where('user_id', $request->user()->id)->whereIn('status', ['paid', 'completed']);
                })->exists();

            $userSolved = \App\Models\Submission::where('challenge_id', $challenge->id)
                ->where('user_id', $request->user()->id)
                ->where('is_valid', true)
                ->exists();
        }

        return view('challenges.show', compact('challenge', 'purchased', 'userSolved'));
    }

    /**
     * Téléchargement sécurisé du fichier de challenge (vérifie preuve d'achat)
     */
    public function download(Request $request, $id)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $challenge = Challenge::findOrFail($id);

        $hasBought = InvoiceItem::where('challenge_id', $challenge->id)
            ->whereHas('invoice', function ($q) use ($user) {
                $q->where('user_id', $user->id)->whereIn('status', ['paid', 'completed']);
            })->exists();

        if (! $hasBought) {
            abort(403);
        }

        if (! $challenge->file_path || ! Storage::exists($challenge->file_path)) {
            abort(404);
        }

        return Storage::download($challenge->file_path, basename($challenge->file_path));
    }

    /**
     * Soumission d'un flag. Vérifie achat, empêche double scoring.
     */
    public function submitFlag(Request $request, $id)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $request->validate(['flag' => 'required|string']);

        $challenge = Challenge::findOrFail($id);

        // Vérifier achat
        $hasBought = InvoiceItem::where('challenge_id', $challenge->id)
            ->whereHas('invoice', function ($q) use ($user) {
                $q->where('user_id', $user->id)->whereIn('status', ['paid', 'completed']);
            })->exists();

        if (! $hasBought) {
            abort(403);
        }

        // Empêcher double scoring
        $alreadySolved = Submission::where('user_id', $user->id)
            ->where('challenge_id', $challenge->id)
            ->where('is_valid', true)
            ->exists();

        if ($alreadySolved) {
            return back()->with('info', 'Vous avez déjà résolu ce challenge.');
        }

        $submitted = $request->input('flag');
        $isValid = hash('sha256', $submitted) === $challenge->flag_hash;

        Submission::create([
            'user_id' => $user->id,
            'challenge_id' => $challenge->id,
            'flag_submitted' => $submitted,
            'is_valid' => $isValid,
            'submitted_at' => now(),
        ]);

        if ($isValid) {
            return back()->with('success', 'Flag correct — bien joué !');
        }

        return back()->with('error', 'Flag incorrect.');
    }

    /**
     * Show edit form (author only)
     */
    public function edit(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);
        if (Auth::id() !== $challenge->author_id) {
            abort(403);
        }
        return view('challenges.edit', compact('challenge'));
    }

    /**
     * Update challenge (author only)
     */
    public function update(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);
        if (Auth::id() !== $challenge->author_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'difficulty' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'challenge_file' => 'nullable|file|mimes:zip,tar,gz,txt,pdf,exe,bin|max:20480',
        ]);

        // handle optional file replacement
        if ($request->hasFile('challenge_file')) {
            // delete old file if exists
            if ($challenge->file_path && Storage::exists($challenge->file_path)) {
                Storage::delete($challenge->file_path);
            }
            $challenge->file_path = $request->file('challenge_file')->store('challenges');
        }

        $challenge->title = $request->title;
        $challenge->category = $request->category;
        $challenge->difficulty = $request->difficulty;
        $challenge->price = $request->price;
        $challenge->description = $request->description;
        $challenge->is_active = $request->has('is_active');
        $challenge->save();

        return redirect()->route('challenges.show', $challenge->id)->with('success', 'Challenge updated.');
    }

    /**
     * Delete challenge (author only)
     */
    public function destroy(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);
        if (Auth::id() !== $challenge->author_id) {
            abort(403);
        }

        if ($challenge->file_path && Storage::exists($challenge->file_path)) {
            Storage::delete($challenge->file_path);
        }

        $challenge->delete();
        return redirect()->route('home')->with('success', 'Challenge supprimé.');
    }
}