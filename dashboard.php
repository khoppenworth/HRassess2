<?php
require_once __DIR__.'/config.php'; require_once __DIR__.'/i18n.php'; require_login();
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('dashboard')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini layout-fixed"><div class="wrapper"><?php include __DIR__.'/templates/header.php'; ?>
<div class="content-wrapper p-3"><section class="content"><div class="container-fluid"><div class="row">
<div class="col-md-6"><div class="card"><div class="card-header"><h3 class="card-title"><?=t('my_assessments')?></h3></div><div class="card-body">
<a class="btn btn-success" href="/forms/start.php"><i class="fas fa-plus"></i> <?=t('start_new_assessment')?></a><hr>
<?php
$st=$pdo->prepare("SELECT fr.id,f.name form_name,fr.score,fr.created_at FROM form_responses fr JOIN forms f ON f.id=fr.form_id WHERE fr.user_id=? ORDER BY fr.created_at DESC LIMIT 20");
$st->execute([current_user_id()]);
echo '<table class="table table-sm"><tr><th>'.t('form').'</th><th>'.t('score').'</th><th>'.t('date').'</th><th></th></tr>';
while($r=$st->fetch()){ echo '<tr><td>'.htmlspecialchars($r['form_name']).'</td><td>'.(float)$r['score'].'</td><td>'.htmlspecialchars($r['created_at']).'</td><td><a href="/forms/view.php?id='.(int)$r['id'].'">'.t('view').'</a></td></tr>'; } echo '</table>';
?></div></div></div>
<div class="col-md-6"><div class="card"><div class="card-header"><h3 class="card-title"><?=t('org_analytics')?></h3></div><div class="card-body">
<p><?=t('analytics_blurb')?></p><div id="chart"></div>
<script>
fetch('/analytics/summary.json.php').then(r=>r.json()).then(d=>{document.getElementById('chart').innerHTML='<pre>'+JSON.stringify(d,null,2)+'</pre>';});
</script>
<a class="btn btn-outline-primary" href="/analytics/index.php"><?=t('open_analytics')?></a>
</div></div></div>
</div></div></section></div><?php include __DIR__.'/templates/footer.php'; ?></div>
<script src="/public/vendor/adminlte/js/adminlte.min.js"></script></body></html>
<?php
?>
