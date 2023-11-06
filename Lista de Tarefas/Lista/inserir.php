<?php

    include 'conexao.php';

    session_start();

    $nTarefa = $_POST['tarefa'];
    $stat = $_POST['status'];
    $priori = $_POST['prioridade'];
    $praz = $_POST['prazo'];
    $id = $_SESSION['id'];

    echo 

    $sql = "INSERT INTO tarefas (nome_tarefa, cod_status, prioridade, prazo, cod_usuarios) VALUES ('$nTarefa','$stat','$priori','$praz','$id')";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    header("Location:  Lista.php");
?>