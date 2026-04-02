<?php
$db = new PDO('sqlite:///var/www/html/BLACK_BOX/admin_panel/blackbox.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'] ?? '';
    $ref   = $_POST['code'] ?? ''; 
    $ip    = $_SERVER['REMOTE_ADDR'];

    // 1. التحقق من الرقم (إجباري)
    if (!preg_match('/^07[789][0-9]{7}$/', $phone)) {
        die("error_fake");
    }

    // 2. فحص الكود (اختياري)
    $final_ref = "بدون كود"; // القيمة الافتراضية
    if (!empty($ref)) {
        $checkCode = $db->prepare("SELECT * FROM official_codes WHERE code = ? AND status = 'active'");
        $checkCode->execute([$ref]);
        if ($checkCode->rowCount() > 0) {
            $final_ref = $ref; // الكود حقيقي، بنعتمده
        } else {
            $final_ref = "كود_خطأ: " . $ref; // سجلنا إنه حاول يحط كود بس طلع غلط
        }
    }

    // 3. التحقق من قاعدة بيانات المستخدمين
    $checkUser = $db->prepare("SELECT * FROM users WHERE phone = ?");
    $checkUser->execute([$phone]);
    
    if ($checkUser->rowCount() > 0) {
        // تحديث البيانات حتى للمستخدم القديم إذا دخل بكود جديد
        $update = $db->prepare("UPDATE users SET ref_code = ?, ip_address = ? WHERE phone = ?");
        $update->execute([$final_ref, $ip, $phone]);
        echo "exists";
    } else {
        // تسجيل مستخدم جديد
        $insert = $db->prepare("INSERT INTO users (phone, ref_code, ip_address) VALUES (?, ?, ?)");
        $insert->execute([$phone, $final_ref, $ip]);
        echo "new";
    }
}
?>
