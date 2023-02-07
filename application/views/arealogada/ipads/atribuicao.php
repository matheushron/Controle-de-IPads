<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <title>Controle de IPads :: Atribuição</title>

  <link rel="shortcut icon" href="<?= base_url() ?>/images/favicon-marjan.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    tr#tabela{
      text-align: center;
    }
  </style>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

  <?php $this->load->view('arealogada/includes/menu.php'); ?>
  <!-- Carrega o Menu superior -->

  <!-- Começo da tabela -->
  <div style="padding: 10px; margin: 15px; border: 1px solid silver;">
    <div style="border-bottom: 1px solid silver; color: #4f4f4f; margin-bottom: 10px;">
      <i class="fas fa-list"></i>
      <b>Atribuição</b>
    </div>

    <div>
      <div id="divConteudo" style="overflow: auto; height: 555px ">
        <table id="tabela" class="table table-striped table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Serial do IPad</th>
              <th>Editar</th>
            </tr>

            <tr>
              <th>--</th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtEmail" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtSerial" /></th>
              <th>--</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($tabela as $row) {
            ?>
              <tr id="tabela">
                <td><?= $row['ID'] ?></td>
                <td><?= $row['RESPONSAVEL'] ?></td>
                <td><?= $row['EMAIL'] ?></td>
                <td><?= $row['SERIAL'] ?></td>
                <td>
                  <button class="btn btn-info btn-sm" attr-id="<?= $row['ID'] ?>" onclick="btUpdate(this)">
                    <i class="far fa-edit"></i>
                  </button>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Fim da tabela -->

  <!-- começo da modal de editar -->
  <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="far fa-file"></i>
            IPads
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div>
            <div class="container-fluid">

              <div class="row">
                <input type="hidden" class="form-control" id="id">

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="responsavel">
                      Nome do(a) Responsável:
                    </label>
                    <input id="responsavel" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="email">
                      E-mail
                    </label>
                    <input id="email" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="serial">
                      Serial do IPad:
                    </label>
                    <select id="serial" class="form-control" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 3">
                      <option value=''>--</option>
                      <?php
                      foreach ($listEstoque as $value) {
                      ?>
                        <option value="<?= $value['SERIAL'] ?>"><?= $value['SERIAL'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

              </div>
            </div>
            <div class="form-row">
              <div id="msg" style="margin-left: 20px;"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="bt_delete">
            <i class="far fa-trash-alt"></i>
            Excluir IPad do colaborador
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="far fa-window-close"></i>
            Fechar
          </button>
          <button type="button" class="btn btn-success" id="bt_save">
            <i class="far fa-save"></i>
            Gravar novo serial de IPad
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- fim da model de editar -->


  <!-- Modal -->
  <div class="modal fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">
            <i class="far fa-trash-alt"></i>
            Confirmação
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Confirmar desassociação do IPad ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="far fa-window-close"></i>
            Cancelar
          </button>
          <button type="button" class="btn btn-danger" id="bt_confirm">
            <i class="far fa-trash-alt"></i>
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fim da Modal -->
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="<?= base_url('js/arealogada/ipads/atribuicao.js?v=1.10') ?>"></script>
  <script src="<?= base_url('js/arealogada/ipads/script.js?v=1.10') ?>"></script>
  <script src="<?= base_url('vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js') ?>"></script>
  <script type="text/javascript">

    $(function() {
      $('#cpf_usua').mask('000.000.000-00', {
        placeholder: '___.___.___-__'
      });

      $('.btInsert').click(function() {
        $("#modalExemplo").modal('show');
        clearForm();
        $('#id_usua_atendente').val(<?= $_SESSION['id_usua'] ?>);
      });

      $('#bt_delete').click(function() {
        $("#modalConfirmation").modal('show');
      });

      $('#bt_confirm').click(function() {

        $.ajax({
          type: "POST",
          dataType: "json",
          cache: false,
          url: "Atribuicao/deleteApont",
          data: {
            id: $("#id").val()
          },
          beforeSend: function() {
            $("#msg").html("<div class=\"alert alert-warning\" role=\"alert\"><i class=\"far fa-clock\"></i> Carregando...</div>");
          },
          success: function(jsonContent) {
            if (jsonContent['level'] == 'INFO') {
              $("#msg").html("");
              $('#modalConfirmation').modal('hide');
              $('#modalExemplo').modal('hide');
              getList();
            } else {
              $('#modalConfirmation').modal('hide');
              $("#msg").html(jsonContent['msg']);
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            $('#modalConfirmation').modal('hide');
            $("#msg").html("Erro: " + xhr.statusText + xhr.responseText);
          }
        });

      });

      $('#filt_consult').click(function() {
        getList();
      });

      $('#bt_user_plus').click(function() {
        formUserClear();
        $('#modalUser').modal('show');
      });

    });

    var btUpdate = function(event) {

      pId = $(event).attr('attr-id');

      $.ajax({
        type: "POST",
        dataType: "json",
        cache: false,
        url: "Atribuicao/getRegister",
        data: {
          id: pId
        },
        beforeSend: function() {
          $("#msg_btn").html("<div class=\"alert alert-warning\" role=\"alert\"><i class=\"far fa-clock\"></i> Carregando...</div>");
        },
        success: function(jsonContent) {
          if (jsonContent['level'] == 'INFO') {

            clearForm();
            disableForm();
            $("#modalExemplo").modal('show');
            $("#id").val(pId);
            $("#responsavel").val(jsonContent['register']['RESPONSAVEL']);
            $("#status").val(jsonContent['register']['STATUS']);
            $("#modelo").val(jsonContent['register']['MODELO']);
            $("#part_number").val(jsonContent['register']['PART_NUMBER']);
            $("#imei").val(jsonContent['register']['IMEI']);
            $("#serial").val(jsonContent['register']['SERIAL']);
            $("#email").val(jsonContent['register']['EMAIL']);
            $("#chip").val(jsonContent['register']['CHIP']);
            $("#obs").val(jsonContent['register']['OBS']);

            $("#bt_delete").show();
            $("#bt_save").show();
            $("#bt_user_plus").hide();
          }
          $("#msg_btn").html(jsonContent['msg']);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          $("#msg_btn").html("Erro: " + xhr.statusText + xhr.responseText);
        }
      });

    }

    var formUserClear = function(event) {

      // $('#nome_transportadora').val('');
      // $('#codigo_sap_transportadora').val('');

      // $('#responsavel').val('');
      // $('#imei').val('');

    }
  </script>

</body>

</html>