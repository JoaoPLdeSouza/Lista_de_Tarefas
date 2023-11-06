<?php

    include 'conexao.php';

    session_start();

    $idtar = $_SESSION['idtar'];
    $nome = $_POST['tarefa'];
    $stat = $_POST['status'];
    $priori = $_POST['prioridade'];
    $prazo = $_POST['prazo'];

    $update = "UPDATE tarefas SET nome_tarefa='$nome', cod_status='$stat', prioridade='$priori', prazo = '$prazo' WHERE id_tarefas = '$idtar' ";
    $up = $pdo -> prepare($update);
    $up -> execute();
    header("Location:Lista.php");
?>