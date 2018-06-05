
<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/index.css">
    </head>
    
    <body>

      <?php include("_includes/_sidenav/sidenav.php"); ?>

      <main>
        <!-- CABEÇALHO --> 
        <?php include("_includes/_cabecalho/cabecalho.php"); ?>

       <!-- BANNER --> 
        <div class="row banner">
        <div class="mascara col l12">
        <div class="col s12 m6 l8 default-text-color-2">
                <h3>IEEE Computer Society</h3>
                <span class="banner_msg">The IEEE Computer Society is the world's leading membership organization dedicated to computer science and technology. Serving more than 60,000 members, the IEEE Computer Society is the trusted information, networking, and career-development source for a global community of technology leaders that includes researchers, educators, software engineers, IT professionals, employers, and students.</span>
        </div>
          <div class="col s12 m6 l4">
            <div class="col s12"> 
            <a href="/selectdisciplina"><button class="btn banner_bt1 white"> CRIAR SALA <i class="fa fa-arrow-circle-right"></i></button></a></div>

            <div class="col s12"> 
            <a href="/App/Arquivos/descritivo.pdf" target="_blank"><button class="btn banner_bt2 black"> SOBRE O APP <i class="fa fa-question-circle"></i></button></a></div>
          </div>
        </div>
        </div>

        <!--INICIO SALAS ATIVAS-->
        <div class="row salas_ativas">
          <div class="col-content">

            <?php $i=0; foreach($recentes as $recente) { ?>
            <?php switch($i){case 0:$color="blue-grey darken-1";break;case 1:$color="blue darken-4";break;case 2:$color="red darken-4";break;} ?>
            <div class="card <?php echo $color; ?> salas_ativas_info col l3">
              <div class="card-content white-text">
                <span class="card-title"><?php echo $recente->getDescricao(); ?></span>
                <h6>DATA: <?php echo $recente->getData(); ?></h6>
                <h5>ALUNOS NA SALA: <?php echo $recente->getAlunos(); ?></h5>
                <h6>maior nota: <?php echo number_format($recente->getMaiorNota(),'2'); ?></h6>
                <h6>menor nota: <?php echo number_format($recente->getMenorNota(),'2'); ?></h6>
                </br>
                <h5>MÉDIA DA SALA: <?php echo number_format($recente->getMedia(),'2'); ?></h5>
              </div>

              <div class="card-action">
                <a href="/estatisticas?sala=<?php echo $recente->getId(); ?>">Visualizar Estatísticas</a>
              </div>
            </div>
            <?php $i++; } ?>

          </div>
        </div>
        <!-- FIM SALAS ATIVAS-->


      </main>

      <!-- RODAPÉ -->
      <?php include("_includes/_rodape/rodape.php"); ?>

    </body>
</html>
