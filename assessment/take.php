<?php require_once __DIR__.'/../config.php'; require_once __DIR__.'/../helpers.php'; require_once __DIR__.'/../i18n.php'; require_auth();
$qid=(int)($_GET['qid']??0); $q=$pdo->prepare('SELECT id,title FROM questionnaires WHERE id=?'); $q->execute([$qid]); $qn=$q->fetch(); if(!$qn){echo'Questionnaire not found';exit;}
$qs=$pdo->prepare('SELECT * FROM questions WHERE questionnaire_id=? ORDER BY section,id'); $qs->execute([$qid]); $questions=$qs->fetchAll();
include __DIR__.'/../templates/header.php'; ?><h2><?=h($qn['title'])?></h2><form method="post" action="/assessment/submit.php"><input type="hidden" name="qid" value="<?=$qid?>">
<?php foreach($questions as $qq):?><div class="alert"><strong><?=h($qq['section'])?></strong><br><?=h($qq['text'])?><br><label>Score (0-<?=$qq['max_score']?>):</label><input type="number" name="score[<?=$qq['id']?>]" min="0" max="<?=$qq['max_score']?>" value="0"></div><?php endforeach; ?>
<p><button class="btn">Submit</button></p></form><?php include __DIR__.'/../templates/footer.php'; ?>
