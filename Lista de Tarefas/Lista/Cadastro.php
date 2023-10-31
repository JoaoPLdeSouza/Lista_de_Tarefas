<?php

    $login = $_POST['login'];
    $senha = MD5($_POST['senha']);
    $connect = mysqli_connect('localhost:3306','root','');
    $db = mysqli_select_db('tb_lista');
    $query_select = "SELECT login FROM usuarios WHERE login = '$login'";
    $select = mysql_query($query_select,$connect);
    $array = mysql_fetch_array($select);
    $logarray = $array['login'];

        if($logarray == $login){

            echo"<script language='javascript' type='text/javascript'>
            alert('Esse login já existe');window.location.href='
            cadastro.html';</script>";
            die();

        }else{
            $query = "INSERT INTO usuarios (nome,senha) VALUES ('$login','$senha')";
            $insert = mysql_query($query,$connect);

            if($insert){
            echo"<script language='javascript' type='text/javascript'>
            alert('Usuário cadastrado com sucesso!');window.location.
            href='login.html'</script>";
            }else{
            echo"<script language='javascript' type='text/javascript'>
            alert('Não foi possível cadastrar esse usuário');window.location
            .href='cadastro.html'</script>";
            }
        }
        
?>
