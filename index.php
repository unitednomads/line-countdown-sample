<?php
include_once('config.php');

// `index.php?d=2023/01/01` にアクセスすると、`2023/01/01`にオプトインしたものとみなす
$d = $_GET['d'];
if ($d === null) {
  header("Location: $smartLinkUrl");
}
$format = 'Y/m/d';
$date = DateTime::createFromFormat($format, $d, new DateTimeZone('Asia/Tokyo'));

// Make a Time Tuner Token (JWT)
$jwtHeader = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
$jwtHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtHeader));
$jwtPayload = json_encode(['opt' => $date->getTimestamp()]);
$jwtPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtPayload));
$jwtSignature = hash_hmac('sha256', $jwtHeader . "." . $jwtPayload, $jwtSecret, true);
$jwtSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtSignature));
$jwt = $jwtHeader . "." . $jwtPayload . "." . $jwtSignature;

// Redirect to the SmartLink
header("Location: $smartLinkUrl?t3=$jwt");