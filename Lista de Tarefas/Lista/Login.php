<?php

include 'conexao.php';

session_start();

$login = $_POST['login'];
$entrar = $_POST['entrar'];
$senha = $_POST['senha'];
  if (isset($entrar)) {

    $verifica = $pdo -> query("SELECT * FROM usuarios WHERE nome =
    '$login' AND senha = '$senha'") or die("erro ao selecionar");
      if ($verifica -> fetchColumn() <= 0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='Login.html';</script>";
        die();
      }else{
        //$pdo -> prepare("SELECT id_usuarios FROM usuarios WHERE nome = '$login' AND senha = '$senha' ");
        //$_SESSION['id'] = $busid;
        $_SESSION['nome'] = $login;
        header("Location:Lista.php");
      }
  }
?>
