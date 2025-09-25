<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_role('admin'); csrf_check();
if(isset($_GET['delete'])){ $id=(int)$_GET['delete']; if($id!==(int)current_user_id()){ $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]); flash('User deleted'); } header("Location:/admin/users.php"); exit; }
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['username'])){
  $u=trim($_POST['username']); $pw=$_POST['password']?password_hash($_POST['password'],PASSWORD_DEFAULT):null; $role=(($_POST['role']??'staff')==='admin')?'admin':'staff'; $name=trim($_POST['full_name']??''); $email=trim($_POST['email']??'');
  if(isset($_POST['id']) && $_POST['id']){ $id=(int)$_POST['id']; if($pw){ $pdo->prepare("UPDATE users SET username=?,password=?,role=?,full_name=?,email=? WHERE id=?")->execute([$u,$pw,$role,$name,$email,$id]); } else { $pdo->prepare("UPDATE users SET username=?,role=?,full_name=?,email=? WHERE id=?")->execute([$u,$role,$name,$email,$id]); } flash('User updated'); }
  else { $pdo->prepare("INSERT INTO users(username,password,role,full_name,email) VALUES (?,?,?,?,?)")->execute([$u,password_hash($_POST['password'] or 'ChangeMe123!',PASSWORD_DEFAULT),$role,$name,$email]); flash('User created'); }
  header("Location:/admin/users.php"); exit;
}
$users=$pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('users')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=t('users')?></h1><?php if($m=flash()):?><div class="alert alert-success"><?=$m?></div><?php endif;?>
<form method="post" class="card card-body mb-3"><input type="hidden" name="csrf" value="<?=csrf_token()?>">
<div class="row"><div class="col"><input class="form-control" name="username" placeholder="username"></div>
<div class="col"><input class="form-control" type="password" name="password" placeholder="password"></div>
<div class="col"><select class="form-control" name="role"><option value="staff">staff</option><option value="admin">admin</option></select></div></div>
<div class="row mt-2"><div class="col"><input class="form-control" name="full_name" placeholder="full name"></div>
<div class="col"><input class="form-control" name="email" placeholder="email"></div>
<div class="col"><button class="btn btn-primary"><i class="fas fa-save"></i> Save</button></div></div></form>
<table class="table table-sm table-striped"><tr><th>ID</th><th>Username</th><th>Role</th><th>Name</th><th>Email</th><th></th></tr>
<?php foreach($users as $u):?><tr><td><?=$u['id']?></td><td><?=htmlspecialchars($u['username'])?></td><td><?=htmlspecialchars($u['role'])?></td><td><?=htmlspecialchars($u['full_name'])?></td><td><?=htmlspecialchars($u['email'])?></td><td><a class="btn btn-sm btn-danger" href="?delete=<?=$u['id']?>" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i></a></td></tr><?php endforeach; ?></table>
</div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
