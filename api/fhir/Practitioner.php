<?php require_once __DIR__.'/../common.php'; api_authenticate($pdo);
$rows=$pdo->query('SELECT id,full_name,email,username FROM users ORDER BY id')->fetchAll(); json_out(array_map(fn($r)=>['resourceType'=>'Practitioner','id'=>(string)$r['id'],'name'=>[['text'=>$r['full_name']??$r['username']]],'telecom'=>[['system'=>'email','value'=>$r['email']??'']]],$rows));
