<?php
function uuid() {
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
function isValidTimestamp($timestamp) {
    $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $timestamp);
    return $dateTime && $dateTime->format('Y-m-d\TH:i') === $timestamp;
}
function isDecimal($value) {
    return is_numeric($value) && strpos($value, ',') === false;
}
?>