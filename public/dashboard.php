<?php require_once __DIR__.'/..'.'/config.php'; require_once __DIR__.'/..'.'/helpers.php'; require_once __DIR__.'/..'.'/i18n.php'; require_auth();
$users=$pdo->query("SELECT COUNT(*) n FROM users")->fetch()['n']??0;
$qn=$pdo->query("SELECT COUNT(*) n FROM questionnaires")->fetch()['n']??0;
$as=$pdo->query("SELECT COUNT(*) n FROM assessments")->fetch()['n']??0;
$top=$pdo->query("SELECT q.title, AVG(a.total_score) avg FROM assessments a JOIN questionnaires q ON q.id=a.questionnaire_id GROUP BY q.id ORDER BY avg DESC LIMIT 5")->fetchAll();
$labels=array_map(fn($r)=>$r['title'],$top); $vals=array_map(fn($r)=>(float)$r['avg'],$top);
include __DIR__.'/..'.'/templates/header.php'; ?>
<h2><?=h(t('dashboard'))?></h2><div class="grid"><div class="alert"><strong>Users:</strong> <?=$users?></div><div class="alert"><strong>Questionnaires:</strong> <?=$qn?></div><div class="alert"><strong>Assessments:</strong> <?=$as?></div></div>
<?php if($labels):?><h3>Top 5 Average Scores</h3><canvas id="avg"></canvas><script>drawBarChart('avg', <?=json_encode($labels)?>, <?=json_encode($vals)?>);</script><?php endif; ?>
<p><a class="btn" href="/assessment/start.php"><?=h(t('start_assessment'))?></a></p><?php include __DIR__.'/..'.'/templates/footer.php'; ?>
