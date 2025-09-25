<?php
require_once __DIR__.'/../config.php'; require_once __DIR__.'/../i18n.php'; require_role('admin'); csrf_check();
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='save_form'){ $id=(int)($_POST['id']??0); $name=trim($_POST['name']??''); $desc=trim($_POST['description']??''); if($id){ $pdo->prepare("UPDATE forms SET name=?,description=? WHERE id=?")->execute([$name,$desc,$id]); } else { $pdo->prepare("INSERT INTO forms(name,description) VALUES(?,?)")->execute([$name,$desc]); $id=(int)$pdo->lastInsertId(); } flash('Form saved'); header('Location:/admin/forms.php?edit='.$id); exit; }
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='save_section'){ $form_id=(int)$_POST['form_id']; $id=(int)($_POST['id']??0); $title=trim($_POST['title']??''); $weight=(float)($_POST['weight']??1); if($id){ $pdo->prepare("UPDATE sections SET title=?,weight=? WHERE id=? AND form_id=?")->execute([$title,$weight,$id,$form_id]); } else { $pdo->prepare("INSERT INTO sections(form_id,title,weight) VALUES(?,?,?)")->execute([$form_id,$title,$weight]); $id=(int)$pdo->lastInsertId(); } flash('Section saved'); header('Location:/admin/forms.php?edit='.$form_id.'#s'.$id); exit; }
if($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='save_question'){ $section_id=(int)$_POST['section_id']; $id=(int)($_POST['id']??0); $text=trim($_POST['text']??''); $scale_max=(int)($_POST['scale_max']??5); $weight=(float)($_POST['weight']??1); $item_bank_id=(int)($_POST['item_bank_id']??0);
 if($id){ $pdo->prepare("UPDATE questions SET text=?,scale_max=?,weight=?,item_bank_id=? WHERE id=? AND section_id=?")->execute([$text,$scale_max,$weight,$item_bank_id,$id,$section_id]); } else { $pdo->prepare("INSERT INTO questions(section_id,text,scale_max,weight,item_bank_id) VALUES(?,?,?,?,?)")->execute([$section_id,$text,$scale_max,$weight,$item_bank_id]); }
 $form_id=(int)($pdo->query("SELECT form_id FROM sections WHERE id=$section_id")->fetch()['form_id']); flash('Question saved'); header('Location:/admin/forms.php?edit='.$form_id.'#sec'.$section_id); exit; }
