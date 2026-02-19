<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
            ✏️ Mon Profil
        </h2>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:800px; margin:0 auto; padding:0 1.5rem; display:flex; flex-direction:column; gap:1.5rem;">

            <div class="glass-card" style="padding:1.75rem;">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="glass-card" style="padding:1.75rem;">
                @include('profile.partials.update-password-form')
            </div>

            <div class="glass-card" style="padding:1.75rem;">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
