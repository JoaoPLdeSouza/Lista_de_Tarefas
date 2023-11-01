<?php


    include 'conexao.php';
    
    session_start();

    # TRECHO QUE REALIZA A CONSULTA DE TODOS 
    # OS REGISTROS DO BANCO DE DADOS E MONTA 
    # A LISTAGEM

    $sql = " SELECT * FROM tarefas ";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $dados = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Lista.css">
</head>
<body>
    <header>
        <nav class="topo">
            <h3><?php print $_SESSION['nome'] ?></h3>
            <i class="bi bi-person-circle"></i>
        </nav>
    </header>

    <section>
        <nav class="menu-lateral">
            <div class="btn-expandir">
                <i class="bi bi-three-dots-vertical" id="btn-exp"></i>
            </div>

            <ul type="none">
                <li class="item-menu ativo">
                    <a href="#">
                        <span class="icone"><i class="bi bi-list-task"></i></span>
                        <span class="txt-link">Lista</span>
                    </a>
                </li>

                <li class="item-menu">
                    <a href="#">
                        <span class="icone"><i class="bi bi-plus-square-fill"></i></span>
                        <span class="txt-link">Nova Tarefa</span>
                    </a>
                </li>

                <li class="item-menu">
                    <a href="#">
                        <span class="icone"><i class="bi bi-check-circle-fill"></i></span>
                        <span class="txt-link">Concluidas</span>
                    </a>
                </li>

                <li class="item-menu">
                    <a href="Logout.php">
                        <span class="icone"><i class="bi bi-box-arrow-left"></i></span>
                        <span class="txt-link">Sair</span>
                    </a>
                </li>
            </ul>
        </nav>
        <script src="menuLateral.js"></script>
    </section>

    <main>
        <table>
            <tr>
                <th>Tarefas</th>
                <th>Status</th>
                <th>Prioridade</th>
                <th>Prazo</th>
                <th>Ações</th>
            </tr>

            <!-- Acrescenta mais um para cada um criado -->
            <tr>
                <td>Dados do BD</td>
                <td>Dados do BD</td>
                <td>Dados do BD</td>
                <td>Dados do BD</td>
                <td><a href="#"><i class="bi bi-pen-fill"></i></a> <a href="#"><i class="bi bi-dash-square-fill"></i></a> </td>
            </tr>

            <?php foreach($dados as $linha) { ?>
            <tr>
                <td><?php echo $linha->nome_tarefa ?></td>
                <td><?php echo $linha->status ?></td>
                <td><?php echo $linha->prioridade ?></td>
                <td><?php echo $linha->prazo ?></td>
                <td>
                    <a href="index.php?id=<?php echo $linha->id ?>"><i class="bi bi-pen-fill"></i></a> | 
                    <a href="excluir.php?id=<?php echo $linha->id ?>"><i class="bi bi-dash-square-fill"></i></a>
                </td>
            </tr>
        <?php } ?>
        </table>
    </main>

    <footer>
        <nav class="refs">
            <a href="#"><i class="bi bi-github"></i></a>
            <h3>João Paulo Lima</h3>
        </nav>
    </footer>
</body>
</html>