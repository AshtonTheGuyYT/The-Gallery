<?php
// list.php â€” returns JSON of files in a gallery folder
$allowed = ['malegallery','femalegallery','femboygallery'];
$folder  = $_GET['folder'] ?? '';
if (!in_array($folder, $allowed, true)) { http_response_code(400); exit('[]'); }

$dir = __DIR__ . '/' . $folder;
$out = [];
if (is_dir($dir)) {
  foreach (scandir($dir) as $f) {
    if ($f === '.' || $f === '..') continue;
    if (is_file($dir . '/' . $f)) $out[] = $f;
  }
}
header('Content-Type: application/json');
echo json_encode($out);