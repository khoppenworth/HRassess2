<?php
require_once __DIR__.'/../../config.php'; header('Content-Type: application/fhir+json'); $id=(int)($_GET['id']??0);
$qs=[]; $st=$pdo->prepare("SELECT q.id,q.text,q.scale_max FROM questions q JOIN sections s ON s.id=q.section_id WHERE s.form_id=? ORDER BY q.id"); $st->execute([$id]);
while($r=$st->fetch()){ $qs[]=["linkId"=>(string)$r['id'],"text"=>$r['text'],"type"=>"integer","extension":[{"url":"scaleMax","valueInteger"=>(int)$r['scale_max']}]]; }
echo json_encode(["resourceType"=>"Questionnaire","id"=>(string)$id,"status"=>"active","item"=>$qs]);
?>
