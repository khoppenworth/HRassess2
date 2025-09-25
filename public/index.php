<?php require_once __DIR__.'/..'.'/config.php'; require_once __DIR__.'/..'.'/helpers.php'; require_once __DIR__.'/..'.'/i18n.php';
if(isset($_POST['lang'])){$_SESSION['lang']=$_POST['lang'];} include __DIR__.'/..'.'/templates/header.php'; ?>
<h2>Welcome</h2><p class="muted">Comprehensive EPSS with folderized i18n.</p>
<ul><li><a href="/login.php"><?=h(t('login'))?></a></li><li><a href="/dashboard.php"><?=h(t('dashboard'))?></a></li><li><a href="/api/docs.php">API Docs</a></li></ul>
<?php include __DIR__.'/..'.'/templates/footer.php'; ?>
