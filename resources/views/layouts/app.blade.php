<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PHPWN') }}</title>

        <!-- Polices -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --green: #00ff88;
                --green-dim: #00cc6a;
                --bg: #0d1117;
                --bg2: #161b22;
                --bg3: #21262d;
                --border: #30363d;
                --text: #e6edf3;
                --text-muted: #8b949e;
            }
            body { background-color: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; }
            .font-mono { font-family: 'JetBrains Mono', monospace; }

            /* Scrollbar */
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: var(--bg2); }
            ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

            /* Glassmorphism card */
            .glass-card {
                background: rgba(22, 27, 34, 0.8);
                border: 1px solid var(--border);
                backdrop-filter: blur(12px);
                border-radius: 12px;
                transition: border-color 0.2s, box-shadow 0.2s;
            }
            .glass-card:hover { border-color: var(--green); box-shadow: 0 0 20px rgba(0, 255, 136, 0.08); }

            /* Glow button */
            .btn-green {
                background: var(--green);
                color: #0d1117;
                font-weight: 700;
                border-radius: 8px;
                padding: 8px 20px;
                transition: box-shadow 0.2s, background 0.2s;
            }
            .btn-green:hover { background: var(--green-dim); box-shadow: 0 0 16px rgba(0,255,136,0.4); }

            .btn-dark {
                background: var(--bg3);
                color: var(--text);
                font-weight: 600;
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 8px 20px;
                transition: border-color 0.2s, background 0.2s;
            }
            .btn-dark:hover { border-color: var(--green); background: rgba(0,255,136,0.05); }

            /* Badge couleurs */
            .badge-web      { background:#1f2d3d; color:#58a6ff; border:1px solid #1f6feb; }
            .badge-pwn      { background:#2d1f2d; color:#db61a2; border:1px solid #8957e5; }
            .badge-crypto   { background:#1f2d1f; color:#3fb950; border:1px solid #238636; }
            .badge-forensic { background:#2d2a1f; color:#e3b341; border:1px solid #9e6a03; }
            .badge-misc     { background:#2d1f1f; color:#ff7b72; border:1px solid #da3633; }

            .diff-noob    { color:#3fb950; font-weight:700; }
            .diff-mid     { color:#e3b341; font-weight:700; }
            .diff-hard    { color:#f97316; font-weight:700; }
            .diff-insane  { color:#ff7b72; font-weight:700; }

            /* Header bar verte */
            .top-bar { height: 3px; background: linear-gradient(90deg, #00ff88, #0d9488, #6366f1); }

            /* Inputs dark */
            input, textarea, select {
                background: var(--bg3) !important;
                border: 1px solid var(--border) !important;
                color: var(--text) !important;
                border-radius: 8px !important;
            }
            input:focus, textarea:focus, select:focus {
                border-color: var(--green) !important;
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(0,255,136,0.1) !important;
            }
            input::placeholder, textarea::placeholder { color: var(--text-muted) !important; }

            label { color: var(--text-muted) !important; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }

            /* Alert */
            .alert-success { background: rgba(35,134,54,0.2); border: 1px solid #238636; color: #3fb950; border-radius: 8px; padding: 12px 16px; }
            .alert-error   { background: rgba(218,55,51,0.2); border: 1px solid #da3633; color: #ff7b72; border-radius: 8px; padding: 12px 16px; }
            .alert-info    { background: rgba(31,111,235,0.2); border: 1px solid #1f6feb; color: #58a6ff; border-radius: 8px; padding: 12px 16px; }

            /* Table */
            table { width: 100%; border-collapse: collapse; }
            thead th { background: var(--bg3); color: var(--text-muted); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.08em; padding: 10px 16px; border-bottom: 1px solid var(--border); }
            tbody td { padding: 12px 16px; border-bottom: 1px solid var(--border); color: var(--text); font-size: 0.875rem; }
            tbody tr:hover td { background: rgba(255,255,255,0.02); }

            /* Section title */
            .section-title { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: var(--green); text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 8px; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="top-bar"></div>
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- En-tête de la page -->
            @isset($header)
                <header style="background:var(--bg2); border-bottom:1px solid var(--border);">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Contenu de la page -->
            <main>
                {{ $slot ?? '' }}
                @hasSection('content')
                    @yield('content')
                @endif
            </main>
        </div>
    </body>
</html>
