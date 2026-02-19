<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
                👤 Mon Compte
            </h2>
            <span style="background:rgba(111,66,193,0.15); border:1px solid #6f42c1; color:#a78bfa; padding:0.2rem 0.6rem; border-radius:20px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700; text-transform:uppercase;">
                {{ $user->role }}
            </span>
        </div>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:1100px; margin:0 auto; padding:0 1.5rem; display:flex; flex-direction:column; gap:1.5rem;">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            {{-- Informations du compte --}}
            <div class="glass-card" style="padding:1.75rem;">
                <p class="section-title" style="margin-bottom:1.25rem;">🧑‍💻 Informations du compte</p>
                <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:1.25rem; margin-bottom:1.5rem;">
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Pseudo</div>
                        <div style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1.05rem; color:var(--green);">{{ $user->username }}</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Email</div>
                        <div style="font-size:0.9rem; color:var(--text);">{{ $user->email }}</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Niveau</div>
                        <div style="font-size:0.9rem; color:var(--text);">{{ $user->skill_level ?? 'Junior' }}</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Solde</div>
                        <div style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1.2rem; color:var(--green);">{{ number_format($user->balance, 2) }} €</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Score total</div>
                        <div style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:1.2rem; color:#58a6ff;">{{ $totalScore }} 🚩</div>
                    </div>
                    <div>
                        <div style="color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.3rem;">Bio</div>
                        <div style="font-size:0.85rem; color:var(--text-muted); line-height:1.5;">{{ $user->bio ?? 'Aucune bio renseignée.' }}</div>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn-dark" style="display:inline-block; padding:0.5rem 1.1rem; font-size:0.82rem; text-decoration:none;">
                    ✏️ Modifier mon profil
                </a>
            </div>

            {{-- Ajouter des crédits --}}
            <div class="glass-card" style="padding:1.75rem;">
                <p class="section-title" style="margin-bottom:1.25rem;">💰 Recharger mon solde</p>
                <form action="{{ route('account.addCredits') }}" method="POST" style="display:flex; align-items:flex-end; gap:1rem; flex-wrap:wrap;">
                    @csrf
                    <div>
                        <label style="display:block; color:var(--text-muted); font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.4rem;">Montant (€)</label>
                        <input type="number" name="amount" min="1" max="10000" step="1" value="100"
                            style="padding:0.65rem 0.9rem; font-size:0.9rem; width:140px; font-family:'JetBrains Mono',monospace;" />
                    </div>
                    <button type="submit" class="btn-green" style="padding:0.65rem 1.5rem; font-size:0.85rem;">
                        + Ajouter des crédits
                    </button>
                </form>
            </div>

            {{-- Challenges créés --}}
            <div class="glass-card" style="overflow:hidden;">
                <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                    <p class="section-title" style="margin:0;">🚩 Challenges créés</p>
                    <span style="color:var(--text-muted); font-size:0.8rem; font-family:'JetBrains Mono',monospace;">{{ $createdChallenges->count() }}</span>
                </div>
                @if($createdChallenges->isEmpty())
                    <div style="padding:2rem; color:var(--text-muted); font-size:0.85rem;">Vous n'avez pas encore créé de challenge.</div>
                @else
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border);">
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Titre</th>
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Catégorie</th>
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Prix</th>
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Actif</th>
                                <th style="padding:0.6rem 1.25rem;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($createdChallenges as $c)
                            <tr style="border-bottom:1px solid var(--border);" onmouseover="this.style.background='rgba(0,255,136,0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:0.85rem 1.25rem; font-family:'JetBrains Mono',monospace; font-weight:700; font-size:0.88rem; color:var(--text);">{{ $c->title }}</td>
                                <td style="padding:0.85rem 1.25rem;"><span class="{{ ctfCatClass($c->category) }}">{{ $c->category }}</span></td>
                                <td style="padding:0.85rem 1.25rem; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--green);">{{ number_format($c->price, 2) }} €</td>
                                <td style="padding:0.85rem 1.25rem; font-family:'JetBrains Mono',monospace; font-size:0.85rem; color:{{ $c->is_active ? 'var(--green)' : '#f85149' }};">
                                    {{ $c->is_active ? '● Actif' : '● Inactif' }}
                                </td>
                                <td style="padding:0.85rem 1.25rem; text-align:right; white-space:nowrap;">
                                    <a href="{{ route('challenges.show', $c->id) }}" style="color:var(--green); font-size:0.8rem; text-decoration:none; margin-right:0.75rem;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Voir</a>
                                    <a href="{{ route('challenges.edit', $c->id) }}" style="color:#ffaa00; font-size:0.8rem; text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Modifier</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- Challenges achetés --}}
            <div class="glass-card" style="overflow:hidden;">
                <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                    <p class="section-title" style="margin:0;">🛒 Challenges achetés</p>
                    <span style="color:var(--text-muted); font-size:0.8rem; font-family:'JetBrains Mono',monospace;">{{ $purchasedChallenges->count() }}</span>
                </div>
                @if($purchasedChallenges->isEmpty())
                    <div style="padding:2rem; color:var(--text-muted); font-size:0.85rem;">Vous n'avez encore acheté aucun challenge.</div>
                @else
                    <div style="padding:1.25rem; display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:1rem;">
                        @foreach($purchasedChallenges as $item)
                            @if($item->challenge)
                            <a href="{{ route('challenges.show', $item->challenge->id) }}"
                                style="display:block; border:1px solid var(--border); border-radius:8px; padding:1rem; text-decoration:none; transition:all 0.2s;"
                                onmouseover="this.style.borderColor='var(--green)'; this.style.background='rgba(0,255,136,0.04)'"
                                onmouseout="this.style.borderColor='var(--border)'; this.style.background='transparent'">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                                    <span class="{{ ctfCatClass($item->challenge->category) }}">{{ $item->challenge->category }}</span>
                                    <span class="{{ ctfDiffClass($item->challenge->difficulty) }}" style="font-size:0.7rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ $item->challenge->difficulty }}</span>
                                </div>
                                <p style="font-family:'JetBrains Mono',monospace; font-weight:700; font-size:0.88rem; color:var(--text); margin:0.5rem 0 0.25rem;">{{ $item->challenge->title }}</p>
                                <p style="font-family:'JetBrains Mono',monospace; font-size:0.82rem; color:var(--green); margin:0;">{{ number_format($item->price, 2) }} €</p>
                            </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Factures récentes --}}
            <div class="glass-card" style="overflow:hidden;">
                <div style="padding:1.25rem 1.5rem; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                    <p class="section-title" style="margin:0;">🧾 Factures récentes</p>
                    <a href="{{ route('invoices.index') }}" style="color:var(--green); font-size:0.8rem; text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Voir toutes →</a>
                </div>
                @if($invoices->isEmpty())
                    <div style="padding:2rem; color:var(--text-muted); font-size:0.85rem;">Aucune facture pour le moment.</div>
                @else
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border);">
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Date</th>
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Montant</th>
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Statut</th>
                                <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Adresse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr style="border-bottom:1px solid var(--border);" onmouseover="this.style.background='rgba(0,255,136,0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:0.85rem 1.25rem; font-family:'JetBrains Mono',monospace; font-size:0.82rem; color:var(--text-muted);">{{ $invoice->created_at->format('d/m/Y H:i') }}</td>
                                <td style="padding:0.85rem 1.25rem; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--green);">{{ number_format($invoice->total_amount, 2) }} €</td>
                                <td style="padding:0.85rem 1.25rem;">
                                    @if($invoice->status === 'paid' || $invoice->status === 'completed')
                                        <span style="background:rgba(0,255,136,0.1); border:1px solid var(--green); color:var(--green); padding:0.2rem 0.6rem; border-radius:20px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ ucfirst($invoice->status) }}</span>
                                    @else
                                        <span style="background:rgba(255,170,0,0.1); border:1px solid #ffaa00; color:#ffaa00; padding:0.2rem 0.6rem; border-radius:20px; font-size:0.72rem; font-family:'JetBrains Mono',monospace; font-weight:700;">{{ ucfirst($invoice->status) }}</span>
                                    @endif
                                </td>
                                <td style="padding:0.85rem 1.25rem; font-size:0.78rem; color:var(--text-muted);">
                                    {{ $invoice->billing_address ? $invoice->billing_address . ', ' . $invoice->billing_zip . ' ' . $invoice->billing_city : '—' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
