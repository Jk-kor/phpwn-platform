<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green); margin:0 0 0.25rem;">
                    {{ $challenge->title }}
                </h2>
                <div style="display:flex; gap:0.5rem; align-items:center;">
                    <span class="{{ ctfCatClass($challenge->category) }}">{{ $challenge->category }}</span>
                    <span class="{{ ctfDiffClass($challenge->difficulty) }}" style="font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ $challenge->difficulty }}</span>
                </div>
            </div>

            <div style="text-align:right;">
                @if(isset($userSolved) && $userSolved)
                    <span style="background:rgba(0,255,136,0.1); border:1px solid var(--green); color:var(--green); padding:0.25rem 0.75rem; border-radius:20px; font-size:0.8rem; font-weight:700; font-family:'JetBrains Mono',monospace;">
                        ✅ Résolu
                    </span>
                @endif
                <div style="font-family:'JetBrains Mono',monospace; font-size:1.3rem; font-weight:700; color:var(--green); margin-top:0.25rem;">
                    {{ number_format($challenge->price, 2) }} €
                </div>
                @auth
                    @if(Auth::id() === $challenge->author_id)
                        <div style="margin-top:0.5rem;">
                            <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn-dark" style="font-size:0.75rem; padding:0.3rem 0.75rem;">✏️ Modifier</a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:900px; margin:0 auto; padding:0 1.5rem;">
            <div style="display:grid; grid-template-columns:1fr 280px; gap:1.5rem;">

                <!-- Colonne principale -->
                <div class="glass-card" style="padding:1.75rem;">
                    @if(session('success'))
                        <div class="alert-success" style="margin-bottom:1rem;">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert-error" style="margin-bottom:1rem;">{{ session('error') }}</div>
                    @endif
                    @if(session('info'))
                        <div class="alert-info" style="margin-bottom:1rem;">{{ session('info') }}</div>
                    @endif

                    <p class="section-title" style="margin-bottom:0.75rem;">Description</p>
                    <p style="color:var(--text); line-height:1.7; font-size:0.9rem; margin:0 0 2rem;">{{ $challenge->description }}</p>

                    <p class="section-title" style="margin-bottom:0.75rem;">Soumettre un flag</p>
                    @auth
                        @if(isset($userSolved) && $userSolved)
                            <div style="
                                background:rgba(0,255,136,0.05);
                                border:1px solid var(--green);
                                border-radius:8px;
                                padding:1rem 1.25rem;
                                color:var(--green);
                                font-family:'JetBrains Mono',monospace;
                                font-size:0.85rem;
                            ">🏆 Vous avez déjà résolu ce challenge !</div>
                        @else
                            <form action="{{ route('challenges.submitFlag', $challenge->id) }}" method="POST">
                                @csrf
                                <div style="display:flex; gap:0.75rem; align-items:stretch;">
                                    <input type="text" name="flag" placeholder="flag{...}"
                                        style="flex:1; padding:0.65rem 1rem; font-family:'JetBrains Mono',monospace; font-size:0.9rem;" />
                                    <button type="submit" class="btn-green" style="padding:0.65rem 1.5rem; font-size:0.85rem; white-space:nowrap;">
                                        ▶ Soumettre
                                    </button>
                                </div>
                            </form>
                        @endif
                    @else
                        <div style="color:var(--text-muted); font-size:0.85rem;">
                            <a href="{{ route('login') }}">Connectez-vous</a> pour soumettre un flag.
                        </div>
                    @endauth
                </div>

                <!-- Sidebar -->
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    <div class="glass-card" style="padding:1.25rem;">
                        <p class="section-title" style="margin-bottom:1rem;">Ressources</p>
                        @auth
                            @if($purchased)
                                <a href="{{ route('challenges.download', $challenge->id) }}" class="btn-green" style="display:block; text-align:center; padding:0.65rem; text-decoration:none; font-size:0.85rem;">
                                    ⬇️ Télécharger les fichiers
                                </a>
                            @else
                                <div style="color:var(--text-muted); font-size:0.8rem; margin-bottom:0.75rem; line-height:1.5;">
                                    Achat requis pour accéder aux ressources.
                                </div>
                                <form action="{{ route('cart.add', $challenge->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-dark" style="width:100%; padding:0.6rem; font-size:0.8rem;">
                                        🛒 Acheter ce challenge
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-dark" style="display:block; text-align:center; padding:0.65rem; text-decoration:none; font-size:0.85rem;">
                                🔐 Se connecter
                            </a>
                        @endauth
                    </div>

                    <div class="glass-card" style="padding:1.25rem;">
                        <p class="section-title" style="margin-bottom:0.75rem;">Auteur</p>
                        <a href="{{ route('account.show', ['id' => $challenge->author_id]) }}"
                            style="font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--green); font-size:0.9rem; text-decoration:none;"
                            onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            {{ $challenge->author->username ?? 'Inconnu' }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media(max-width:700px) {
            div[style*="grid-template-columns:1fr 280px"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-app-layout>
