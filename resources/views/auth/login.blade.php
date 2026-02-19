<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <p style="font-family:'JetBrains Mono',monospace; font-size:0.85rem; color:var(--text-muted); margin:0 0 1.5rem; text-align:center; letter-spacing:0.05em;">
        Connectez-vous à votre compte
    </p>

    <form method="POST" action="{{ route('login') }}" style="display:flex; flex-direction:column; gap:1rem;">
        @csrf

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" style="width:100%; margin-top:0.35rem; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" style="width:100%; margin-top:0.35rem; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div style="display:flex; align-items:center; gap:0.5rem;">
            <input id="remember_me" type="checkbox" name="remember"
                style="width:16px; height:16px; border-radius:3px; flex-shrink:0;" />
            <label for="remember_me" style="font-size:0.8rem; color:var(--text-muted); text-transform:none; letter-spacing:0; cursor:pointer;">
                Se souvenir de moi
            </label>
        </div>

        <div style="display:flex; flex-direction:column; gap:0.75rem; margin-top:0.5rem;">
            <button type="submit" style="width:100%; padding:0.75rem; font-size:0.9rem; border-radius:6px; font-family:'JetBrains Mono',monospace; font-weight:700; background:var(--green); color:#0d1117; border:none; cursor:pointer; transition:all 0.2s;" onmouseover="this.style.background='var(--green-dim)'; this.style.boxShadow='0 0 16px rgba(0,255,136,0.35)'" onmouseout="this.style.background='var(--green)'; this.style.boxShadow='none'">
                ▶ Connexion
            </button>

            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.5rem;">
                <a href="{{ route('register') }}" style="font-size:0.8rem; color:var(--green); text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    Créer un compte →
                </a>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size:0.8rem; color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--text-muted)'">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
        </div>
    </form>
</x-guest-layout>