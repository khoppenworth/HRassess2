<?php
declare(strict_types=1);
session_start();
define('DB_HOST','127.0.0.1');
define('DB_NAME','epss');
define('DB_USER','epss_user');
define('DB_PASS','epss_pass');
define('BASE_URL','');
define('UPLOAD_DIR', __DIR__ . '/public/uploads');
define('ADMINLTE_DIR', __DIR__ . '/public/vendor/adminlte');
define('APP_LOCALE_DEFAULT', 'en');
define('APP_TITLE', 'EPSS Self-Assessment');
$options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
try{$pdo=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",DB_USER,DB_PASS,$options);}catch(PDOException $e){die("DB connection failed: ".htmlspecialchars($e->getMessage()));}
function is_logged_in(): bool {return isset($_SESSION['user_id']);}
function current_user_id(){return $_SESSION['user_id']??null;}
function current_username(){return $_SESSION['username']??null;}
function current_user_role(){return $_SESSION['user_role']??null;}
function require_login(){ if(!is_logged_in()){ header("Location: /login.php"); exit; } }
function require_role($roles){ if(!is_logged_in()){header("Location: /login.php");exit;} $roles=is_array($roles)?$roles:[$roles]; if(!in_array($_SESSION['user_role']??'',$roles,true)){ http_response_code(403); echo "Forbidden"; exit; } }
function t($k){ global $LANG; return $LANG[$k]??$k; }
function csrf_token(){ if(empty($_SESSION['csrf'])){ $_SESSION['csrf']=bin2hex(random_bytes(16)); } return $_SESSION['csrf']; }
function csrf_check(){ if($_SERVER['REQUEST_METHOD']==='POST'){ if(!isset($_POST['csrf'])||!hash_equals($_SESSION['csrf']??'',$_POST['csrf'])){ http_response_code(400); echo "Bad CSRF"; exit; } } }
function flash($m=null){ if($m!==null){$_SESSION['flash']=$m;return;} $x=$_SESSION['flash']??''; unset($_SESSION['flash']); return $x; }
function get_setting(PDO $pdo,string $key,$default=null){ $st=$pdo->prepare("SELECT val FROM settings WHERE `key`=?");$st->execute([$key]);$r=$st->fetch(); return $r?$r['val']:$default; }
function set_setting(PDO $pdo,string $key,string $val){ $pdo->prepare("INSERT INTO settings(`key`,`val`) VALUES(?,?) ON DUPLICATE KEY UPDATE val=VALUES(val)")->execute([$key,$val]); }
?>
