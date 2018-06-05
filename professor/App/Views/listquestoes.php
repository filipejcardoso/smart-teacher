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
              <th width="10%">Índice</th>
              <th width="45%">Título da questão</th>
              <th class="center" width="45%">Opções</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=1; foreach ($questoes as $questao) {?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo strtoupper_utf8($questao->getDescricao()); ?></td>
            <td class="center">
            	<a class="waves-effect waves-light btn-flat green white-text">
            		<i class="material-icons left">whatshot</i>Visualizar</a>
            	<a class="waves-effect waves-light btn-flat yellow darken-3 white-text">
            		<i class="material-icons left">edit</i>Editar</a>
            	<a class="waves-effect waves-light btn-flat red white-text">
            		<i class="material-icons left">delete</i>Excluir</a>
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