if(isset($_GET['delete_question'])){ $pdo->prepare("DELETE FROM questions WHERE id=?")->execute([(int)$_GET['delete_question']]); flash('Question deleted'); header('Location:/admin/forms.php?edit='.(int)($_GET['edit']??0)); exit; }
if(isset($_GET['delete_section'])){ $pdo->prepare("DELETE FROM sections WHERE id=?")->execute([(int)$_GET['delete_section']]); flash('Section deleted'); header('Location:/admin/forms.php?edit='.(int)($_GET['edit']??0)); exit; }
if(isset($_GET['delete_form'])){ $pdo->prepare("DELETE FROM forms WHERE id=?")->execute([(int)$_GET['delete_form']]); flash('Form deleted'); header('Location:/admin/forms.php'); exit; }
$forms=$pdo->query("SELECT * FROM forms ORDER BY id DESC")->fetchAll(); $edit=isset($_GET['edit'])?(int)$_GET['edit']:0; $sections=$edit?$pdo->query("SELECT * FROM sections WHERE form_id=$edit ORDER BY id")->fetchAll():[];
$questions_by_section=[]; 
if($edit){ 
  foreach($sections as $s){ $sid=(int)$s['id']; $questions_by_section[$sid]=$pdo->query("SELECT * FROM questions WHERE section_id=$sid ORDER BY id")->fetchAll(); } 
}
$item_banks=$pdo->query("SELECT id,name FROM item_banks ORDER BY id")->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=t('forms')?></title>
<link rel="stylesheet" href="/public/vendor/adminlte/css/adminlte.min.css"><link rel="stylesheet" href="/public/vendor/fontawesome/css/all.min.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body class="hold-transition sidebar-mini"><div class="wrapper"><?php include __DIR__.'/../templates/header.php'; ?>
<div class="content-wrapper p-3"><h1><?=t('forms')?></h1><?php if($m=flash()):?><div class="alert alert-success"><?=$m?></div><?php endif;?>
<div class="card card-body mb-3"><form method="post"><input type="hidden" name="csrf" value="<?=csrf_token()?>"><input type="hidden" name="action" value="save_form"><input type="hidden" name="id" value="<?=$edit?>">
<div class="row"><div class="col-md-4"><input class="form-control" name="name" placeholder="Form name" value="<?php if($edit){ $x=$pdo->query('SELECT name FROM forms WHERE id='.$edit)->fetch(); echo htmlspecialchars($x['name']??''); } ?>"></div>
<div class="col-md-6"><input class="form-control" name="description" placeholder="Description" value="<?php if($edit){ $x=$pdo->query('SELECT description FROM forms WHERE id='.$edit)->fetch(); echo htmlspecialchars($x['description']??''); } ?>"></div>
<div class="col-md-2"><button class="btn btn-primary"><i class="fas fa-save"></i> Save</button></div></div></form></div>
<div class="row"><div class="col-md-4">
<div class="card"><div class="card-header"><strong>All forms</strong></div><div class="card-body"><ul class="list-unstyled">
<?php foreach($forms as $f): ?><li><a href="?edit=<?=$f['id']?>"><?=htmlspecialchars($f['name'])?></a> <a class="text-danger ml-2" onclick="return confirm('Delete?')" href="?delete_form=<?=$f['id']?>"><i class="fas fa-trash"></i></a></li><?php endforeach; ?>
</ul></div></div>
<?php if($edit): ?><div class="card mt-3"><div class="card-header"><strong>New section</strong></div><div class="card-body">
<form method="post"><input type="hidden" name="csrf" value="<?=csrf_token()?>"><input type="hidden" name="action" value="save_section"><input type="hidden" name="form_id" value="<?=$edit?>">
<input class="form-control mb-2" name="title" placeholder="Section title"><input class="form-control mb-2" name="weight" value="1" placeholder="Weight"><button class="btn btn-secondary"><i class="fas fa-plus"></i> Add Section</button></form>
</div></div><?php endif; ?>
</div><div class="col-md-8">
<?php foreach($sections as $s): ?><div class="card mb-3" id="sec<?=$s['id']?>"><div class="card-header"><strong><?=htmlspecialchars($s['title'])?></strong><a class="text-danger float-right" onclick="return confirm('Delete section?')" href="?edit=<?=$edit?>&delete_section=<?=$s['id']?>"><i class="fas fa-trash"></i></a></div><div class="card-body">
<form method="post" class="mb-3"><input type="hidden" name="csrf" value="<?=csrf_token()?>"><input type="hidden" name="action" value="save_question"><input type="hidden" name="section_id" value="<?=$s['id']?>">
<div class="row"><div class="col-md-6"><input class="form-control mb-2" name="text" placeholder="Question text"></div>
<div class="col-md-2"><input class="form-control mb-2" name="scale_max" value="5" placeholder="Scale max"></div>
<div class="col-md-2"><input class="form-control mb-2" name="weight" value="1" placeholder="Weight"></div>
<div class="col-md-2"><select class="form-control mb-2" name="item_bank_id"><option value="0">No bank</option>
<?php foreach($item_banks as $ib): ?><option value="<?=$ib['id']?>"><?=htmlspecialchars($ib['name'])?></option><?php endforeach; ?>
</select></div></div><button class="btn btn-secondary"><i class="fas fa-plus"></i> Add question</button></form>
<table class="table table-sm"><tr><th>ID</th><th>Text</th><th>Scale</th><th>Weight</th><th>Item bank</th><th></th></tr>
<?php foreach($questions_by_section[$s['id']] as $q): ?><tr><td><?=$q['id']?></td><td><?=htmlspecialchars($q['text'])?></td><td>1..<?=$q['scale_max']?></td><td><?=$q['weight']?></td><td><?=$q['item_bank_id']?></td><td><a class="text-danger" onclick="return confirm('Delete?')" href="?edit=<?=$edit?>&delete_question=<?=$q['id']?>"><i class="fas fa-trash"></i></a></td></tr><?php endforeach; ?>
</table></div></div><?php endforeach; ?>
</div></div></div><?php include __DIR__.'/../templates/footer.php'; ?></div></body></html>
<?php
?>
