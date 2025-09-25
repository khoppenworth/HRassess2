<?php require_once __DIR__.'/../common.php'; api_authenticate($pdo);
$rows=$pdo->query('SELECT id as assessment_id,user_id,questionnaire_id,completed_at,total_score FROM assessments ORDER BY id DESC')->fetchAll();
json_out(['fields'=>['assessment_id','user_id','questionnaire_id','completed_at','total_score'],'rows'=>$rows]);
