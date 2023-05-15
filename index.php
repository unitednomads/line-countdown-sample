<?php
include_once('config.php');

// `index.php?d=2023/01/01` にアクセスすると、`2023/01/01`にオプトインしたものとみなす
try {
  $d = $_GET['d'];
  $format = 'Y/m/d';
  $date = DateTime::createFromFormat($format, $d, new DateTimeZone('Asia/Tokyo'));
  $opt = $date->getTimestamp();
} catch (Throwable $e) {
  header("Location: $baseUrl/$smartLinkSlug");
  exit;
}

// Make a Time Tuner Token (JWT)
$jwtHeader = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
$jwtHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtHeader));
$jwtPayload = json_encode(['opt' => $opt]);
$jwtPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtPayload));
$jwtSignature = hash_hmac('sha256', $jwtHeader . "." . $jwtPayload, $jwtSecret, true);
$jwtSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtSignature));
$jwt = $jwtHeader . "." . $jwtPayload . "." . $jwtSignature;

// Redirect to the SmartLink
header("Location: $baseUrl/$smartLinkSlug?t3=$jwt");