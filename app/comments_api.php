<?php
header('Content-Type: application/json');
// تنظيف الـ ID من أي رموز خبيثة أو رموز تشفير مثل + أو =
$vid = preg_replace('/[^a-zA-Z0-9]/', '', $_REQUEST['vid'] ?? 'general');
$file = "comments_" . $vid . ".txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = strip_tags($_POST['msg']);
    if ($vid && $msg) {
        file_put_contents($file, $msg . PHP_EOL, FILE_APPEND);
        echo json_encode(["status" => "success"]);
    }
} else {
    if (file_exists($file)) {
        $comments = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        echo json_encode(array_reverse($comments));
    } else {
        echo json_encode(["لا يوجد تعليقات بعد.. كن أول من يعلق!"]);
    }
}
?>
