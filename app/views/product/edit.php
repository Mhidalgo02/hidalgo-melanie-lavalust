<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
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
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Manrope', sans-serif;
            color: var(--text-primary);
            background:
                radial-gradient(circle at 15% 20%, #4a2a70, transparent 55%),
                radial-gradient(circle at 85% 80%, #1f3f63, transparent 55%),
                linear-gradient(160deg, var(--bg-deep), var(--bg-mid) 60%, var(--bg-deep));
            padding: 40px 20px;
        }

        .form-box {
            position: relative;
            z-index: 1;
            width: min(480px, 90vw);
            padding: 48px 44px 44px;
            border-radius: 28px;
            background: var(--glass-fill);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            box-shadow: 0 20px 60px rgba(20, 8, 40, 0.45);
        }

        .header-container {
            margin-bottom: 28px;
        }

        .form-box h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 1.8rem;
            margin: 0;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .form-group input,
        .form-group textarea {
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

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--accent-cyan);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(143, 227, 234, 0.15);
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .btn {
            flex: 1;
            padding: 13px 16px;
            font-weight: 600;
            font-size: 0.95rem;
            text-align: center;
            text-decoration: none;
            border-radius: 12px;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            color: #15102a;
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-violet));
            box-shadow: 0 8px 24px rgba(143, 227, 234, 0.25);
        }

        .btn-secondary {
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.16);
        }
    </style>
</head>

<body>
    <div class="container form-box">
        <div class="header-container">
            <h1>Update Product</h1>
        </div>

        <?php
        $rec = (array) $record;
        $id = $rec['id'] ?? '';
        ?>

        <form method="POST" action="<?= site_url('/products/edit/' . $id); ?>">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($rec['product_name'] ?? ''); ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"><?= htmlspecialchars($rec['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" step="0.01" min="0" id="price" name="price" value="<?= htmlspecialchars($rec['price'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" min="0" id="quantity" name="quantity" value="<?= htmlspecialchars($rec['quantity'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="btn-group">
                <a href="<?= site_url('/products'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>
</body>

</html>