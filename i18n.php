<?php
$lang = $_GET['lang'] ?? ($_SESSION['lang'] ?? APP_LOCALE_DEFAULT);
if(!in_array($lang,['en','fr','am'])) $lang = APP_LOCALE_DEFAULT;
$_SESSION['lang'] = $lang;
$LANG = require __DIR__ . "/i18n/$lang.php";
?>
