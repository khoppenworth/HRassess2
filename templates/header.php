<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../helpers.php'; require_once __DIR__.'/../i18n.php';
$lang = $_SESSION['lang'] ?? 'en';
$siteName='EPSS'; $logoPath=null;
try{$r=$pdo->query('SELECT site_name,logo_path FROM app_settings WHERE id=1')->fetch();$siteName=$r['site_name']??'EPSS';$logoPath=$r['logo_path']??null;}catch(Throwable $e){}
?><!doctype html><html lang="<?=h($lang)?>"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?=h($siteName)?> – <?=h(t('app_name'))?></title>
<link rel="stylesheet" href="/vendor/adminlte/css/adminlte.min.css">
<style>body{font-family:system-ui,Arial,sans-serif;margin:0;background:#f6f7fb}header,nav,main,footer{padding:1rem}.container{max-width:1100px;margin:0 auto;background:#fff;padding:1rem;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.05)}.nav{display:flex;gap:.75rem;align-items:center}.spacer{flex:1}a.btn,button.btn{padding:.5rem .9rem;border:1px solid #ccc;border-radius:8px;background:#fafafa;cursor:pointer;text-decoration:none}table{width:100%;border-collapse:collapse}th,td{padding:.5rem;border-bottom:1px solid #eee;text-align:left}.muted{color:#666;font-size:.9rem}.alert{background:#eef6ff;border:1px solid #cfe2ff;padding:.6rem .8rem;border-radius:8px}.danger{background:#fff1f0;border:1px solid #ffccc7}.success{background:#f6ffed;border:1px solid #b7eb8f}.grid{display:grid;gap:1rem;grid-template-columns:repeat(auto-fit,minmax(240px,1fr))}input[type=text],input[type=password],input[type=file],textarea,select{width:100%;padding:.5rem .6rem;border:1px solid #ccc;border-radius:8px}form .row{display:grid;grid-template-columns:1fr 2fr;gap:.75rem;align-items:center}.brand{display:flex;align-items:center;gap:.5rem}.brand img{height:40px;width:auto}canvas{max-width:100%}</style>
</head><body><header><div class="container nav"><div class="brand"><?php if($logoPath):?><img src="<?=h($logoPath)?>" alt="logo"><?php endif;?><strong><?=h($siteName)?></strong></div>
<a class="btn" href="/dashboard.php"><?=h(t('dashboard'))?></a>
<?php if(is_logged_in() && (current_user()['role']??'')==='admin'):?><a class="btn" href="/admin/users.php"><?=h(t('users'))?></a><a class="btn" href="/admin/questionnaires.php"><?=h(t('questionnaires'))?></a><a class="btn" href="/admin/settings.php">Settings</a><?php endif;?>
<div class="spacer"></div>
<form method="post" action="/index.php" style="display:flex;gap:.5rem"><select name="lang" onchange="this.form.submit()"><option value="en"<?= $lang==='en'?' selected':''?>>EN</option><option value="fr"<?= $lang==='fr'?' selected':''?>>FR</option><option value="am"<?= $lang==='am'?' selected':''?>>AM</option></select></form>
<?php if(is_logged_in()):?><a class="btn" href="/logout.php"><?=h(t('logout'))?> (<?=h(current_user()['username'])?>)</a><?php else:?><a class="btn" href="/login.php"><?=h(t('login'))?></a><?php endif;?>
</div></header><main><div class="container">
