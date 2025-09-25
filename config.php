<?php
declare(strict_types=1);
session_start();
define('DB_HOST','127.0.0.1');
define('DB_NAME','epss');
define('DB_USER','epss_user');
define('DB_PASS','epss_pass');
define('BASE_URL','');
$options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
try{$pdo=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,$options);}catch(Throwable $e){http_response_code(500);die('DB connection failed: '.$e->getMessage());}
function is_logged_in():bool{return isset($_SESSION['user']);}
function current_user():?array{return $_SESSION['user']??null;}
function require_auth(array $roles=[]):void{if(!is_logged_in()){header('Location: '.url('/login.php'));exit;} if($roles && !in_array($_SESSION['user']['role']??'staff',$roles,true)){http_response_code(403);echo'Forbidden';exit;}}
function url(string $p):string{return (BASE_URL?BASE_URL:'').$p;}
