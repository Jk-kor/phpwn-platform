<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
                ⚙️ Administration
            </h2>
            <div style="color:var(--text-muted); font-size:0.8rem; font-family:'JetBrains Mono',monospace;">
                Gérez les utilisateurs et les challenges
            </div>
        </div>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 1.5rem; display:flex; flex-direction:column; gap:1.5rem;">

            {{-- Tableau utilisateurs --}}
            <div class="glass-card" style="overflow:hidden;">
                <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                    <p class="section-title" style="margin:0;">Utilisateurs</p>
                    <span style="color:var(--text-muted); font-size:0.8rem; font-family:'JetBrains Mono',monospace;">Total: {{ $users->count() }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border);">
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">ID</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Username</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Email</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Rôle</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Banni</th>
                                <th style="padding:0.6rem 1rem; text-align:right;" class="section-title">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr style="border-bottom:1px solid var(--border);" onmouseover="this.style.background='rgba(0,255,136,0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:0.85rem 1rem; font-family:'JetBrains Mono',monospace; font-size:0.8rem; color:var(--text-muted);">{{ $user->id }}</td>
                                <td style="padding:0.85rem 1rem; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--green); font-size:0.88rem;">{{ $user->username }}</td>
                                <td style="padding:0.85rem 1rem; font-size:0.85rem; color:var(--text-muted);">{{ $user->email }}</td>
                                <td style="padding:0.85rem 1rem;">
                                    @if($user->role === 'admin')
                                        <span style="background:rgba(218,54,51,0.15); border:1px solid #da3633; color:#f85149; padding:0.2rem 0.5rem; border-radius:4px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">ADM</span>
                                    @elseif($user->role === 'creator')
                                        <span style="background:rgba(111,66,193,0.15); border:1px solid #6f42c1; color:#a78bfa; padding:0.2rem 0.5rem; border-radius:4px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">CR</span>
                                    @else
                                        <span style="background:var(--bg3); border:1px solid var(--border); color:var(--text-muted); padding:0.2rem 0.5rem; border-radius:4px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ ucfirst($user->role) }}</span>
                                    @endif
                                </td>
                                <td style="padding:0.85rem 1rem; font-family:'JetBrains Mono',monospace; font-size:0.85rem;">
                                    @if($user->is_banned)
                                        <span style="color:#f85149;">● Oui</span>
                                    @else
                                        <span style="color:var(--text-muted);">Non</span>
                                    @endif
                                </td>
                                <td style="padding:0.85rem 1rem; text-align:right; white-space:nowrap;">
                                    <form action="{{ route('admin.users.toggleBan', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @if($user->is_banned)
                                            <button type="submit" style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid var(--green); background:rgba(0,255,136,0.1); color:var(--green); margin-right:0.3rem;">Débannir</button>
                                        @else
                                            <button type="submit" style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid #ffaa00; background:rgba(255,170,0,0.1); color:#ffaa00; margin-right:0.3rem;">Bannir</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('admin.users.toggleAdmin', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @if($user->role === 'admin')
                                            <button type="submit" style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid var(--border); background:rgba(139,148,158,0.1); color:var(--text-muted); margin-right:0.3rem;">Retirer admin</button>
                                        @else
                                            <button type="submit" style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid #6f42c1; background:rgba(111,66,193,0.15); color:#a78bfa; margin-right:0.3rem;">Promouvoir</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('admin.users.resetBalance', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Réinitialiser le solde de {{ $user->username }} ?')"
                                            style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid #da3633; background:rgba(218,54,51,0.1); color:#f85149;">
                                            Reset solde
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tableau challenges --}}
            <div class="glass-card" style="overflow:hidden;">
                <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                    <p class="section-title" style="margin:0;">Challenges</p>
                    <span style="color:var(--text-muted); font-size:0.8rem; font-family:'JetBrains Mono',monospace;">Total: {{ $challenges->count() }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border);">
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">ID</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Titre</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Catégorie</th>
                                <th style="padding:0.6rem 1rem; text-align:left;" class="section-title">Actif</th>
                                <th style="padding:0.6rem 1rem; text-align:right;" class="section-title">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($challenges as $c)
                            <tr style="border-bottom:1px solid var(--border);" onmouseover="this.style.background='rgba(0,255,136,0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:0.85rem 1rem; font-family:'JetBrains Mono',monospace; font-size:0.8rem; color:var(--text-muted);">{{ $c->id }}</td>
                                <td style="padding:0.85rem 1rem; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--text); font-size:0.88rem;">{{ $c->title }}</td>
                                <td style="padding:0.85rem 1rem;"><span class="{{ ctfCatClass($c->category) }}">{{ $c->category }}</span></td>
                                <td style="padding:0.85rem 1rem; font-family:'JetBrains Mono',monospace; font-size:0.85rem;">
                                    @if($c->is_active)
                                        <span style="color:var(--green);">● Actif</span>
                                    @else
                                        <span style="color:#f85149;">● Inactif</span>
                                    @endif
                                </td>
                                <td style="padding:0.85rem 1rem; text-align:right;">
                                    <form action="{{ route('admin.challenges.toggleActive', $c) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @if($c->is_active)
                                            <button type="submit" style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid #f85149; background:rgba(248,81,73,0.1); color:#f85149;">Désactiver</button>
                                        @else
                                            <button type="submit" style="padding:0.3rem 0.65rem; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; border-radius:4px; cursor:pointer; border:1px solid var(--green); background:rgba(0,255,136,0.1); color:var(--green);">Activer</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
