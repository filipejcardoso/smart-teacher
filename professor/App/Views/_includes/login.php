<?php
if(!isset($_SESSION))
     session_start();


  if(@$_SESSION['LOGADO'] != 1)
  {
    $_SESSION['LOGADO'] = 0;
    header('location:/login');
    exit();
  }
?>