<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
            👤 Profil de {{ $user->username }}
        </h2>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:800px; margin:0 auto; padding:0 1.5rem; display:flex; flex-direction:column; gap:1.5rem;">

            {{-- Infos publiques --}}
            <div class="glass-card" style="padding:1.75rem;">
                <p class="section-title" style="margin-bottom:1.25rem;">Informations publiques</p>
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:1.25rem;">
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Pseudo</div>
                        <div style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1.1rem; color:var(--green);">{{ $user->username }}</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Niveau</div>
                        <div style="font-size:0.9rem; color:var(--text);">{{ $user->skill_level ?? 'Junior' }}</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Rôle</div>
                        <div>
                            @if($user->role === 'admin')
                                <span style="background:rgba(218,54,51,0.15); border:1px solid #da3633; color:#f85149; padding:0.2rem 0.6rem; border-radius:20px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">ADM</span>
                            @elseif($user->role === 'creator')
                                <span style="background:rgba(111,66,193,0.15); border:1px solid #6f42c1; color:#a78bfa; padding:0.2rem 0.6rem; border-radius:20px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">CR</span>
                            @else
                                <span style="background:var(--bg3); border:1px solid var(--border); color:var(--text-muted); padding:0.2rem 0.6rem; border-radius:20px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ ucfirst($user->role) }}</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Challenges résolus</div>
                        <div style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1.2rem; color:#58a6ff;">{{ $solvedCount }} 🚩</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Bio</div>
                        <div style="font-size:0.85rem; color:var(--text-muted); line-height:1.5;">{{ $user->bio ?? 'Aucune bio.' }}</div>
                    </div>
                </div>
            </div>

            {{-- Challenges créés --}}
            <div class="glass-card" style="padding:1.75rem;">
                <p class="section-title" style="margin-bottom:1.25rem;">🚩 Challenges créés ({{ $createdChallenges->count() }})</p>
                @if($createdChallenges->isEmpty())
                    <p style="color:var(--text-muted); font-size:0.85rem;">Cet utilisateur n'a pas encore créé de challenge.</p>
                @else
                    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:1rem;">
                        @foreach($createdChallenges as $c)
                        <a href="{{ route('challenges.show', $c->id) }}"
                            style="display:block; border:1px solid var(--border); border-radius:8px; padding:1rem; text-decoration:none; transition:all 0.2s;"
                            onmouseover="this.style.borderColor='var(--green)'; this.style.background='rgba(0,255,136,0.04)'"
                            onmouseout="this.style.borderColor='var(--border)'; this.style.background='transparent'">
                            <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                                <span class="{{ ctfCatClass($c->category) }}">{{ $c->category }}</span>
                                <span class="{{ ctfDiffClass($c->difficulty) }}" style="font-size:0.7rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ $c->difficulty }}</span>
                            </div>
                            <p style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:0.88rem; color:var(--text); margin:0.5rem 0 0.25rem;">{{ $c->title }}</p>
                            <p style="font-family:'JetBrains Mono',monospace; font-size:0.82rem; color:var(--green);">{{ number_format($c->price, 2) }} €</p>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
