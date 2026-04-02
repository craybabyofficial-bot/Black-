<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// دالة ذكية لتنظيف النصوص العربية من الهمزات والتاء المربوطة
function normalizeArabic($text) {
    $search  = ['أ', 'إ', 'آ', 'ة', 'ى'];
    $replace = ['ا', 'ا', 'ا', 'ه', 'ي'];
    $text = str_replace($search, $replace, $text);
    return mb_strtolower(trim($text));
}

$cat = $_GET['cat'] ?? 'all';
$searchArea = $_GET['area'] ?? ''; 
$normSearch = !empty($searchArea) ? normalizeArabic($searchArea) : '';

$videoFile = $cat . ".txt";
$phoneFile = $cat . "_phone.txt";
$locationFile = $cat . "_location.txt";

$priorityAds = []; 
$otherAds = [];    

if (file_exists($videoFile)) {
    $videoLines = file($videoFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $phoneLines = file_exists($phoneFile) ? file($phoneFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $locationLines = file_exists($locationFile) ? file($locationFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

    foreach ($videoLines as $index => $vLine) {
        $vParts = preg_split('/\s+/', trim($vLine));
        $videoUrl = (isset($vParts[1]) && stripos($vParts[1], 'http') !== false) ? $vParts[1] : (isset($vParts[0]) && stripos($vParts[0], 'http') !== false ? $vParts[0] : "");

        if ($videoUrl != "") {
            $pLine = isset($phoneLines[$index]) ? trim($phoneLines[$index]) : "";
            $phone = "0000000000";
            $areaName = "";

            if (!empty($pLine)) {
                $pParts = preg_split('/\s+/', $pLine);
                if (count($pParts) >= 2) {
                    $phone = end($pParts);
                    $areaArray = array_slice($pParts, 1, -1);
                    $areaName = implode(" ", $areaArray);
                }
            }

            $lLine = isset($locationLines[$index]) ? trim($locationLines[$index]) : "";
            $lParts = preg_split('/\s+/', $lLine);
            $location = (isset($lParts[1]) && stripos($lParts[1], 'http') !== false) ? $lParts[1] : "#";

            $adData = [
                "video"    => $videoUrl,
                "location" => $location,
                "phone"    => $phone,
                "area"     => $areaName
            ];

            // البحث الذكي باستخدام الدالة المنظمة
            if (!empty($normSearch) && mb_stripos(normalizeArabic($areaName), $normSearch) !== false) {
                $priorityAds[] = $adData;
            } else {
                $otherAds[] = $adData;
            }
        }
    }
}

echo json_encode(array_merge($priorityAds, $otherAds));
?>
