<?php

require_once("config.php");

$user = new Usuario();
//$user->loadById(16);
//echo $user;
$lista = Usuario::getList();
echo json_encode($lista);
//$busca = Usuario::search("Holandes");
//echo json_encode($busca);
//$logar = new Usuario();
//$logar->login("Teste", "123456789");
//echo $logar;
//$aluno = new Usuario("aluno", "123456");
//$aluno->insert();
//echo $aluno;
//$usuario = new Usuario();
//$usuario->loadById(19);
//$usuario->update("aluno123", "123456");
//echo $usuario;

//$user = new Usuario();

//$user->loadById(19);
//$user->delete();

//echo $user;
?>