<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/createsala.css">
    </head>
    
    <body>

      <?php include("_includes/_sidenav/sidenav.php"); ?>

      <main>
        <!-- CABEÇALHO --> 
        <?php include("_includes/_cabecalho/cabecalho.php"); ?>

        <form method="post" action="/createsala-request">
        <div class="box_criar_sala">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col l12">
                Descrição da Prova
                <input id="descricao" name="descricao" type="text">
              </div>
            </div>
            <div class="row">
              <div class="input-field col l12">
                Número Máximo de Alunos
                <input id="nalunos" name="nalunos" type="text">
              </div>
            </div>
            <div class="row">
              <div class="input-field col l12">
                Tempo Máximo da Prova (min)
                <input id="tempomax" name="tempomax" type="text">
              </div>
            </div>
            <div class="row">
              <div class="input-field col l12">
                Decréscimo de questões incorretas
                <input id="incorreta" name="incorreta" type="text">
              </div>
            </div>
            <div class="row">
              <div class="input-field col l12">
                <h6><?php echo strtoupper_utf8($disciplina); ?></h6>
              </div>
            </div>
            <div class="row">
              <div class="input-field col l12">
              <h5>QUESTÕES POR TEMA</h5>
              </div>
            </div>

            <?php $i=0; foreach ($temas as $tema) {?>
            <div class="row">
              <div class="input-field col l4">
                <?php echo strtoupper_utf8($tema->getDescricao())." (".$numero_questoes[$i].")"; ?>
              </div>
              <div class="input-field col l8 left">
                <input type="hidden" name="tema_<?php echo $i; ?>" value="<?php echo $tema->getId(); ?>">
                <input type="number" min="0" max="<?php echo $numero_questoes[$i]; ?>" name="nquestoes_tema_<?php echo $i; ?>" id="nquestoes">
              </div>
            </div>
            <?php $i++; } ?>

            <input type="hidden" name="size_temas" value="<?php echo $i; ?>">
            <input type="hidden" name="disciplina" value="<?php echo $id_disciplina; ?>">

            <div class="row">
              <div class="input-field col l12 center">
              <button type='submit' name='btn_login' class='waves-effect waves-light btn-flat green white-text'>
              <i class="material-icons left">done_all</i>CRIAR SALA</button>
              </div>
            </div>
          </form>
        </div> 
        </div> 
        </form>        
      </main>

      <!-- RODAPÉ -->
      <?php include("_includes/_rodape/rodape.php"); ?>

    </body>
</html>
