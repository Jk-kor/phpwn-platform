<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Afficher la vue de demande de lien de r?initialisation du mot de passe.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * G?rer une demande de lien de r?initialisation du mot de passe entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

    // Nous enverrons le lien de réinitialisation du mot de passe à cet utilisateur. Une fois que nous aurons tenté
    // d'envoyer le lien, nous examinerons la réponse puis verrons le message que nous
    // devons afficher à l'utilisateur. Enfin, nous enverrons une réponse appropriée.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
