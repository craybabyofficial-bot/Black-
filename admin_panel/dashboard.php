<?php
$db = new PDO('sqlite:/var/www/html/BLACK_BOX/admin_panel/blackbox.db');
if (isset($_GET['download'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=BlackBox_'.date('Y-m-d').'.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Phone', 'Code', 'IP', 'Date'));
    $rows = $db->query("SELECT * FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) fputcsv($output, $row);
    exit;
}
$users = $db->query("SELECT * FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { background: #050505; color: #ccc; font-family: sans-serif; margin: 0; padding: 10px; font-size: 13px; }
        .container { width: 100%; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 5px 10px; border-bottom: 1px solid #ffd700; margin-bottom: 10px; }
        h1 { color: #ffd700; font-size: 16px; margin: 0; }
        .btn-download { background: #ffd700; color: #000; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; background: #111; }
        th, td { padding: 6px 4px; text-align: center; border: 1px solid #222; white-space: nowrap; }
        th { background: #1a1a1a; color: #ffd700; font-size: 12px; }
        tr:nth-child(even) { background: #0d0d0d; }
        .badge { padding: 2px 5px; border-radius: 3px; font-size: 10px; color: #fff; }
        .has-code { background: #1b5e20; }
        .no-code { background: #b71c1c; }
        .ip-text { font-family: monospace; color: #777; font-size: 11px; }
        .date-text { font-size: 10px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BLACK BOX | ريــاض 👑 (<?php echo count($users); ?>)</h1>
            <a href="?download=true" class="btn-download">⬇️ CSV</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>الهاتف</th>
                    <th>الكود</th>
                    <th>IP</th>
                    <th>الوقت</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td style="color:#fff;"><strong><?php echo $user['phone']; ?></strong></td>
                    <td>
                        <?php if($user['ref_code'] == "بدون كود" || strpos($user['ref_code'], 'خطأ') !== false): ?>
                            <span class="badge no-code">❌</span>
                        <?php else: ?>
                            <span class="badge has-code">✅ <?php echo $user['ref_code']; ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="ip-text"><?php echo $user['ip_address']; ?></td>
                    <td class="date-text"><?php echo date('m/d H:i', strtotime($user['created_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
