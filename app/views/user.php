<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
</head>

<body>
    <h1>Users List</h1>
    <?php if (!empty($users)): ?>
        <?php $columns = array_keys((array) $users[0]); // grabs column names from the first row 
        ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th><?= ucfirst($column) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <?php foreach ((array) $user as $value): ?>
                            <td><?= $value ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data found.</p>
    <?php endif; ?>
</body>

</html>