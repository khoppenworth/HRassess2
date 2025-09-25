<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_login();
$forms=$pdo->query("SELECT id,name FROM forms ORDER BY id")->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){ $form_id=(int)$_POST['form_id']; $pdo->prepare("INSERT INTO form_responses(form_id,user_id,created_at,score) VALUES (?,?,NOW(),0)")->execute([$form_id,current_user_id()]); $rid=(int)$pdo->lastInsertId(); header("Location:/forms/fill.php?rid=".$rid); exit; }
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('start_new_assessment')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=t('start_new_assessment')?></h1>
<form method="post" class="card card-body"><select class="form-control mb-2" name="form_id"><?php foreach($forms as $f){ echo '<option value="'.$f['id'].'">'.htmlspecialchars($f['name']).'</option>'; } ?></select><button class="btn btn-primary"><?=t('start_new_assessment')?></button></form>
</div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
