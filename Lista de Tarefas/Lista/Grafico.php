<?php


  include 'conexao.php';
    
  session_start();

  # TRECHO QUE REALIZA A CONSULTA DE TODOS 
  # OS REGISTROS DO BANCO DE DADOS E MONTA 
  # A LISTAGEM

  $id = $_SESSION['id'];

  $SA = $pdo -> prepare("SELECT entrega, COUNT(entrega) AS Qtd FROM tarefas_concluidas WHERE cod_usuariof = '$id' AND cod_statusf = 4");
  $SA -> execute();
  $conc = $SA->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Grafico.css">
</head>
<body>
    <header class="topo">
          <h3><?php print $_SESSION['nome'] ?></h3>
          <i class="bi bi-person-circle"></i> 
    </header>

    <section>
        <nav class="menu-lateral">
            <div class="btn-expandir">
                <i class="bi bi-three-dots-vertical" id="btn-exp"></i>
            </div>

            <ul type="none">
                <li class="item-menu">
                    <a href="http://localhost:83/Lista/Lista.php">
                        <span class="icone"><i class="bi bi-list-task"></i></span>
                        <span class="txt-link">Lista</span>
                    </a>
                </li>

                <li class="item-menu ativo">
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

    <main>
        <div class="grafico">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load("current", {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Quantidade", { role: "style" } ],
                <?php foreach($conc as $coluna) {?>
                [<?php print strtotime($coluna->entrega)?>, <?php print $coluna->Qtd?>, "#b87333"],
                <?php } ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            var options = {
                title: "Density of Precious Metals, in g/cm^3",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
            </script>
            <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
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