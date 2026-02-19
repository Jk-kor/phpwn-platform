<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
            🛒 Panier
        </h2>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:900px; margin:0 auto; padding:0 1.5rem;">

            @if(session('success'))
                <div class="alert-success" style="margin-bottom:1.5rem;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error" style="margin-bottom:1.5rem;">{{ session('error') }}</div>
            @endif

            @if($cartItems->count() > 0)
                <!-- Tableau panier -->
                <div class="glass-card" style="margin-bottom:1.5rem; overflow:hidden;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border);">
                                <th style="padding:0.75rem 1rem; text-align:left;" class="section-title">Challenge</th>
                                <th style="padding:0.75rem 1rem; text-align:left;" class="section-title">Catégorie</th>
                                <th style="padding:0.75rem 1rem; text-align:right;" class="section-title">Prix</th>
                                <th style="padding:0.75rem 1rem;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr style="border-bottom:1px solid var(--border);" onmouseover="this.style.background='rgba(0,255,136,0.03)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:1rem; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--text); font-size:0.9rem;">
                                    {{ $item->challenge->title }}
                                </td>
                                <td style="padding:1rem;">
                                    <span class="{{ ctfCatClass($item->challenge->category) }}">{{ $item->challenge->category }}</span>
                                </td>
                                <td style="padding:1rem; text-align:right; font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--green);">
                                    {{ number_format($item->challenge->price, 2) }} €
                                </td>
                                <td style="padding:1rem; text-align:right;">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none; border:none; color:#f85149; cursor:pointer; font-size:0.8rem; font-weight:700; font-family:'JetBrains Mono',monospace; padding:0.25rem 0.5rem; border-radius:4px; transition:all 0.2s;" onmouseover="this.style.background='rgba(248,81,73,0.1)'" onmouseout="this.style.background='none'">
                                            ✕ Retirer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="border-top:2px solid var(--border); background:rgba(0,255,136,0.03);">
                                <td colspan="2" style="padding:1rem; text-align:right; color:var(--text-muted); font-size:0.85rem; font-family:'JetBrains Mono',monospace; text-transform:uppercase; letter-spacing:0.08em;">
                                    Total
                                </td>
                                <td style="padding:1rem; text-align:right; font-family:'JetBrains Mono',monospace; font-size:1.4rem; font-weight:700; color:var(--green);">
                                    {{ number_format($total, 2) }} €
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Formulaire facturation -->
                <div class="glass-card" style="padding:1.75rem;">
                    <p class="section-title" style="margin-bottom:1.25rem;">🧾 Informations de facturation</p>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem; margin-bottom:1.5rem;">
                            <div>
                                <label style="display:block; margin-bottom:0.4rem;">Adresse</label>
                                <input type="text" name="billing_address" required placeholder="12 rue de la Paix"
                                    style="width:100%; padding:0.65rem 0.9rem; font-size:0.85rem;" />
                            </div>
                            <div>
                                <label style="display:block; margin-bottom:0.4rem;">Ville</label>
                                <input type="text" name="billing_city" required placeholder="Paris"
                                    style="width:100%; padding:0.65rem 0.9rem; font-size:0.85rem;" />
                            </div>
                            <div>
                                <label style="display:block; margin-bottom:0.4rem;">Code postal</label>
                                <input type="text" name="billing_zip" required placeholder="75001"
                                    style="width:100%; padding:0.65rem 0.9rem; font-size:0.85rem;" />
                            </div>
                        </div>
                        <div style="display:flex; justify-content:flex-end;">
                            <button type="submit" class="btn-green" style="padding:0.75rem 2rem; font-size:0.9rem;">
                                💳 Valider la commande
                            </button>
                        </div>
                    </form>
                </div>

            @else
                <div class="glass-card" style="text-align:center; padding:4rem 2rem;">
                    <div style="font-size:3rem; margin-bottom:1rem;">🛒</div>
                    <p style="color:var(--text-muted); font-family:'JetBrains Mono',monospace; font-size:0.95rem; margin-bottom:1.5rem;">
                        Votre panier est vide.
                    </p>
                    <a href="{{ route('home') }}" class="btn-green" style="padding:0.65rem 1.5rem; text-decoration:none; font-size:0.85rem;">
                        Explorer les challenges →
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>