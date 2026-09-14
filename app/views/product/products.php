<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Data Records'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #140b28;
            --bg-mid: #2b1a4c;
            --accent-cyan: #8fe3ea;
            --accent-violet: #b58bdb;
            --accent-red: #ff7b88;
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
            min-height: 100%;
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
            overflow-x: hidden;
            position: relative;
            padding: 40px 20px;
        }

        .data-box {
            position: relative;
            z-index: 1;
            width: min(1100px, 95vw);
            padding: 48px 40px;
            border-radius: 28px;
            background: var(--glass-fill);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
            box-shadow: 0 20px 60px rgba(20, 8, 40, 0.45);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-container h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 1.9rem;
            margin: 0;
            color: var(--text-primary);
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(20, 8, 40, 0.25);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        thead {
            background: rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        th {
            padding: 16px 20px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--accent-cyan);
        }

        th.actions-col,
        td.actions-col {
            text-align: center;
            width: 1%;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        td {
            padding: 14px 20px;
            color: var(--text-primary);
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--text-muted);
        }

        .footer-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 0.88rem;
            color: #15102a;
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-violet));
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s ease;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-logout {
            background: rgba(255, 123, 136, 0.12);
            color: var(--accent-red);
            border: 1px solid rgba(255, 123, 136, 0.3);
        }

        .btn-logout:hover {
            background: var(--accent-red);
            color: #15102a;
        }

        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.78rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background: rgba(143, 227, 234, 0.12);
            color: var(--accent-cyan);
            border: 1px solid rgba(143, 227, 234, 0.3);
        }

        .btn-edit:hover {
            background: var(--accent-cyan);
            color: #15102a;
        }

        .btn-delete {
            background: rgba(255, 123, 136, 0.12);
            color: var(--accent-red);
            border: 1px solid rgba(255, 123, 136, 0.3);
        }

        .btn-delete:hover {
            background: var(--accent-red);
            color: #15102a;
        }
    </style>
</head>

<body>
    <div class="container data-box">
        <div class="header-container">
            <h1><?= isset($title) ? htmlspecialchars($title) : 'Products Record'; ?></h1>
            <a href="<?= site_url('/products/create'); ?>" class="btn">
                <span>+</span> Add New Record
            </a>
        </div>

        <div class="table-wrapper">
            <?php if (!empty($records) && is_array($records)): ?>
                <table>
                    <thead>
                        <tr>
                            <?php
                            $firstRow = (array)$records[0];
                            $headers = array_keys($firstRow);

                            $idKey = $headers[0];
                            foreach ($headers as $key) {
                                if (strtolower($key) === 'id' || str_ends_with(strtolower($key), '_id')) {
                                    $idKey = $key;
                                    break;
                                }
                            }

                            foreach ($headers as $header):
                            ?>
                                <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $header))); ?></th>
                            <?php endforeach; ?>
                            <th class="actions-col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $row):
                            $rowData = (array)$row;
                            $primaryId = $rowData[$idKey] ?? '';
                        ?>
                            <tr>
                                <?php foreach ($rowData as $columnValue): ?>
                                    <td><?= htmlspecialchars($columnValue ?? ''); ?></td>
                                <?php endforeach; ?>

                                <td class="actions-col">
                                    <div class="action-group">
                                        <a href="<?= site_url('/products/edit/' . $primaryId); ?>" class="btn-sm btn-edit">Edit</a>
                                        <a href="<?= site_url('/products/delete/' . $primaryId); ?>"
                                            class="btn-sm btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this record?');">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    No records found in the database.
                </div>
            <?php endif; ?>
        </div>

        <div class="footer-container">
            <a href="<?= site_url('/logout'); ?>" class="btn btn-logout">Logout</a>
        </div>
    </div>
</body>

</html>