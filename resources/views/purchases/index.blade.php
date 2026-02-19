<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
                🧾 Mes achats
            </h2>
            <span style="color:var(--text-muted); font-size:0.8rem; font-family:'JetBrains Mono',monospace;">
                {{ $challenges->count() }} challenge(s)
            </span>
        </div>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:1000px; margin:0 auto; padding:0 1.5rem;">

            @if($challenges->isEmpty())
                <div class="glass-card" style="padding:4rem 2rem; text-align:center;">
                    <div style="font-size:3rem; margin-bottom:1rem;">🛒</div>
                    <p style="color:var(--text-muted); font-size:1rem; font-family:'JetBrains Mono',monospace; margin-bottom:1rem;">
                        Vous n'avez acheté aucun challenge pour le moment.
                    </p>
                    <a href="{{ route('home') }}" class="btn-green" style="display:inline-block; padding:0.6rem 1.4rem; font-size:0.85rem; text-decoration:none;">
                        Explorer les challenges →
                    </a>
                </div>
            @else
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    @foreach($challenges as $challenge)
                    <div class="glass-card" style="padding:1.25rem 1.5rem;">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; flex-wrap:wrap;">

                            <div style="flex:1; min-width:0;">
                                <div style="display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap; margin-bottom:0.4rem;">
                                    <a href="{{ route('challenges.show', $challenge->id) }}"
                                        style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1rem; color:var(--text); text-decoration:none;"
                                        onmouseover="this.style.color='var(--green)'" onmouseout="this.style.color='var(--text)'">
                                        {{ $challenge->title }}
                                    </a>
                                    @if($challenge->submissions && $challenge->submissions->isNotEmpty())
                                        <span style="background:rgba(0,255,136,0.15); border:1px solid var(--green); color:var(--green); padding:0.15rem 0.55rem; border-radius:20px; font-size:0.68rem; font-family:'JetBrains Mono',monospace; font-weight:700;">
                                            ✓ Résolu
                                        </span>
                                    @endif
                                </div>
                                <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.5rem;">
                                    <span class="{{ ctfCatClass($challenge->category) }}">{{ $challenge->category }}</span>
                                    <span class="{{ ctfDiffClass($challenge->difficulty) }}" style="font-size:0.7rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ $challenge->difficulty }}</span>
                                </div>
                                <p style="color:var(--text-muted); font-size:0.82rem; margin:0; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $challenge->description }}
                                </p>
                                @if($challenge->submissions && $challenge->submissions->isNotEmpty())
                                    <div style="color:var(--text-muted); font-size:0.75rem; font-family:'JetBrains Mono',monospace; margin-top:0.4rem;">
                                        Résolu le {{ \Carbon\Carbon::parse($challenge->submissions->first()->submitted_at)->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                            </div>

                            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:0.75rem; flex-shrink:0;">
                                <div style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1.1rem; color:var(--green);">
                                    {{ number_format($challenge->price, 2) }} €
                                </div>
                                <div style="display:flex; gap:0.5rem;">
                                    <a href="{{ route('challenges.show', $challenge->id) }}"
                                        class="btn-dark"
                                        style="padding:0.4rem 0.85rem; font-size:0.78rem; text-decoration:none;">
                                        Voir
                                    </a>
                                    <a href="{{ route('challenges.download', $challenge->id) }}"
                                        class="btn-green"
                                        style="padding:0.4rem 0.85rem; font-size:0.78rem; text-decoration:none;">
                                        ⬇ Télécharger
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
