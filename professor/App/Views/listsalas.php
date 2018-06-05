<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/listdisciplinas.css">
    </head>
    
    <body>

      <?php include("_includes/_sidenav/sidenav.php"); ?>

      <main>
        <!-- CABEÇALHO --> 
        <?php include("_includes/_cabecalho/cabecalho.php"); ?>


      <div class="row disciplinas"> 
      <table class="col l12 disciplinas_tabela">
        <thead>
          <tr>
              <th>Índice</th>
              <th>Descrição da sala</th>
              <th class="center">Disciplina</th>
              <th class="center">Número Máximo de Alunos</th>
              <th class="center">Número de Questões</th>
              <th class="center">Data</th>
              <th class="center">Opções</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=1; foreach ($salas as $sala) {?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $sala->getDescricao(); ?></td>
            <td class="center"><?php echo $sala->getDisciplina(); ?></td>
            <td class="center"><?php echo $sala->getAlunosMax(); ?></td>
            <td class="center"><?php echo $sala->getNumeroQuestoes(); ?></td>
            <td class="center"><?php echo $sala->getDataAplicacao(); ?></td>
            <td class="center">
            	<a onclick="window.location='/estatisticas?sala=<?php echo $sala->getId(); ?>'" class="waves-effect waves-light btn-flat purple white-text">
            		<i class="material-icons left">timeline</i>Analisar</a>
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
