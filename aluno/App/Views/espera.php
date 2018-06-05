<?php
if(!isset($_SESSION))
     session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <?php include("_includes/geral.php"); ?>
    <link rel="stylesheet" href="/App/Views/_includes/_css/espera.css">
<body>
  <main>
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
        <center><div class="img_espera"><img height="100%" width="100%" src="/App/Views/_images/_espera/espera.png"/></div></center>
  </main>
<input type="hidden" name="sala_ajax" id="sala_ajax" value="<?php echo $_SESSION['sala'];?>">
</body>

<form id="form_prova" method="post" action="/prova">
</form>
</html>
<script>
var sala = $("#sala_ajax").val();

function atualizar()
{
  $.ajax({type: "GET", url: "/espera-request?sala="+sala, async:false,
    success: function(value)
    {
        if(value == 2)
          $("#form_prova").submit();
    }});
}

atualizar();
setInterval(atualizar,800)

</script>
