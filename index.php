<?php

require_once("config.php");

/*
$sql = new SQL();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios)
*/

$root = new Usuario();
$root->laodById(4);
echo $root;

?>