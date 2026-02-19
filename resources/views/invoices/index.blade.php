<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
            🧾 Mes achats
        </h2>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:1000px; margin:0 auto; padding:0 1.5rem;">

            @if($invoices->count() === 0)
                <div class="glass-card" style="text-align:center; padding:4rem 2rem;">
                    <div style="font-size:3rem; margin-bottom:1rem;">🧾</div>
                    <p style="color:var(--text-muted); font-family:'JetBrains Mono',monospace; font-size:0.95rem; margin-bottom:1.5rem;">
                        Aucun achat pour le moment.
                    </p>
                    <a href="{{ route('home') }}" class="btn-green" style="padding:0.65rem 1.5rem; text-decoration:none; font-size:0.85rem;">
                        Explorer les challenges →
                    </a>
                </div>
            @else
                @foreach($invoices as $invoice)
                    <div class="glass-card" style="margin-bottom:1.5rem; overflow:hidden;">

                        <!-- En-tête facture -->
                        <div style="
                            padding:1rem 1.25rem;
                            border-bottom:1px solid var(--border);
                            display:flex; justify-content:space-between; align-items:center;
                            background:rgba(0,255,136,0.03);
                        ">
                            <div>
                                <div style="color:var(--text-muted); font-size:0.78rem; font-family:'JetBrains Mono',monospace;">
                                    {{ $invoice->created_at->format('d/m/Y H:i') }}
                                </div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:1.2rem; font-weight:700; color:var(--green);">
                                    {{ number_format($invoice->total_amount, 2) }} €
                                </div>
                                @if($invoice->billing_address)
                                    <div style="color:var(--text-muted); font-size:0.75rem; margin-top:0.25rem;">
                                        📍 {{ $invoice->billing_address }}, {{ $invoice->billing_zip }} {{ $invoice->billing_city }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                @if($invoice->status === 'paid' || $invoice->status === 'completed')
                                    <span style="background:rgba(0,255,136,0.1); border:1px solid var(--green); color:var(--green); padding:0.3rem 0.8rem; border-radius:20px; font-size:0.75rem; font-weight:700; font-family:'JetBrains Mono',monospace;">
                                        ✅ {{ ucfirst($invoice->status) }}
                                    </span>
                                @else
                                    <span style="background:rgba(255,170,0,0.1); border:1px solid #ffaa00; color:#ffaa00; padding:0.3rem 0.8rem; border-radius:20px; font-size:0.75rem; font-weight:700; font-family:'JetBrains Mono',monospace;">
                                        ⏳ {{ ucfirst($invoice->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Items -->
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr style="border-bottom:1px solid var(--border);">
                                    <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Challenge</th>
                                    <th style="padding:0.6rem 1.25rem; text-align:left;" class="section-title">Catégorie</th>
                                    <th style="padding:0.6rem 1.25rem; text-align:right;" class="section-title">Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $item)
                                <tr style="border-bottom:1px solid var(--border);" onmouseover="this.style.background='rgba(0,255,136,0.03)'" onmouseout="this.style.background='transparent'">
                                    <td style="padding:0.85rem 1.25rem; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--text); font-size:0.88rem;">
                                        {{ $item->challenge->title ?? 'Challenge supprimé' }}
                                    </td>
                                    <td style="padding:0.85rem 1.25rem;">
                                        @if($item->challenge)
                                            <span class="{{ ctfCatClass($item->challenge->category) }}">{{ $item->challenge->category }}</span>
                                        @else
                                            <span style="color:var(--text-muted);">—</span>
                                        @endif
                                    </td>
                                    <td style="padding:0.85rem 1.25rem; text-align:right; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--green);">
                                        {{ number_format($item->price, 2) }} €
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

                <div style="margin-top:1.5rem;">
                    {{ $invoices->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
