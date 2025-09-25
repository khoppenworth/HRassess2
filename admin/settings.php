<?php require_once __DIR__.'/../config.php'; require_once __DIR__.'/../helpers.php'; require_once __DIR__.'/../i18n.php'; require_auth(['admin']);
$msg=''; if($_SERVER['REQUEST_METHOD']==='POST'){ $site=trim($_POST['site_name']??'EPSS'); $logoPath=null;
 if(!empty($_FILES['logo']['name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){ $fn='/upload/logo_'.time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','_', $_FILES['logo']['name']); $dest=__DIR__.'/..'.$fn; if(move_uploaded_file($_FILES['logo']['tmp_name'],$dest)){$logoPath=$fn;}}
 if($logoPath){$pdo->prepare('UPDATE app_settings SET site_name=?, logo_path=? WHERE id=1')->execute([$site,$logoPath]);} else {$pdo->prepare('UPDATE app_settings SET site_name=? WHERE id=1')->execute([$site]);}
 $msg='Saved';
}
$r=$pdo->query('SELECT site_name,logo_path FROM app_settings WHERE id=1')->fetch();
include __DIR__.'/../templates/header.php'; ?><h2>Settings</h2><?php if($msg):?><div class="alert success"><?=h($msg)?></div><?php endif; ?>
<form method="post" enctype="multipart/form-data"><div class="row"><label>Site name</label><input name="site_name" value="<?=h($r['site_name']??'EPSS')?>"></div><div class="row"><label><?=h(t('upload_logo'))?></label><input type="file" name="logo" accept="image/*"></div><p><button class="btn"><?=h(t('save'))?></button></p></form>
<?php if(!empty($r['logo_path'])):?><p class="muted">Current logo: <img src="<?=h($r['logo_path'])?>" style="height:40px"></p><?php endif; ?><?php include __DIR__.'/../templates/footer.php'; ?>
