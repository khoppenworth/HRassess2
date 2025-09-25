<?php require_once __DIR__.'/../config.php'; require_once __DIR__.'/../helpers.php'; require_once __DIR__.'/../i18n.php'; require_auth();
$rows=$pdo->query('SELECT id,title FROM questionnaires ORDER BY id DESC')->fetchAll();
include __DIR__.'/../templates/header.php'; ?><h2><?=h(t('start_assessment'))?></h2>
<form method="get" action="/assessment/take.php"><div class="row"><label>Questionnaire</label><select name="qid" required><?php foreach($rows as $r):?><option value="<?=$r['id']?>"><?=h($r['title'])?></option><?php endforeach;?></select></div><p><button class="btn">Start</button></p></form>
<?php include __DIR__.'/../templates/footer.php'; ?>
