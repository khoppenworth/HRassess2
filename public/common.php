<?php require_once __DIR__.'/../../config.php';
function api_authenticate(PDO $pdo):void{$h=$_SERVER['HTTP_AUTHORIZATION']??''; if(preg_match('/Bearer\s+(\S+)/',$h,$m)){ $t=$m[1]; $s=$pdo->prepare('SELECT id FROM api_tokens WHERE token=?'); $s->execute([$t]); if($s->fetch()) return;} header('Content-Type: application/json', true, 401); echo json_encode(['error'=>'Unauthorized']); exit;}
function json_out($d,int $c=200):void{header('Content-Type: application/json',true,$c); echo json_encode($d,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); exit;}
