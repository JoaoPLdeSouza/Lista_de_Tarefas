<?php


  include 'conexao.php';
    
  session_start();

  # TRECHO QUE REALIZA A CONSULTA DE TODOS 
  # OS REGISTROS DO BANCO DE DADOS E MONTA 
  # A LISTAGEM

  $id = $_SESSION['id'];

  $alt1 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 1 AND prioridade = 'Alta'");
  $alt1 ->execute();
  $infA1 = $alt1->fetchAll(PDO::FETCH_OBJ);

  $alt2 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 2 AND prioridade = 'Alta'");
  $alt2 ->execute();
  $infA2 = $alt2->fetchAll(PDO::FETCH_OBJ);

  $alt3 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 3 AND prioridade = 'Alta'");
  $alt3 ->execute();
  $infA3 = $alt3->fetchAll(PDO::FETCH_OBJ);

  $med1 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 1 AND prioridade = 'Media'");
  $med1 ->execute();
  $infM1 = $med1->fetchAll(PDO::FETCH_OBJ);

  $med2 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 2 AND prioridade = 'Media'");
  $med2 ->execute();
  $infM2 = $med2->fetchAll(PDO::FETCH_OBJ);
  
  $med3 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 3 AND prioridade = 'Media'");
  $med3 ->execute();
  $infM3 = $med3->fetchAll(PDO::FETCH_OBJ);

  $baix1 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 1 AND prioridade = 'Baixa'");
  $baix1 ->execute();
  $infB1 = $baix1->fetchAll(PDO::FETCH_OBJ);

  $baix2 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 2 AND prioridade = 'Baixa'");
  $baix2 ->execute();
  $infB2 = $baix2->fetchAll(PDO::FETCH_OBJ);

  $baix3 = $pdo -> prepare(" SELECT * FROM tarefas WHERE cod_usuarios = '$id' AND cod_status = 3 AND prioridade = 'Baixa'");
  $baix3 ->execute();
  $infB3 = $baix3->fetchAll(PDO::FETCH_OBJ);

  $idUPD = null;
  $nt = null;
  $st = null;
  $pr = null;
  $dt = null;

  if (!empty($_GET['id'])){
      $idUPD = $_GET['id'];
      $src = $pdo -> query("SELECT * FROM tarefas WHERE id_tarefas = '$idUPD'");
      $dados = $src -> fetch(PDO::FETCH_OBJ);
      $nt = $dados -> nome_tarefa;
      $st = $dados -> cod_status;
      $pr = $dados -> prioridade;
      $dt = new \DateTime($dados -> prazo, new \DateTimeZone('America/Sao_Paulo'));
      $_SESSION['idtar'] = $idUPD;
  }
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
    <header class="topo"> 
          <div class="inserir">
            <form method="POST" <?php echo ($idUPD == null)?'action="inserir.php"':'action="update.php"'?>>
                <label>Tarefa: <input type="text" name='tarefa' value ="<?php echo $nt?>" require></label>
                <label>Status: <select name="status" require></label>
                    <option value="1" <?php echo ($st == 1)?'selected':' '?>>Aguardando</option>
                    <option value="2" <?php echo ($st == 2)?'selected':' '?>>Iniciada</option>
                    <option value="3" <?php echo ($st == 3)?'selected':' '?>>Finalizando</option>
                </select>
                <label>Prioridade: <select name="prioridade" require></label>
                    <option value="Baixa"<?php echo ($pr == 'Baixa')?'selected':' '?>>Baixa</option>
                    <option value="Media"<?php echo ($pr == 'Media')?'selected':' '?>>Media</option>
                    <option value="Alta"<?php echo ($pr == 'Alta')?'selected':' '?>>Alta</option>
                </select>
                <label>Prazo: <input type="date" name="prazo" value ="<?php echo ($dt == null)? '':$dt -> format("Y-m-d")?>" require></label>
                <?php echo ($idUPD == null)?'<input class="add" type="submit" value="Criar Tarefa">':'<input class="add" type="submit" value="Editar">'?>
            </form>
          </div>

          <h3><?php print $_SESSION['nome'] ?></h3>
          <i class="bi bi-person-circle"></i> 
    </header>

    <section>
        <nav class="menu-lateral">
            <div class="btn-expandir">
                <i class="bi bi-three-dots-vertical" id="btn-exp"></i>
            </div>

            <ul type="none">
                <li class="item-menu ativo">
                    <a href="http://localhost:83/Lista/Lista.php">
                        <span class="icone"><i class="bi bi-list-task"></i></span>
                        <span class="txt-link">Lista</span>
                    </a>
                </li>

                <li class="item-menu">
                    <a href="http://localhost:83/Lista/Grafico.php">
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

    <main class="container">
    <div class="section-container">
      <div class="section">
        <div class="titleS">AGUARDANDO</div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Alta Prioridade</div> 
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infA1 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Média Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infM1 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Baixa Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infB1 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    
      <div class="section">
        <div class="titleS">INICIADA</div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Alta Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infA2 as $linha) {?>
                  <li class="post-it-item"><?php echo $linha->nome_tarefa?> | <?php echo $linha->prazo?><a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Média Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infM2 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Baixa Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infB2 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="section">
        <div class="titleS">FINALIZANDO</div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Alta Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infA3 as $linha) {?>
                  <li class="post-it-item"><?php echo $linha->nome_tarefa?> | <?php echo $linha->prazo?><a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
            </ul>
            </div>
          </div>
        </div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Média Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infM3 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="square-container">
          <div class="square">
            <div class="titleQ">Baixa Prioridade</div>
            <div class="post-it">
              <ul class="post-it-list">
                <?php foreach($infB3 as $linha) {?>
                  <li class="post-it-item"><?php print $linha->nome_tarefa?> | <?php print $linha->prazo?>  <a href="Lista.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-pen-fill"></i></a><a href="Excluir.php?id=<?php echo $linha->id_tarefas?>"><i class="bi bi-check-circle-fill"></i></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>

    <footer>
        <nav class="refs">
            <a href="#"><i class="bi bi-github"></i></a>
            <h3>João Paulo Lima</h3>
        </nav>
    </footer>
</body>
</html>