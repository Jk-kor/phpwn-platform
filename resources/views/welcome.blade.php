<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 style="font-family:'JetBrains Mono',monospace; font-size:1.1rem; font-weight:700; color:var(--green); letter-spacing:0.05em;">
                � CTF Challenges Marketplace
            </h2>
            <a href="{{ route('challenges.create') }}" class="btn-green" style="padding:0.5rem 1.1rem; font-size:0.85rem;">
                + Vendre un Challenge
            </a>
        </div>
    </x-slot>

    <div style="padding: 2.5rem 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 1.5rem;">

            @if(session('success'))
                <div class="alert-success" style="margin-bottom:1.5rem;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error" style="margin-bottom:1.5rem;">{{ session('error') }}</div>
            @endif

            <!-- Hero terminal -->
            <div style="
                background: var(--bg2);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 1.5rem 2rem;
                margin-bottom: 2.5rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.85rem;
                color: var(--text-muted);
                position: relative;
                overflow: hidden;
            ">
                <div style="position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--green),#00d4ff,#6f42c1);"></div>
                <span style="color:var(--green);">root@phpwn</span><span style="color:#6f42c1;">:</span><span style="color:#58a6ff;">~</span><span style="color:var(--text);">$</span>
                <span style="color:var(--text); margin-left:0.5rem;">ls challenges/ <span style="color:var(--green); animation: blink 1s step-end infinite;">▋</span></span>
                <div style="margin-top:0.5rem; color:var(--text-muted); font-size:0.78rem;">
                    Achète un challenge · Soumets le flag · Deviens légende
                </div>
            </div>

            <!-- Grille de challenges -->
            <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:1.5rem;">

                @forelse($challenges as $challenge)
                    <div class="glass-card" style="display:flex; flex-direction:column;">
                        <!-- Header coloré -->
                        <div style="
                            height: 6px;
                            background: linear-gradient(90deg, var(--green), #00d4ff);
                            border-radius: 10px 10px 0 0;
                            margin: -1px -1px 0 -1px;
                        "></div>

                        <div style="padding:1.25rem; flex:1; display:flex; flex-direction:column;">
                            <!-- Badges -->
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.75rem;">
                                <span class="{{ ctfCatClass($challenge->category) }}">{{ $challenge->category }}</span>
                                <span class="{{ ctfDiffClass($challenge->difficulty) }}" style="font-family:'JetBrains Mono',monospace; font-size:0.72rem; font-weight:700;">{{ $challenge->difficulty }}</span>
                            </div>

                            <!-- Titre -->
                            <h3 style="margin:0 0 0.5rem 0; font-family:'JetBrains Mono',monospace; font-size:0.95rem; font-weight:700;">
                                <a href="{{ route('challenges.show', $challenge->id) }}" style="color:var(--text); text-decoration:none;" onmouseover="this.style.color='var(--green)'" onmouseout="this.style.color='var(--text)'">
                                    {{ $challenge->title }}
                                </a>
                            </h3>

                            <!-- Description -->
                            <p style="color:var(--text-muted); font-size:0.82rem; margin:0 0 1rem 0; flex:1; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                {{ $challenge->description }}
                            </p>

                            <!-- Prix -->
                            <div style="font-family:'JetBrains Mono',monospace; font-size:1.3rem; font-weight:700; color:var(--green); margin-bottom:1rem;">
                                {{ number_format($challenge->price, 2) }} €
                            </div>

                            <!-- Bouton ajout panier -->
                            <form action="{{ route('cart.add', $challenge->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-green" style="width:100%; padding:0.6rem; font-size:0.85rem;">
                                    🛒 Ajouter au panier
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="grid-column:1/-1; text-align:center; padding:4rem 2rem;">
                        <div style="font-size:3rem; margin-bottom:1rem;">🚩</div>
                        <p style="color:var(--text-muted); font-size:1rem; font-family:'JetBrains Mono',monospace;">
                            Aucun challenge disponible pour le moment.
                        </p>
                        <p style="color:var(--green); font-size:0.85rem; margin-top:0.5rem;">
                            Soyez le premier à en vendre un !
                        </p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    @if(session('show_cart_modal'))
    <div style="
        position:fixed; inset:0; z-index:50;
        display:flex; align-items:center; justify-content:center;
        background:rgba(0,0,0,0.7); backdrop-filter:blur(4px);
        padding:1rem;
    ">
        <div style="
            background:var(--bg2);
            border:1px solid var(--green);
            border-radius:16px;
            padding:2rem;
            text-align:center;
            width:340px; max-width:90%;
            box-shadow: 0 0 40px rgba(0,255,136,0.25);
        ">
            <div style="
                width:56px; height:56px; border-radius:50%;
                background:rgba(0,255,136,0.1);
                border:2px solid var(--green);
                display:flex; align-items:center; justify-content:center;
                margin:0 auto 1rem;
                font-size:1.5rem;
            ">✅</div>

            <h3 style="font-family:'JetBrains Mono',monospace; font-size:1.1rem; font-weight:700; color:var(--green); margin:0 0 0.5rem;">
                Ajouté !
            </h3>
            <p style="color:var(--text-muted); font-size:0.85rem; margin:0 0 1.5rem;">
                Challenge ajouté à votre panier.
            </p>

            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                <a href="{{ route('cart.index') }}" class="btn-green" style="display:block; padding:0.75rem; text-decoration:none; font-size:0.9rem;">
                    💳 Passer commande
                </a>
                <a href="{{ route('home') }}" class="btn-dark" style="display:block; padding:0.75rem; text-decoration:none; font-size:0.9rem;">
                    🛍️ Continuer les achats
                </a>
            </div>
        </div>
    </div>
    @endif

    <style>
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
    </style>
</x-app-layout>