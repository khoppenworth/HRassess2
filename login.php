<?php require_once __DIR__.'/config.php'; require_once __DIR__.'/helpers.php'; require_once __DIR__.'/auth.php'; require_once __DIR__.'/i18n.php';
$err=''; if($_SERVER['REQUEST_METHOD']==='POST'){ if(attempt_login($pdo,trim($_POST['username']??''),$_POST['password']??'')){redirect('/dashboard.php');} else {$err='Invalid credentials';}}
include __DIR__.'/templates/header.php'; ?>
<h2><?=h(t('login'))?></h2><?php if($err):?><div class="alert danger"><?=h($err)?></div><?php endif; ?>
<form method="post"><div class="row"><label><?=h(t('username'))?></label><input name="username" required></div><div class="row"><label><?=h(t('password'))?></label><input type="password" name="password" required></div><p><button class="btn"><?=h(t('login'))?></button></p></form>
<?php include __DIR__.'/templates/footer.php'; ?>
