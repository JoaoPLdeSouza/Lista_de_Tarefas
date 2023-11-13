<?php

include 'conexao.php';

session_start();

$id_usuario = $_SESSION['id'];

$id_tarefa = $_GET['id'];

// Incluir na tabela de concluidos

$ntc = null;
$praz = null;
$statc = null;

$search = $pdo -> query("SELECT * FROM tarefas WHERE id_tarefas = '$id_tarefa'");
$conc = $search -> fetch(PDO::FETCH_OBJ);
$ntc = $conc -> nome_tarefa;
$praz = new \DateTime($conc -> prazo, new \DateTimeZone('America/Sao_Paulo'));
$hoje = date('Y-m-d');
$praz_form = $praz -> format("Y-m-d");
if (strtotime($hoje) <= strtotime($praz_form)){
$statc = 4;
}
else{
$statc = 5;
}

$add = "INSERT INTO tarefas_concluidas (nome_tarefa, cod_statusf, prazo, entrega, cod_usuariof) VALUES ('$ntc', '$statc', '$praz_form', '$hoje', '$id_usuario')";
$statement = $pdo->prepare($add);
$statement->execute();

// Excluindo tarefa

$delete = "DELETE FROM tarefas WHERE id_tarefas = '$id_tarefa'";
$del = $pdo->prepare($delete);
$del->execute();

//voltando a pagina
header("Location:  Lista.php");
?> 