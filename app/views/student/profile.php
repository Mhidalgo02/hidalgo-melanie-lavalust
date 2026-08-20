<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile Summary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;1,700;1,800&display=swap" rel="stylesheet">
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
            padding: 40px 16px;
        }

        /* Shell Container */
        .profile-container {
            position: relative;
            background: linear-gradient(145deg, #ffffff 0%, #f4f5f7 100%);
            border-radius: 28px;
            max-width: 800px;
            width: 100%;
            padding: 36px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08),
                inset 0 1px 2px rgba(255, 255, 255, 0.9);
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .profile-container::before {
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

        /* Nav Header */
        .nav-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            color: #1e293b;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 30px;
            border: 1px solid #d4af37;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: linear-gradient(180deg, #faf6eb 0%, #ebdcb8 100%);
            transform: translateY(-2px);
            color: #805b0d;
        }

        .id-badge {
            background: #0f172a;
            color: #d4af37;
            border: 1px solid #c5a059;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 30px;
            letter-spacing: 0.05em;
        }

        /* Profile Asymmetric Layout */
        .profile-wrapper {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 28px;
        }

        /* Left Side Card */
        .user-summary-card {
            background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);
            border-radius: 20px;
            padding: 28px 20px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 1px solid #c5a059;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .avatar-box {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: radial-gradient(circle at center, #d4af37 0%, #aa7c11 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #ffffff;
            margin-bottom: 16px;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
        }

        .user-name {
            font-size: 18px;
            font-weight: 800;
            font-style: italic;
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .user-role {
            font-size: 11px;
            color: #d4af37;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.08em;
        }

        /* Right Details Grid */
        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .info-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 16px 20px;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: all 0.2s ease;
        }

        .info-card:hover {
            border-color: #d4af37;
            box-shadow: 0 6px 16px rgba(212, 175, 55, 0.12);
        }

        .info-card.full-width {
            grid-column: span 2;
        }

        .label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #aa7c11;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .value {
            font-size: 15px;
            color: #1e293b;
            font-weight: 600;
            word-break: break-word;
        }

        @media (max-width: 680px) {
            .profile-wrapper {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .info-card.full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="nav-header">
            <a href="<?= site_url('student'); ?>" class="back-btn">
                &larr; Back to Dashboard
            </a>
            <div class="id-badge">ID: <?= $student_id; ?></div>
        </div>

        <div class="profile-wrapper">
            <div class="user-summary-card">
                <div class="avatar-box">&#128100;</div>
                <div class="user-name"><?= $name; ?></div>
                <div class="user-role">Student Profile</div>
            </div>

            <div class="details-grid">
                <div class="info-card full-width">
                    <span class="label">Degree Program</span>
                    <div class="value"><?= $course; ?></div>
                </div>
                <div class="info-card">
                    <span class="label">Year & Section</span>
                    <div class="value"><?= $year_section; ?></div>
                </div>
                <div class="info-card">
                    <span class="label">Course Subject</span>
                    <div class="value"><?= $subject; ?></div>
                </div>
                <div class="info-card">
                    <span class="label">Contact Number</span>
                    <div class="value"><?= $contact; ?></div>
                </div>
                <div class="info-card">
                    <span class="label">Email Address</span>
                    <div class="value"><?= $email; ?></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>