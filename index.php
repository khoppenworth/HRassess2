<?php
require_once __DIR__.'/config.php'; require_once __DIR__.'/i18n.php'; if(is_logged_in()){header('Location:/dashboard.php');exit;} header('Location:/login.php');exit;
?>
