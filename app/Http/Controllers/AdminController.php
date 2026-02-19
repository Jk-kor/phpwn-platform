<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Challenge;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // middleware inline pour vérifier le role (admin / creator)
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! in_array($user->role, ['admin', 'creator'])) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        $challenges = Challenge::orderBy('id', 'desc')->get();
        return view('admin.index', compact('users', 'challenges'));
    }

    public function toggleBan(User $user)
    {
        // Ne pas permettre de se bannir soi-même
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas vous bannir vous-même.');
        }

        $user->is_banned = ! (bool) $user->is_banned;
        $user->save();
        return back();
    }

    public function toggleAdmin(User $user)
    {
        // Ne pas permettre de modifier son propre statut
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas changer votre propre statut.');
        }

        // Si creator, ne pas modifier
        if ($user->role === 'creator') {
            return back()->with('error', 'Impossible de modifier un creator.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();
        return back();
    }

    public function toggleChallenge(Challenge $challenge)
    {
        $challenge->is_active = ! (bool) $challenge->is_active;
        $challenge->save();
        return back();
    }
}
