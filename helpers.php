<?php
function h($s){return htmlspecialchars((string)$s,ENT_QUOTES,'UTF-8');}
function redirect(string $p){header('Location: '.$p);exit;}
function post($k,$d=''){return $_POST[$k]??$d;}
function get($k,$d=''){return $_GET[$k]??$d;}
