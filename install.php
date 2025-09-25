<?php
require_once __DIR__.'/config.php';
$pdo->exec(file_get_contents(__DIR__.'/schema.sql'));
$pdo->exec(file_get_contents(__DIR__.'/seed.sql'));
echo 'Install OK. Default admin admin/admin123. <a href="'.url('/login.php').'">Login</a>';
