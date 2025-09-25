<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_role('admin');
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('analytics')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=t('analytics')?></h1>
<ul><li><a href="/analytics/summary.csv.php">summary.csv</a></li><li><a href="/analytics/summary.json.php">summary.json</a></li><li><a href="/analytics/responses.csv.php">responses.csv</a></li></ul>
<p>Apps Script connector sample: <code>/analytics/looker_connector_sample/Code.gs</code></p>
</div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
