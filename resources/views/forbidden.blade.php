<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Ditemukan</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #0a0a0f;
            --surface: #12121a;
            --accent: #ff4d6d;
            --accent2: #ff8500;
            --text: #f0eee8;
            --muted: #4a4a5a;
            --grid: rgba(255,77,109,0.06);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Syne', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Grid background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: 0;
        }

        /* Glow blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            z-index: 0;
            animation: drift 12s ease-in-out infinite alternate;
        }
        .blob-1 { width: 500px; height: 500px; background: var(--accent); top: -100px; left: -100px; animation-delay: 0s; }
        .blob-2 { width: 400px; height: 400px; background: var(--accent2); bottom: -100px; right: -100px; animation-delay: -4s; }

        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(40px, 30px) scale(1.1); }
        }

        /* Noise overlay */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            background-size: 200px 200px;
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 2rem;
            max-width: 700px;
        }

        /* Giant 404 */
        .big-number {
            font-family: 'Space Mono', monospace;
            font-size: clamp(120px, 22vw, 220px);
            font-weight: 700;
            line-height: 0.9;
            letter-spacing: -8px;
            color: transparent;
            -webkit-text-stroke: 2px var(--muted);
            position: relative;
            user-select: none;
            animation: glitch 6s infinite;
        }

        .big-number::before,
        .big-number::after {
            content: '404';
            position: absolute;
            inset: 0;
            -webkit-text-stroke: 2px var(--accent);
            clip-path: polygon(0 0, 100% 0, 100% 35%, 0 35%);
        }
        .big-number::before {
            -webkit-text-stroke: 2px var(--accent);
            animation: glitch-top 6s infinite;
        }
        .big-number::after {
            -webkit-text-stroke: 2px var(--accent2);
            clip-path: polygon(0 65%, 100% 65%, 100% 100%, 0 100%);
            animation: glitch-bot 6s infinite;
        }

        @keyframes glitch {
            0%, 90%, 100% { transform: translate(0); }
            92% { transform: translate(-3px, 1px); }
            94% { transform: translate(3px, -1px); }
            96% { transform: translate(-2px, 2px); }
        }
        @keyframes glitch-top {
            0%, 90%, 100% { transform: translate(0); opacity: 1; }
            92% { transform: translate(5px, 0); opacity: 0.8; }
            94% { transform: translate(-5px, 0); opacity: 0.9; }
        }
        @keyframes glitch-bot {
            0%, 90%, 100% { transform: translate(0); opacity: 1; }
            93% { transform: translate(-4px, 0); opacity: 0.8; }
            95% { transform: translate(4px, 0); opacity: 0.9; }
        }

        .tag {
            display: inline-block;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            border: 1px solid var(--accent);
            padding: 5px 14px;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.8s 0.2s both;
        }

        h1 {
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
            animation: fadeUp 0.8s 0.4s both;
        }

        p {
            font-size: 1rem;
            color: #888;
            line-height: 1.7;
            max-width: 420px;
            margin: 0 auto 2.5rem;
            font-family: 'Space Mono', monospace;
            animation: fadeUp 0.8s 0.6s both;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeUp 0.8s 0.8s both;
        }

        .btn {
            font-family: 'Space Mono', monospace;
            font-size: 13px;
            letter-spacing: 1px;
            padding: 14px 28px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-block;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            clip-path: polygon(8px 0%, 100% 0%, calc(100% - 8px) 100%, 0% 100%);
        }
        .btn-primary:hover {
            background: #ff2244;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255,77,109,0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--muted);
        }
        .btn-secondary:hover {
            border-color: var(--text);
            transform: translateY(-2px);
        }

        /* Status bar */
        .status-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: var(--muted);
            border-top: 1px solid #1e1e28;
            background: rgba(10,10,15,0.8);
            backdrop-filter: blur(8px);
            z-index: 10;
        }
        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.2; }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .divider {
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
            margin: 1.2rem auto 1.8rem;
            animation: fadeUp 0.8s 0.3s both;
        }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="container">
        <div class="tag">Error 404</div>
        <div class="big-number">404</div>
        <div class="divider"></div>
        <h1>Halaman Tidak Ditemukan</h1>
        <p>
            Sepertinya halaman yang kamu cari sudah dipindah, dihapus,
            atau memang tidak pernah ada.
        </p>
        <div class="actions">
            <a href="{{ url('/') }}" class="btn btn-primary">← Kembali ke Beranda</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Halaman Sebelumnya</a>
        </div>
    </div>

    <div class="status-bar">
        <div class="status-dot"></div>
        <span>HTTP 404 · NOT_FOUND</span>
        <span style="margin-left: auto; opacity: 0.4">{{ request()->url() }}</span>
    </div>
</body>
</html>