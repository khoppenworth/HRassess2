<?php
require_once __DIR__.'/config.php'; require_once __DIR__.'/i18n.php';
$msg=''; if($_SERVER['REQUEST_METHOD']==='POST'){ csrf_check(); $u=trim($_POST['username']??''); $p=$_POST['password']??'';
$st=$pdo->prepare("SELECT id,username,password,role,full_name FROM users WHERE username=?"); $st->execute([$u]); $row=$st->fetch();
if($row && password_verify($p,$row['password'])){ $_SESSION['user_id']=$row['id']; $_SESSION['username']=$row['username']; $_SESSION['full_name']=$row['full_name']; $_SESSION['user_role']=$row['role']; header("Location:/dashboard.php"); exit; } else { $msg=t('login_failed'); } }
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('login')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition login-page"><div class="login-box"><div class="login-logo"><b><?=htmlspecialchars(APP_TITLE)?></b></div><div class="card"><div class="card-body login-card-body">
<?php if($msg):?><div class="alert alert-danger"><?=htmlspecialchars($msg)?></div><?php endif;?>
<form method="post"><input type="hidden" name="csrf" value="<?=csrf_token()?>">
<div class="input-group mb-3"><input class="form-control" name="username" placeholder="<?=t('username')?>"></div>
<div class="input-group mb-3"><input class="form-control" type="password" name="password" placeholder="<?=t('password')?>"></div>
<div class="row"><div class="col-8"></div><div class="col-4"><button class="btn btn-primary btn-block"><?=t('login')?></button></div></div>
</form></div></div></div><script src="/public/vendor/adminlte/js/adminlte.min.js"></script></body></html>
<?php
?>
