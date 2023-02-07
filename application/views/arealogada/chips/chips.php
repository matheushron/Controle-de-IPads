<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <title>Controle de IPads :: Controle de Chips</title>

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
  <!--Carrega o Menu superior-->
  <?php $this->load->view('arealogada/includes/menu.php'); ?>
  
  <div style="width: 100%; height: 90vh; background-color: #f5f6f8; display:flex; flex-direction:column;">
    <div style="margin-left:35.4%; margin-top:30px;">
      <h3 class="text-dark">Chips:</h3>
    </div>
    <div id="chart" style="height: 340px; width: 95%; margin-left:18px;"></div>
  </div>

  <!-- inicio do botão de novo -->
  <div style="padding: 15px;">
    <button type="button" class="btn btn-info btInsert">
      <i class="far fa-file"></i> Novo
    </button>
    <div style="float: right;" id="msg_btn"></div>
  </div>

  <!-- Começo da tabela -->
  <div style="padding: 10px; margin: 15px; border: 1px solid silver;">
    <div style="border-bottom: 1px solid silver; color: #4f4f4f; margin-bottom: 10px;">
      <i class="fas fa-list"></i>
      <b>CHIPS</b>
    </div>

    <div>
      <div style="overflow: auto; height: 500px ">
        <table id="chips" class="table table-striped table-bordered table-hover table-sm" style="padding: 10px; margin: 15px; border: 1px solid silver;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Número da linha</th>
              <th>SIM Card</th>
              <th>Conta</th>
              <th>Serial</th>
              <th>Status</th>
              <th>Editar</th>
            </tr>
            <tr>
              <th>--</th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtEmail" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtSerial" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtSerial" /></th>
              <th>
                <select type="text" class="form-control" data-size="1" data-live-search="true" data-actions-box="true" id="txtNome">
                  <option value="">--</option>
                  <option value="ESTOQUE">ESTOQUE</option>
                  <option value="EM USO">EM USO</option>
                  <option value="TRÂNSITO">TRÂNSITO</option>
                  <option value="ROUBADO">ROUBADO</option>
                  <option value="PERDIDO">PERDIDO</option>
                  <option value="INSTALADO EM IPAD">INSTALADO EM IPAD</option>
                </select>
              </th>
              <th>--</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($tabelaChip as $row) {
            ?>
              <tr id="tabela">
                <td><?= $row['ID'] ?></td>
                <td><?= $row['LINHA_DO_CHIP'] ?></td>
                <td><?= $row['CHIP'] ?></td>
                <td><?= $row['CONTA_DO_CHIP'] ?></td>
                <td><?= $row['SERIAL'] ?></td>
                <td><?= $row['STATUS_DO_CHIP'] ?></td>
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
  </div>

  <!-- Fim da tabela -->

  <!-- Modal novo chip-->
  <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="far fa-file"></i>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <!-- inicio da modal -->
          <div>
            <div class="container-fluid">
              <div style="border-bottom: 1px solid silver; color: #4f4f4f; margin-bottom: 10px;">
                <i class="fas fa-list"></i>
                <b>Dados</b>
              </div>

              <div class="row">
                <input type="hidden" class="form-control" id="id">

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="linha_do_chip">
                      Numero Da Linha
                    </label>
                    <input id="linha_do_chip" oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" maxlength="80">
                    </label>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="chip">
                      SIM Card
                    </label>
                    <input id="chip" oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" maxlength="20">
                    </label>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="conta_do_chip">
                      Conta
                    </label>
                    <input id="conta_do_chip" oninput="this.value = this.value.toUpperCase()" class="form-control" maxlength="10">
                    </label>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="serial">
                      SERIAL do IPad instalado
                    </label>
                    <input id="serial" oninput="this.value = this.value.toUpperCase()" class="form-control" maxlength="15">
                    </label>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="status_do_chip">
                      Status
                    </label>
                    <select id="status_do_chip" class="form-control" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 3">
                      <option value="">--</option>
                      <option value="ESTOQUE">ESTOQUE</option>
                      <option value="EM USO">EM USO</option>
                      <option value="TRÂNSITO">TRÂNSITO</option>
                      <option value="ROUBADO">ROUBADO</option>
                      <option value="PERDIDO">PERDIDO</option>
                      <option value="INSTALADO EM IPAD">INSTALADO EM IPAD</option>
                    </select>
                    </label>
                  </div>
                </div>

                <!-- fim da modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" id="bt_delete">
                    <i class="far fa-trash-alt"></i>
                    Excluir
                  </button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="far fa-window-close"></i>
                    Fechar
                  </button>
                  <button type="button" class="btn btn-success" id="bt_save">
                    <i class="far fa-save"></i>
                    Gravar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div id="msg" style="margin-left: 20px;"></div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <!-- Fim  Modal novo chip-->

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
          Confirmar exclusão do registro?
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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="<?= base_url('js/arealogada/ipads/Chips.js?v=1.10') ?>"></script>
  <script src="<?= base_url('js/arealogada/ipads/chipFiltro.js?v=1.10') ?>"></script>
  <script src="<?= base_url('vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js') ?>"></script>
  <script>
    //TENTATIVA DE FAZER O CONTADOR:
    var namesBar = ['Em Uso', 'Estoque', 'Instalados em IPads','Em Trânsito', 'Roubados', 'Manutenção', 'Uso Interno'];
    var options = {
      series: [{
        name: '',
        data: <?php echo json_encode($point) ?> //[21, 22, 10]
      }],
      chart: {
        height: 350,
        type: 'bar',
        events: {
          click: function(chart, w, e) {
            // console.log(chart, w, e)
          }
        }
      },
      // colors: colors,
      plotOptions: {
        bar: {
          columnWidth: '20%',
          distributed: true,
          borderRadius: 0,
          borderColor: "black"
        },
      },
      stroke: {
        width: 2,
        colors: ["#202124"]
      },
      grid: {
        borderColor: "#535A6C",
        xaxis: {
          lines: {
            show: false
          }
        }
      },
      dataLabels: {
        enabled: true,
      },
      colors: ["#102de6", "#46e610", "#e3eb09","#e69810", "#e61010", "#7209eb", "#4b4a4f"], //[azul,verde,laranja,Vermelho,Roxo e Cinza]

      fill: {
        colors: undefined,
        opacity: 100,
        type: 'solid',
        gradient: {
          shade: 'dark',
          type: "horizontal",
          shadeIntensity: 0.5,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 100,
          opacityTo: 1,
          stops: [0, 50, 100],
          colorStops: []
        },
      },
      legend: {
        show: true
      },
      yaxis: {
        title: {
          text: 'Chips(quantidade)',
          style: {
            fontSize: '15px',
            fontWeight: 600,
          }
        }
      },

      xaxis: {
        categories: [
          ['Em uso'],
          ['Estoque'],
          ['Instalados em IPads'],
          ['Em trânsito'],
          ['Roubados'],
          ['Perdidos'],
          ['Uso interno'],
        ],
        labels: {
          style: {
            //   colors: colors,
            fontSize: '12px'
          }
        }
      },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    //FIM DA TENTATIVA
  </script>
  <script type="text/javascript">
    $(function() {
      $('#bt_save').click(function() {})
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
          url: "Chips/deleteApont",
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
        alert("teste")
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
        url: "Chips/getRegister",
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
            $("#linha_do_chip").val(jsonContent['register']['LINHA_DO_CHIP']);
            $("#chip").val(jsonContent['register']['CHIP']);
            $("#conta_do_chip").val(jsonContent['register']['CONTA_DO_CHIP']);
            $("#serial").val(jsonContent['register']['SERIAL']);
            $("#status_do_chip").val(jsonContent['register']['STATUS_DO_CHIP']);


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

      $('#nome_transportadora').val('');
      $('#codigo_sap_transportadora').val('');

      // $('#responsavel').val('');
      // $('#imei').val('');


    }
  </script>

</body>

</html>