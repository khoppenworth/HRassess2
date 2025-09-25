<?php
// i18n.php: load from /lang/*.php with fallback to EN
function load_lang(string $lang): array {
  $base = __DIR__ . '/lang/';
  $file = $base . preg_replace('/[^a-z]/','', strtolower($lang)) . '.php';
  if (!is_file($file)) { $file = $base . 'en.php'; }
  $arr = require $file;
  return is_array($arr) ? $arr : [];
}
function t(string $key): string {
  static $cache = null;
  if ($cache === null) { $cache = load_lang($_SESSION['lang'] ?? 'en'); }
  return $cache[$key] ?? $key;
}
