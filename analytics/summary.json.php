<?php
require_once __DIR__.'/../config.php'; require_role(['admin','staff']); header('Content-Type: application/json');
$rows=$pdo->query("SELECT DATE(created_at) date, f.name form, AVG(score) avg_score, COUNT(*) responses FROM form_responses fr JOIN forms f ON f.id=fr.form_id GROUP BY DATE(created_at), f.name ORDER BY DATE(created_at) DESC")->fetchAll();
echo json_encode($rows); exit;
?>
