<?php
require_once __DIR__.'/../config.php'; require_role(['admin','staff']); header('Content-Type:text/csv'); header('Content-Disposition: attachment; filename="summary.csv"');
$out=fopen('php://output','w'); fputcsv($out,['date','form','avg_score','responses']); $st=$pdo->query("SELECT DATE(created_at) d, f.name, AVG(score) avg_s, COUNT(*) c FROM form_responses fr JOIN forms f ON f.id=fr.form_id GROUP BY d,f.name ORDER BY d DESC");
while($r=$st->fetch()){ fputcsv($out,[$r['d'],$r['name'],round($r['avg_s'],2),$r['c']]); } fclose($out); exit;
?>
