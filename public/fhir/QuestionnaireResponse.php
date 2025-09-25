<?php require_once __DIR__.'/../../common.php'; api_authenticate($pdo);
$aid=(int)($_GET['assessment_id']??0); if(!$aid) json_out(['error'=>'assessment_id required'],400);
$a=$pdo->prepare('SELECT * FROM assessments WHERE id=?'); $a->execute([$aid]); $ass=$a->fetch(); if(!$ass) json_out(['error'=>'Not found'],404);
$r=$pdo->prepare('SELECT r.*, q.text FROM responses r JOIN questions q ON q.id=r.question_id WHERE r.assessment_id=?'); $r->execute([$aid]); $items=[]; foreach($r as $row){$items[]=['linkId'=>(string)$row['question_id'],'text'=>$row['text'],'answer'=>[['valueInteger'=>(int)$row['score']]]];}
json_out(['resourceType'=>'QuestionnaireResponse','id'=>(string)$aid,'status'=>'completed','item'=>$items]);
