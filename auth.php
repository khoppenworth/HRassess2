<?php
require_once __DIR__.'/config.php'; require_once __DIR__.'/helpers.php';
function attempt_login(PDO $pdo,string $u,string $p):bool{
  $st=$pdo->prepare('SELECT id,username,password,role,full_name FROM users WHERE username=?');$st->execute([$u]);$r=$st->fetch();
  if($r && password_verify($p,$r['password'])){$_SESSION['user']=['id'=>$r['id'],'username'=>$r['username'],'role'=>$r['role'],'full_name'=>$r['full_name']??$r['username']];return true;}
  return false;
}
function logout(){$_SESSION=[];if(ini_get('session.use_cookies')){$pa=session_get_cookie_params();setcookie(session_name(),'',time()-42000,$pa['path'],$pa['domain'],$pa['secure'],$pa['httponly']);}session_destroy();}
