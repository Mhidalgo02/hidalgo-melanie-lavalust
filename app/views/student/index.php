<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,600;0,700;1,700;1,800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at center, #fbfbfa 0%, #e6e8eb 100%);
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* Milky White Card Container with Gold Accents */
        .dashboard-card {
            position: relative;
            background: linear-gradient(145deg, #ffffff 0%, #f4f5f7 100%);
            border-radius: 28px;
            padding: 44px 40px;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08),
                inset 0 1px 2px rgba(255, 255, 255, 0.9);
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: -2px;
            bottom: -2px;
            left: -2px;
            right: -2px;
            background: linear-gradient(135deg, #e5c158 0%, #d4af37 50%, #aa7c11 100%);
            border-radius: 30px;
            z-index: -1;
        }

        /* Luxury Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(180deg, #fefefe 0%, #f1f3f5 100%);
            color: #996515;
            border: 1px solid #d4af37;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 8px 16px;
            border-radius: 50px;
            margin-bottom: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .badge-icon {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #d4af37;
            border-radius: 50%;
            box-shadow: 0 0 8px #d4af37;
        }

        /* Clean Automotive Header Box */
        .header-title-wrapper {
            position: relative;
            background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);
            padding: 20px 24px;
            border-radius: 16px;
            border: 1px solid #c5a059;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            font-style: italic;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        h1 span {
            color: #d4af37;
            background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa7c11 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        /* Milky White Dynamic Button */
        .nav-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(180deg, #ffffff 0%, #f1f3f5 100%);
            padding: 8px 12px 8px 8px;
            border-radius: 50px;
            text-decoration: none;
            border: 1.5px solid #d4af37;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05),
                inset 0 1px 1px #ffffff;
            transition: all 0.3s ease;
        }

        .nav-button:hover {
            border-color: #aa7c11;
            background: linear-gradient(180deg, #faf6eb 0%, #ebdcb8 100%);
            box-shadow: 0 12px 25px rgba(212, 175, 55, 0.25);
            transform: translateY(-2px);
        }

        .start-emblem {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #d4af37 0%, #aa7c11 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(170, 124, 17, 0.3);
            transition: all 0.3s ease;
        }

        .start-emblem svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #ffffff;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .btn-text {
            font-size: 15px;
            font-weight: 800;
            font-style: italic;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #1e293b;
            margin-left: 12px;
            flex-grow: 1;
            text-align: center;
        }

        .chevrons {
            color: #d4af37;
            font-size: 18px;
            font-weight: 800;
            padding-right: 12px;
            transition: transform 0.3s ease;
        }

        .nav-button:hover .chevrons {
            transform: translateX(4px);
            color: #805b0d;
        }
    </style>
</head>

<body>
    <div class="dashboard-card">
        <div class="badge">
            <span class="badge-icon"></span>
            <span>Lab Activity | 3</span>
        </div>

        <div class="header-title-wrapper">
            <h1>Student <span>&lt;Portal&gt;</span></h1>
        </div>

        <p>Access your personal identification details, academic program, and active contact information.</p>

        <a href="<?= site_url('student/profile'); ?>" class="nav-button">
            <div class="start-emblem">
                <svg viewBox="0 0 24 24">
                    <path d="M12 10a2 2 0 0 0-2 2c0 1.1.9 2 2 2s2-.9 2-2a2 2 0 0 0-2-2zm0-4a6 6 0 0 0-6 6c0 2.2.9 4.2 2.3 5.7M12 2a10 10 0 0 0-10 10c0 3.3 1.3 6.4 3.5 8.7M16 12a4 4 0 0 0-8 0c0 1.1.4 2.1 1.2 2.8M18 12a6 6 0 0 0-2.3-4.7M19.7 17.7A9.9 9.9 0 0 0 22 12a10 10 0 0 0-4-8" />
                </svg>
            </div>
            <span class="btn-text">View Your Profile</span>
            <span class="chevrons">&gt;&gt;</span>
        </a>
    </div>
</body>

</html>