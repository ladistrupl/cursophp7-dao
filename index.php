<?
require_once("config.php");

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios;");

echo json_encode($usuarios,JSON_PRETTY_PRINT);

echo "<hr><br>";

// Carrega um usuario
$user = new Usuario();

$user->loadById("2");

echo $user;
echo "<hr><br>";
//Carrega a lista de usuarios
$lista = Usuario::getList();

echo json_encode($lista,JSON_PRETTY_PRINT);
echo "<hr><br>";

$logins = Usuario::searchLogin("no");

echo json_encode($logins,JSON_PRETTY_PRINT);
echo "<hr><br>";

//Testa se usuario e senha existem
$user1 = new Usuario;
$user1->login("test","4321");

echo $user1;
echo "<hr><br>";
/*
//Inserindo um usuario
$aluno = new Usuario();
$aluno->setDsLogin("aluno2");
$aluno->setDsSenha("12345");

$aluno->insert();

echo $aluno;
echo "<hr><br>";
*/

//Alterando usuario e senha
$usuario = new Usuario();
$usuario->loadById("5");
$usuario->update("Professor","54321");

echo $usuario;
echo "<hr><br>";

/*
//Apagando registro
$usuario = new Usuario();
$usuario->loadById("4");
$usuario->delete();
echo $usuario;
echo "<hr><br>";
*/


?>