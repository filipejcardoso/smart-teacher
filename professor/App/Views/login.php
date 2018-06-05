<?php
if(!isset($_SESSION))
     session_start();

$_SESSION['LOGADO'] = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FEG - Computer Society</title>
    <meta name="description" content="App gerenciamento de aplicação de provas">
    <meta name="keywords" content="IEE, Computer, Society, FEG, Unesp">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Filipe Julio Cardoso">
    <meta name="theme-color" content="#c62828">
    <link rel="stylesheet" href="/App/Views/_includes/_css/materialize.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <lin rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="icon" href="/App/Views/_images/favicon.png">
    <link rel="stylesheet" href="/App/Views/_includes/_css/login.css">
<body>
  <div class="section"></div>
  <main>
    <center>
      <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" />
      <div class="section"></div>

      <h5 class="indigo-text">Bem-Vindo, faça o login na sua conta</h5>
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" action="/confirm-login" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='usuario' id='usuario' />
                <label for='usuario'>Entre com seu usuario</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='senha' id='senha' />
                <label for='senha'>Entre com sua senha</label>
              </div>
              <label style='float: right;'>
                <a class='pink-text' href='#!'><b>Esqueceu sua senha?</b></a>
              </label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
      <a href="#!">Deseja criar uma conta? Entre em contato com a CS IEEE - FEG</a>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>