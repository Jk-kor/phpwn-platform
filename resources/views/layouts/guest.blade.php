<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'PHPWN') }}</title>

        <!-- Polices -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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
            * { box-sizing: border-box; }
            body {
                background: var(--bg);
                color: var(--text);
                font-family: 'Inter', 'JetBrains Mono', monospace;
                min-height: 100vh;
                margin: 0;
            }
            /* Ligne décorative top */
            body::before {
                content: '';
                display: block;
                height: 3px;
                background: linear-gradient(90deg, var(--green), #00d4ff, #6f42c1);
                position: fixed;
                top: 0; left: 0; right: 0;
                z-index: 9999;
            }
            /* Inputs */
            input, select, textarea {
                background: var(--bg3) !important;
                border: 1px solid var(--border) !important;
                color: var(--text) !important;
                border-radius: 6px;
            }
            input:focus, select:focus, textarea:focus {
                border-color: var(--green) !important;
                outline: none !important;
                box-shadow: 0 0 0 2px rgba(0,255,136,0.15) !important;
            }
            input::placeholder { color: var(--text-muted) !important; }
            label { color: var(--text-muted) !important; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
            /* Bouton principal */
            button[type="submit"], .btn-primary {
                background: var(--green) !important;
                color: #0d1117 !important;
                font-weight: 700 !important;
                border: none !important;
                border-radius: 6px;
                cursor: pointer;
                font-family: 'JetBrains Mono', monospace;
                transition: all 0.2s;
            }
            button[type="submit"]:hover, .btn-primary:hover {
                background: var(--green-dim) !important;
                box-shadow: 0 0 16px rgba(0,255,136,0.35);
                transform: translateY(-1px);
            }
            a { color: var(--green); }
            a:hover { color: var(--green-dim); }
            /* Erreur input */
            .text-red-600, .text-red-500 { color: #f85149 !important; }
            .text-sm.text-gray-600, .text-sm.text-gray-400 { color: var(--text-muted) !important; }
            /* Checkbox */
            input[type="checkbox"] {
                accent-color: var(--green);
                border-color: var(--border) !important;
                background: var(--bg3) !important;
            }
        </style>
    </head>
    <body>
        <div style="min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding: 2rem 1rem; padding-top: 3rem;">

            <!-- Logo / Titre -->
            <a href="/" style="text-decoration:none; margin-bottom:2rem; display:block; text-align:center;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:2rem; font-weight:700; color:var(--green); letter-spacing:0.05em;">
                    🚩 PHPWN
                </div>
                <div style="font-size:0.75rem; color:var(--text-muted); letter-spacing:0.15em; margin-top:0.25rem;">
                    CTF BUG BOUNTY PLATFORM
                </div>
            </a>

            <!-- Carte formulaire -->
            <div style="
                width: 100%;
                max-width: 420px;
                background: var(--bg2);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 2rem;
                box-shadow: 0 0 40px rgba(0,255,136,0.08);
            ">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
