<?php
$db = new PDO('sqlite:blackbox.db');
$total_users = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
$users = $db->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم | BLACK BOX</title>
    <style>
        body { background: #000; color: #d4af37; font-family: sans-serif; padding: 10px; }
        .stat-box { background: #111; padding: 20px; border: 2px solid #d4af37; border-radius: 15px; text-align: center; margin-bottom: 20px; }
        .stat-number { font-size: 40px; color: #fff; display: block; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: center; }
        th { background: #d4af37; color: #000; }
        tr:nth-child(even) { background: #050505; }
    </style>
</head>
<body>
    <div class="stat-box">
        <span>العدد الإجمالي للمستخدمين (الحقيقيين)</span>
        <span class="stat-number"><?php echo $total_users; ?></span>
    </div>

    <table>
        <tr>
            <th>رقم الهاتف</th>
            <th>كود الاستضافة</th>
            <th>IP العنوان</th>
            <th>التاريخ</th>
        </tr>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo $user['phone']; ?></td>
            <td><?php echo $user['ref_code']; ?></td>
            <td><?php echo $user['ip_address']; ?></td>
            <td><?php echo $user['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
