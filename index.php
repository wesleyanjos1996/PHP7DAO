<?php

require_once("config.php");

/*
$sql = new SQL();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios)
*/

/*
// Carrega um usuário
$root = new Usuario();
$root->laodById(4);
echo $root;
*/

/*
// Carrega uma lista de usuários
$list = Usuario::getList();
echo json_encode($list);
*/

/*
// Carrega uma lista de usuário por login
$search = Usuario::search("root");
echo json_encode($search);
*/

// Carrega um usuário usando o login e a senha
$user = new Usuario();
$user->login("user", "12345");
echo $user;
?>