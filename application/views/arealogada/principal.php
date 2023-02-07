<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <title>Controle de IPads :: Principal</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="<?= base_url() ?>/images/favicon-marjan.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url() ?>/css/estilo.css">
  <script src="https://kit.fontawesome.com/802204386a.js" crossorigin="anonymous"></script>

  <style>
    .menu_card {
      padding: 15px;
      float: left;
      background: linear-gradient(to left, #aedfef 0%, #fff 100%);
      margin: 15px;
      border-radius: 5px;
      text-align: center;
      width: 220px;
      display: table;
      height: 130px;
      color: #457c8f;
      cursor: pointer;
    }
  </style>

</head>

<body>

  <?php $this->load->view('arealogada/includes/menu.php'); ?>

    <?php
    if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT'])) {
    ?>
      <div class="menu_card" attr-link="ipads/ipads">
        <i class="fa fa-plus-circle" style="font-size: 35px;"></i>
        <div style="margin-top: 10px;">Cadastro de novos IPads</div>
      </div>
    <?php
    }
    ?>

    <?php
    if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT'])) {
    ?>
      <div class="menu_card" attr-link="ipads/atribuicao" style="display: none;">
        <i class="fa fa-user-plus" style="font-size: 35px;"></i>
        <div style="margin-top: 10px;">Atribuição</div>
      </div>
    <?php
    }
    ?>

    <?php
    if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT'])) {
    ?>
      <div class="menu_card" attr-link="chips/chips">
        <i class="fas fa-sim-card" style="font-size: 35px;"></i>
        <div style="margin-top: 10px;">Controle dos CHIPS</div>
      </div>
    <?php
    }
    ?>

    <?php
    if (in_array($_SESSION['id_modulo'], ['ITE', 'FAT'])) {
    ?>
      <div class="menu_card" attr-link="desligados/desligados">
        <i class="fa fa-solid fa-users-slash" style="font-size: 35px;"></i>
        <div style="margin-top: 10px;">Usuarios Desligados</div>
      </div>
    <?php
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
      $(".menu_card").click(function() {
        location.href = $(this).attr('attr-link');
      });
    </script>

</body>

</html>