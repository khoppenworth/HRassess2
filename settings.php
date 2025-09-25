<?php
require_once __DIR__.'/config.php'; require_once __DIR__.'/i18n.php'; require_role('admin'); csrf_check();
if($_SERVER['REQUEST_METHOD']==='POST'){ if(isset($_FILES['logo']) && $_FILES['logo']['tmp_name']){ if(!is_dir(UPLOAD_DIR)){ mkdir(UPLOAD_DIR,0777,true); } $ext=pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION); $dest=UPLOAD_DIR.'/logo.'.preg_replace('/[^a-z0-9]/i','',$ext); move_uploaded_file($_FILES['logo']['tmp_name'],$dest); set_setting($pdo,'org_logo',basename($dest)); }
set_setting($pdo,'org_name',trim($_POST['org_name']??'')); set_setting($pdo,'org_contact',trim($_POST['org_contact']??'')); flash('Settings saved'); header("Location:/settings.php"); exit; }
$org_name=get_setting($pdo,'org_name',''); $org_contact=get_setting($pdo,'org_contact',''); $logo=get_setting($pdo,'org_logo','');
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('settings')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=t('settings')?></h1><?php if($m=flash()):?><div class="alert alert-success"><?=$m?></div><?php endif;?>
<form method="post" enctype="multipart/form-data" class="card card-body"><input type="hidden" name="csrf" value="<?=csrf_token()?>">
<div class="row"><div class="col-md-4"><input class="form-control mb-2" name="org_name" placeholder="Organization name" value="<?=htmlspecialchars($org_name)?>"></div>
<div class="col-md-4"><input class="form-control mb-2" name="org_contact" placeholder="Contact details" value="<?=htmlspecialchars($org_contact)?>"></div>
<div class="col-md-4"><input type="file" class="form-control-file" name="logo"></div></div><button class="btn btn-primary"><i class="fas fa-save"></i> Save</button></form>
<?php if($logo): ?><p>Current logo:</p><img src="/public/uploads/<?=$logo?>" style="max-height:80px"><?php endif; ?>
</div><?php include __DIR__.'/templates/footer.php'; ?></div></body></html>
<?php
?>
