<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/estatisticas.css">
    </head>
    
    <body>

      <?php include("_includes/_sidenav/sidenav.php"); ?>

      <main>
        <!-- CABEÇALHO --> 
        <?php include("_includes/_cabecalho/cabecalho.php"); ?>

        <div class="row box_estatisticas_info">
          <div class="col s12 center"><h5>RELATÓRIO ESTATÍSTICO</h5></div>
          <div class="col s12 center"><h5>MÉDIA DA SALA: <?php echo number_format($media,'2'); ?></h5></div>
          <div class="col s12 center"><h6>MAIOR NOTA: <?php echo number_format($maior_nota,'2'); ?></div>
          <div class="col s12 center"><h6>MENOR NOTA: <?php echo number_format($menor_nota,'2'); ?></div>
        </div>

        <div class="row estatisticas_grafico">
          <div class="col s12 center">
          </div>
        </div>

      <div class="row alunos">
      <table class="col l12 alunos_tabela">
        <thead>
          <tr>
              <th>Índice</th>
              <th>Nome do Aluno</th>
              <th class="center">RA</th>
              <th class="center">Turma</th>
              <th class="center">Tempo de Prova (min)</th>
              <th class="center">Nota Final</th>
              <th class="center">Opções</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=1; foreach ($salas_alunos as $sala_aluno) {?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $sala_aluno->getNome(); ?></td>
            <td class="center"><?php echo $sala_aluno->getRa(); ?></td>
            <td class="center"><?php echo $sala_aluno->getTurma(); ?></td>
            <td class="center"><?php echo $sala_aluno->getTempoTermino(); ?></td>
            <td class="center"><?php echo number_format($sala_aluno->getNotaFinal(),'2'); ?></td>
            <td class="center">
              <a onclick="window.location='/prova?prova=<?php echo $sala_aluno->getId(); ?>'" class="waves-effect waves-light btn-flat purple white-text">
                <i class="material-icons left">timeline</i>Visualizar</a>
            </td>
          </tr>
          <?php $i++;} ?>
        </tbody>
      </table>
      </div>

      </main>

      <!-- RODAPÉ -->
      <?php include("_includes/_rodape/rodape.php"); ?>

    </body>
</html>
