<?php require_once __DIR__.'/../../common.php'; api_authenticate($pdo);
header('Content-Type: text/csv; charset=utf-8'); header('Content-Disposition: attachment; filename="assessments.csv"');
$out=fopen('php://output','w'); fputcsv($out,['assessment_id','user_id','questionnaire_id','completed_at','total_score']);
$rows=$pdo->query('SELECT id as assessment_id,user_id,questionnaire_id,completed_at,total_score FROM assessments ORDER BY id DESC')->fetchAll();
foreach($rows as $r){fputcsv($out,$r);} fclose($out);
