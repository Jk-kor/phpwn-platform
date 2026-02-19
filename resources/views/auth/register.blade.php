<x-guest-layout>
    <p style="font-family:'JetBrains Mono',monospace; font-size:0.85rem; color:var(--text-muted); margin:0 0 1.5rem; text-align:center; letter-spacing:0.05em;">
        Créer un compte PHPWN
    </p>

    <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:1rem;">
        @csrf

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" style="width:100%; margin-top:0.35rem; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" style="width:100%; margin-top:0.35rem; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" style="width:100%; margin-top:0.35rem; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" style="width:100%; margin-top:0.35rem; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div style="display:flex; flex-direction:column; gap:0.75rem; margin-top:0.5rem;">
            <button type="submit" style="width:100%; padding:0.75rem; font-size:0.9rem; border-radius:6px; font-family:'JetBrains Mono',monospace; font-weight:700; background:var(--green); color:#0d1117; border:none; cursor:pointer; transition:all 0.2s;" onmouseover="this.style.background='var(--green-dim)'; this.style.boxShadow='0 0 16px rgba(0,255,136,0.35)'" onmouseout="this.style.background='var(--green)'; this.style.boxShadow='none'">
                🚩 Créer mon compte
            </button>

            <div style="text-align:center;">
                <a href="{{ route('login') }}" style="font-size:0.8rem; color:var(--text-muted); text-decoration:none;" onmouseover="this.style.color='var(--green)'" onmouseout="this.style.color='var(--text-muted)'">
                    Déjà un compte ? Se connecter →
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>