<?php
$db = new PDO('sqlite:/var/www/html/BLACK_BOX/admin_panel/blackbox.db');

// إنشاء جدول الأكواد إذا لم يكن موجوداً
$db->exec("CREATE TABLE IF NOT EXISTS official_codes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    code TEXT UNIQUE,
    status TEXT DEFAULT 'active'
)");

// دالة لتوليد كود عشوائي
function generateRandomCode($length = 6) {
    return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, $length));
}

// توليد 10 أكواد كمثال (تقدر تشغله كل ما بدك أكواد جديدة)
for ($i = 0; $i < 10; $i++) {
    $newCode = generateRandomCode();
    $stmt = $db->prepare("INSERT OR IGNORE INTO official_codes (code) VALUES (?)");
    $stmt->execute([$newCode]);
    echo "تم إنشاء كود جديد: $newCode <br>";
}
?>
