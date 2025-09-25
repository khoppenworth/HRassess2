<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_login();
$id=(int)($_GET['id']??0); $st=$pdo->prepare("SELECT fr.*,f.name FROM form_responses fr JOIN forms f ON f.id=fr.form_id WHERE fr.id=? AND fr.user_id=?"); $st->execute([$id,current_user_id()]); $r=$st->fetch(); if(!$r){ http_response_code(404); echo "Not found"; exit; }
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=htmlspecialchars($r['name'])?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=htmlspecialchars($r['name'])?></h1><p><strong><?=t('score')?>:</strong> <?=round((float)$r['score'],2)?></p><a class="btn btn-secondary" href="/forms/fill.php?rid=<?=$r['id']?>"><?=t('edit')??'Edit'?></a></div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
