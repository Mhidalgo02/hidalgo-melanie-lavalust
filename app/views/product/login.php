<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #140b28;
            --bg-mid: #2b1a4c;
            --accent-cyan: #8fe3ea;
            --accent-violet: #b58bdb;
            --glass-fill: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.16);
            --text-primary: #f5f3fb;
            --text-muted: #b3accf;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Manrope', sans-serif;
            color: var(--text-primary);
            background:
                radial-gradient(circle at 15% 20%, #4a2a70, transparent 55%),
                radial-gradient(circle at 85% 80%, #1f3f63, transparent 55%),
                linear-gradient(160deg, var(--bg-deep), var(--bg-mid) 60%, var(--bg-deep));
            overflow: hidden;
            position: relative;
        }

        body::before,
        body::after {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.45;
            z-index: 0;
            pointer-events: none;
        }

        body::before {
            background: var(--accent-violet);
            top: -140px;
            left: -120px;
            animation: drift1 22s ease-in-out infinite alternate;
        }

        body::after {
            background: var(--accent-cyan);
            bottom: -160px;
            right: -120px;
            animation: drift2 26s ease-in-out infinite alternate;
        }

        @keyframes drift1 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(60px, 40px);
            }
        }

        @keyframes drift2 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-50px, -60px);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            body::before,
            body::after {
                animation: none;
            }
        }

        .login-box {
            position: relative;
            isolation: isolate;
            z-index: 1;
            width: min(420px, 90vw);
            padding: 52px 44px 44px;
            border-radius: 28px;
            background: var(--glass-fill);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            box-shadow:
                0 20px 60px rgba(20, 8, 40, 0.45),
                inset 0 1px 0 rgba(255, 255, 255, 0.18);
            overflow: hidden;
        }

        /* etched hairline texture + top-left light sweep, like a pane of etched glass */
        .login-box::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 12% 8%, rgba(255, 255, 255, 0.35), transparent 40%),
                repeating-linear-gradient(115deg,
                    rgba(255, 255, 255, 0.05) 0px,
                    rgba(255, 255, 255, 0.05) 1px,
                    transparent 1px,
                    transparent 14px);
            opacity: 0.55;
            pointer-events: none;
            z-index: 0;
        }

        /* a small etched fern motif in the corner, like traditional etched glass panels */
        .login-box::after {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            right: -22px;
            bottom: -22px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Cg fill='none' stroke='white' stroke-width='1.2' stroke-linecap='round'%3E%3Cpath d='M180 190 C 160 150, 150 120, 140 80'/%3E%3Cpath d='M150 130 C 130 120, 115 118, 100 110'/%3E%3Cpath d='M160 105 C 140 100, 128 95, 115 85'/%3E%3Cpath d='M168 75 C 152 72, 140 65, 130 55'/%3E%3Cpath d='M145 118 C 150 105, 148 95, 152 82'/%3E%3Ccircle cx='140' cy='80' r='2'/%3E%3C/g%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.16;
            pointer-events: none;
            z-index: 0;
        }

        .login-box h1,
        .login-box form {
            position: relative;
            z-index: 1;
        }

        .login-box h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 1.9rem;
            letter-spacing: -0.01em;
            margin: 0 0 28px;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            font-family: 'Manrope', sans-serif;
            font-size: 0.95rem;
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 12px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .form-group input::placeholder {
            color: rgba(245, 243, 251, 0.35);
        }

        .form-group input:focus {
            border-color: var(--accent-cyan);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(143, 227, 234, 0.15);
        }

        .btn {
            width: 100%;
            padding: 13px 16px;
            margin-top: 8px;
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            color: #15102a;
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-violet));
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            box-shadow: 0 8px 24px rgba(143, 227, 234, 0.25);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(143, 227, 234, 0.35);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn:focus-visible {
            outline: 2px solid var(--accent-cyan);
            outline-offset: 3px;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 40px 26px;
                border-radius: 22px;
            }

            .login-box h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <div class="container login-box">
        <h1>Login</h1>

        <form method="post" action="<?= site_url('/'); ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Log In</button>
        </form>
    </div>
</body>

</html>