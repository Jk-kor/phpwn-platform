<nav x-data="{ open: false }" style="background:var(--bg2); border-bottom:1px solid var(--border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">

            {{-- Logo + liens gauche --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-mono font-bold text-lg" style="color:var(--green);">
                    🚩 PHPWN
                </a>

                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                       class="px-3 py-1.5 rounded-md text-sm font-medium"
                       style="{{ request()->routeIs('home') ? 'background:var(--bg3); color:var(--text);' : 'color:var(--text-muted);' }}">
                        Home
                    </a>
                    @auth
                        <a href="{{ route('purchases.index') }}"
                           class="px-3 py-1.5 rounded-md text-sm font-medium"
                           style="{{ request()->routeIs('purchases.*') ? 'background:var(--bg3); color:var(--text);' : 'color:var(--text-muted);' }}">
                            Ma bibliothèque
                        </a>
                        <a href="{{ route('challenges.create') }}"
                           class="px-3 py-1.5 rounded-md text-sm font-medium"
                           style="color:var(--text-muted);">
                            + Vendre
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Droite --}}
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    <span class="font-mono text-sm font-bold px-3 py-1 rounded-full"
                          style="background:rgba(0,255,136,0.1); color:var(--green); border:1px solid rgba(0,255,136,0.3);">
                        💰 {{ number_format(Auth::user()->balance, 2) }} €
                    </span>

                    <a href="{{ route('cart.index') }}"
                       class="px-3 py-1.5 rounded-md text-sm font-medium"
                       style="color:var(--text-muted); background:var(--bg3); border:1px solid var(--border);">
                        🛒
                    </a>

                    <x-dropdown align="right" width="52">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 px-3 py-1.5 rounded-md text-sm font-medium"
                                    style="background:var(--bg3); border:1px solid var(--border); color:var(--text);">
                                <span class="font-mono">{{ Auth::user()->username }}</span>
                                @if(Auth::user()->role === 'admin')
                                    <span class="text-xs font-bold px-1.5 py-0.5 rounded" style="background:#da3633; color:white;">ADM</span>
                                @elseif(Auth::user()->role === 'creator')
                                    <span class="text-xs font-bold px-1.5 py-0.5 rounded" style="background:#6f42c1; color:white;">CR</span>
                                @endif
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div style="background:var(--bg2); border:1px solid var(--border); border-radius:10px; min-width:200px; padding:4px 0; box-shadow:0 8px 32px rgba(0,0,0,0.5);">
                                <div style="padding:8px 16px; border-bottom:1px solid var(--border); margin-bottom:4px;">
                                    <div class="font-mono text-sm font-bold" style="color:var(--green);">{{ Auth::user()->username }}</div>
                                    <div class="text-xs" style="color:var(--text-muted);">{{ Auth::user()->email }}</div>
                                </div>

                                <a href="{{ route('account.show') }}" class="block px-4 py-2 text-sm" style="color:var(--text-muted);"
                                   onmouseover="this.style.background='rgba(0,255,136,0.06)';this.style.color='var(--text)';"
                                   onmouseout="this.style.background='';this.style.color='var(--text-muted)';">👤 Mon Compte</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm" style="color:var(--text-muted);"
                                   onmouseover="this.style.background='rgba(0,255,136,0.06)';this.style.color='var(--text)';"
                                   onmouseout="this.style.background='';this.style.color='var(--text-muted)';">✏️ Modifier le profil</a>
                                <a href="{{ route('invoices.index') }}" class="block px-4 py-2 text-sm" style="color:var(--text-muted);"
                                   onmouseover="this.style.background='rgba(0,255,136,0.06)';this.style.color='var(--text)';"
                                   onmouseout="this.style.background='';this.style.color='var(--text-muted)';">🧾 Historique d'achats</a>
                                <a href="{{ route('purchases.index') }}" class="block px-4 py-2 text-sm" style="color:var(--text-muted);"
                                   onmouseover="this.style.background='rgba(0,255,136,0.06)';this.style.color='var(--text)';"
                                   onmouseout="this.style.background='';this.style.color='var(--text-muted)';">📚 Ma bibliothèque</a>

                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'creator')
                                    <div style="border-top:1px solid var(--border); margin:4px 0;"></div>
                                    <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-sm font-bold" style="color:#ff7b72;"
                                       onmouseover="this.style.background='rgba(218,55,51,0.1)';"
                                       onmouseout="this.style.background='';">🛡️ Administration</a>
                                @endif

                                <div style="border-top:1px solid var(--border); margin:4px 0;"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm" style="color:var(--text-muted);"
                                            onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='var(--text)';"
                                            onmouseout="this.style.background='';this.style.color='var(--text-muted)';">
                                        🚪 Déconnexion
                                    </button>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="btn-dark text-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="btn-green text-sm">Inscription</a>
                @endauth
            </div>

            {{-- Hamburger mobile --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md" style="color:var(--text-muted);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden" style="border-top:1px solid var(--border);">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block py-2 text-sm" style="color:var(--text-muted);">Home</a>
            @auth
                <a href="{{ route('purchases.index') }}" class="block py-2 text-sm" style="color:var(--text-muted);">Ma bibliothèque</a>
                <a href="{{ route('challenges.create') }}" class="block py-2 text-sm" style="color:var(--text-muted);">+ Vendre</a>
            @endauth
        </div>
        @auth
            <div style="border-top:1px solid var(--border);" class="pt-4 pb-3 px-4">
                <div class="font-mono font-bold text-sm" style="color:var(--green);">{{ Auth::user()->username }}</div>
                <div class="text-xs mt-0.5" style="color:var(--text-muted);">{{ Auth::user()->email }}</div>
                <div class="font-bold text-sm mt-1" style="color:var(--green);">💰 {{ number_format(Auth::user()->balance, 2) }} €</div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('account.show') }}" class="block py-2 text-sm" style="color:var(--text-muted);">Mon Compte</a>
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-sm" style="color:var(--text-muted);">Modifier le profil</a>
                    <a href="{{ route('cart.index') }}" class="block py-2 text-sm" style="color:var(--text-muted);">🛒 Panier</a>
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'creator')
                        <a href="{{ route('admin.index') }}" class="block py-2 text-sm font-bold" style="color:#ff7b72;">Administration</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block py-2 text-sm w-full text-left" style="color:var(--text-muted);">Déconnexion</button>
                    </form>
                </div>
            </div>
        @else
            <div style="border-top:1px solid var(--border);" class="pt-4 pb-3 px-4 space-y-2">
                <a href="{{ route('login') }}" class="block py-2 text-sm" style="color:var(--text-muted);">Connexion</a>
                <a href="{{ route('register') }}" class="block py-2 text-sm font-bold" style="color:var(--green);">Inscription</a>
            </div>
        @endauth
    </div>
</nav>
