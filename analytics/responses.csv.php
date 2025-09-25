<?php
require_once __DIR__.'/../config.php'; require_role(['admin','staff']); header('Content-Type:text/csv'); header('Content-Disposition: attachment; filename="responses.csv"');
$out=fopen('php://output','w'); fputcsv($out,['response_id','user_id','form','created_at','score']); $st=$pdo->query("SELECT fr.id, fr.user_id, f.name, fr.created_at, fr.score FROM form_responses fr JOIN forms f ON f.id=fr.form_id ORDER BY fr.id DESC");
while($r=$st->fetch()){ fputcsv($out,[$r['id'],$r['user_id'],$r['name'],$r['created_at'],round($r['score'],2)]); } fclose($out); exit;
?>
