<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php';
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
<ul class="navbar-nav ml-auto">
<li class="nav-item"><a class="nav-link" href="/settings.php"><i class="fas fa-cog"></i> <?=t('settings')?></a></li>
<li class="nav-item"><a class="nav-link" href="/logout.php"><?=t('logout')?> (<?=htmlspecialchars(current_username()??'')?>)</a></li>
</ul></nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="/" class="brand-link"><span class="brand-text font-weight-light"><?=htmlspecialchars(APP_TITLE)?></span></a>
<div class="sidebar"><nav class="mt-2"><ul class="nav nav-pills nav-sidebar flex-column">
<li class="nav-item"><a href="/dashboard.php" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p><?=t('dashboard')?></p></a></li>
<?php if(current_user_role()==='admin'): ?>
<li class="nav-item"><a href="/admin/users.php" class="nav-link"><i class="nav-icon fas fa-users"></i><p><?=t('users')?></p></a></li>
<li class="nav-item"><a href="/admin/forms.php" class="nav-link"><i class="nav-icon fas fa-list"></i><p><?=t('forms')?></p></a></li>
<li class="nav-item"><a href="/admin/item_banks.php" class="nav-link"><i class="nav-icon fas fa-database"></i><p><?=t('item_banks')?></p></a></li>
<li class="nav-item"><a href="/analytics/index.php" class="nav-link"><i class="nav-icon fas fa-chart-bar"></i><p><?=t('analytics')?></p></a></li>
<?php endif; ?>
</ul></nav></div></aside>
?>
