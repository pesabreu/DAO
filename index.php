<?php

require_once("config.php");

// forma incorreta de usar, mas funciona.
//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM usuarios");
//echo json_encode($usuarios);


$user = new Usuario();
$user->loadById(1);
echo $user;

//$lista = Usuario::getList();
//echo json_encode($lista);

//$busca = Usuario::search("Holandes");
//echo json_encode($busca);

//$logar = new Usuario();
//$logar->login("Teste", "123456789");
//echo $logar;

//$aluno = new Usuario("aluno", "123456");
//$aluno->insert();
//echo $aluno;

//$usuario = new Usuario();
//$usuario->loadById(5);
//$usuario->update("aluno123", "123456");
//echo $usuario;

//$user = new Usuario();
//$user->loadById(2);
//$user->delete();
//echo $user;

?>