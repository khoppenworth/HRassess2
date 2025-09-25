<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_role('admin'); csrf_check();
if($_SERVER['REQUEST_METHOD']==='POST'){ $name=trim($_POST['name']??''); $id=(int)($_POST['id']??0); if($id){ $pdo->prepare("UPDATE item_banks SET name=? WHERE id=?")->execute([$name,$id]); } else { $pdo->prepare("INSERT INTO item_banks(name) VALUES (?)")->execute([$name]); } header("Location:/admin/item_banks.php"); exit; }
if(isset($_GET['delete'])){ $pdo->prepare("DELETE FROM item_banks WHERE id=?")->execute([(int)$_GET['delete']]); header("Location:/admin/item_banks.php"); exit; }
$banks=$pdo->query("SELECT * FROM item_banks ORDER BY id DESC")->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('item_banks')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=t('item_banks')?></h1>
<form method="post" class="card card-body mb-3"><input type="hidden" name="csrf" value="<?=csrf_token()?>"><div class="row">
<div class="col-md-8"><input class="form-control" name="name" placeholder="Bank name"></div><div class="col-md-4"><button class="btn btn-primary"><i class="fas fa-save"></i> Save</button></div></div></form>
<table class="table table-sm table-striped"><tr><th>ID</th><th>Name</th><th></th></tr>
<?php foreach($banks as $b): ?><tr><td><?=$b['id']?></td><td><?=htmlspecialchars($b['name'])?></td><td><a class="text-danger" onclick="return confirm('Delete?')" href="?delete=<?=$b['id']?>"><i class="fas fa-trash"></i></a></td></tr><?php endforeach; ?></table>
</div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
