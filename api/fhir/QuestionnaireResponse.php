<?php
require_once __DIR__.'/../../config.php'; header('Content-Type: application/fhir+json'); $id=(int)($_GET['id']??0);
$st=$pdo->prepare("SELECT fr.id, fr.form_id, fr.user_id, fr.created_at FROM form_responses fr WHERE fr.id=?"); $st->execute([$id]); $r=$st->fetch(); if(!$r){ http_response_code(404); echo json_encode(["issue"=>"not found"]); exit; }
$ans=[]; $st2=$pdo->query("SELECT q.id qid, q.text, a.value FROM answers a JOIN questions q ON q.id=a.question_id WHERE a.response_id=".$id);
while($row=$st2->fetch()){ $ans[]=["linkId"=>(string)$row['qid'],"text"=>$row['text'],"answer"=>[["valueInteger"=>(int)$row['value']]]]; }
echo json_encode(["resourceType"=>"QuestionnaireResponse","id"=>(string)$id,"status"=>"completed","authored"=>$r['created_at'],"item"=>$ans]);
?>
