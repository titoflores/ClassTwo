<?php
session_start();
require_once '../controlador/CBibliotecario.php';

$email = $_GET['email'];
$password = $_GET['password'];
//echo $email.$password;
$bibliotecario = new CBibliotecario();
$result = $bibliotecario->authLogin($email, $password);
$usu = mysql_fetch_array($result);

if ($email == $usu[0] && $password == $usu[1]){
    $_SESSION['usuario']=$usu[0];
    header('Location: ../vista/index.php');
} else {
    header('Location: ../login.php?mensage');
}