<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>

	  <title>Portal Controle de IPads</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	  <link rel="shortcut icon" href="images/favicon-marjan.png" type="image/x-icon">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
      body {
        font-family: verdana;
        color:  #003c4d;
      }
      body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: -1;
        background-image: url(images/resp-social-marjan-side.png);
        background-size: contain;
      }
    </style>
	
  </head>
  <body>
    <div style="margin: 0 auto; text-align: center; margin-top: 70px;">
      <div>
        <img src="https://marjan.com.br/application/uploads/general_settings/logo-marjan-27XU1227X1.png" style="width: 150px;">
      </div>
      <div style="margin: 20px 0; font-size: 25px; text-shadow: 2px 2px 5px #fff;">
        Portal Controle de IPads
      </div>  
    </div>
  
    <div style="width: 250px; margin: 0 auto; font-size: 15px; color: #fff;">
      <div class="form-group">
        <label for="email">Usuário:</label>
        <input type="text" NAME="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="pass">Senha:</label>
        <INPUT TYPE="password" NAME="pass" id="pass" class="form-control">
      </div>
      <div class="form-group">
        <input id="btnEntrar" type="button" value="Entrar" class="form-control btn btn-secondary">
      </div>
    </div>
   
    <div id="msg" style="text-align: center; padding: 20px; color: #fff;"></div>
   
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/login.js?v=1"></script>
    
  </body>
</html>