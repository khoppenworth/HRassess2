<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_login(); csrf_check();
$rid=(int)($_GET['rid']??0);
$st=$pdo->prepare("SELECT fr.*,f.name FROM form_responses fr JOIN forms f ON f.id=fr.form_id WHERE fr.id=? AND fr.user_id=?"); $st->execute([$rid,current_user_id()]); $resp=$st->fetch(); if(!$resp){ http_response_code(404); echo "Not found"; exit; }
$form_id=(int)$resp['form_id']; $sections=$pdo->query("SELECT * FROM sections WHERE form_id=$form_id ORDER BY id")->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
  foreach($_POST as $k=>$v){ if(strpos($k,'q_')===0){ $qid=(int)substr($k,2); $val=(int)$v; $pdo->prepare("INSERT INTO answers(response_id,question_id,value) VALUES (?,?,?) ON DUPLICATE KEY UPDATE value=VALUES(value)")->execute([$rid,$qid,$val]); } }
  $score=0.0; $w=0.0; $qs=$pdo->query("SELECT q.id,q.weight,q.scale_max,a.value FROM questions q JOIN sections s ON s.id=q.section_id LEFT JOIN answers a ON a.question_id=q.id AND a.response_id=$rid WHERE s.form_id=$form_id")->fetchAll();
  foreach($qs as $q){ $val=(int)($q['value']??0); $max=max(1,(int)$q['scale_max']); $weight=(float)$q['weight']; $score+=($val/$max)*$weight*100.0; $w+=$weight; }
  if($w>0) $score=$score/$w; $pdo->prepare("UPDATE form_responses SET score=? WHERE id=?")->execute([$score,$rid]);
  flash('Saved'); header("Location:/forms/view.php?id=".$rid); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=htmlspecialchars($resp['name'])?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=htmlspecialchars($resp['name'])?></h1><?php if($m=flash()):?><div class="alert alert-success"><?=$m?></div><?php endif;?>
<form method="post" class="card card-body"><input type="hidden" name="csrf" value="<?=csrf_token()?>">
<?php foreach($sections as $s): ?><h5><?=htmlspecialchars($s['title'])?></h5>
<?php $qs=$pdo->query("SELECT * FROM questions WHERE section_id=".$s['id']." ORDER BY id")->fetchAll(); foreach($qs as $q): $av=$pdo->query("SELECT value FROM answers WHERE response_id=$rid AND question_id=".$q['id'])->fetch()['value']??''; ?>
<div class="form-group"><label><?=htmlspecialchars($q['text'])?></label><input type="number" class="form-control" min="0" max="<?=$q['scale_max']?>" name="q_<?=$q['id']?>" value="<?=htmlspecialchars($av)?>"></div>
<?php endforeach; endforeach; ?><button class="btn btn-primary"><?=t('save')??'Save'?></button></form></div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
