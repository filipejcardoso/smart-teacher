<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/selectdisciplina.css">
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
              <th width="10%">Índice</th>
              <th width="90%">Nome da disciplina</th>
          </tr>
        </thead>

        <tbody>
          
          <?php $i=1; foreach ($disciplinas as $disciplina) {?>
          <tr onclick="window.location = '/createsala?disciplina=<?php echo $disciplina->getId(); ?>'">
            <td><?php echo $i; ?></td>
            <td><?php echo strtoupper_utf8($disciplina->getDescricao()); ?></td>
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
