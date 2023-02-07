<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de IPads :: Cadastro de IPads</title>
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
      font-size: 13px;
    }
  </style>
</head>

<body>
  <?php $this->load->view('arealogada/includes/menu.php'); ?>

  <div style="width: 100%; height: 90vh; background-color: #f5f6f8; display:flex; flex-direction:column;">
    <div style="margin-left:35.4%; margin-top:30px;">
      <h3 class="text-dark">Ipads:</h3>
    </div>
    <div id="chart" style="height: 340px; width: 95%; margin-left:18px;"></div>
  </div>

  <div style="padding: 5px;">
    <div>
      <div style="padding: 15px;">
        <button type="button" class="btn btn-info btInsert">
          <i class="far fa-file"></i> Novo
        </button>
        <div style="float: right;" id="msg_btn"></div>
      </div>
    </div>


    <!-- começo da tabela -->
    <div style="padding: 10px; margin: 15px; border: 1px solid silver;">
      <div style="border-bottom: 1px solid silver; color: #4f4f4f; margin-bottom: 10px;">
        <i class="fas fa-list"></i>
        <b>Controle</b>
      </div>
      <div style="padding: 10px; margin: 15px; border: 1px solid silver;overflow: auto; height: 500px;">

        <table id="NovosAtivos" class="table table-striped table-bordered table-hover table-sm">
          <thead>
            <tr style="width: 400px;">
              <th>Nome do(a) Responsável</th>
              <th>E-mail</th>
              <th>Status</th>
              <th>Modelo</th>
              <th>Part Number</th>
              <th>Serial</th>
              <th>IMEI</th>
              <th>CHIP</th>
              <th>Observações</th>
              <th>Editar</th>
            </tr>
            <tr>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th>
                <select type="text" class="form-control" data-size="1" data-live-search="true" data-actions-box="true" id="txtNome">
                  <option value="">--</option>
                  <option value="ESTOQUE">ESTOQUE</option>
                  <option value="EM USO">EM USO</option>
                  <option value="TRANSITO">TRANSITO</option>
                  <option value="TRANSITO DE TROCA">TRANSITO DE TROCA</option>
                  <option value="TRANSITO DE DESLIGAMENTO">TRANSITO DE DESLIGAMENTO</option>
                  <option value="ROUBADO">ROUBADO</option>
                  <option value="PERDIDO">PERDIDO</option>
                  <option value="USO INTERNO">USO INTERNO</option>
                  <option value="MANUTENÇÃO EXTERNA">MANUTENÇÃO EXTERNA</option>
                  <option value="MANUTENÇÃO INTERNA">MANUTENÇÃO INTERNA</option>
                </select>
              </th>
              <th>
                <select type="text" class="form-control" data-size="1" data-live-search="true" data-actions-box="true" id="txtNome">
                  <option value="">--</option>
                  <option value='A1475 - IPad Air'>A1475 - IPad Air</option>
                  <option value='A1954 - IPad Air'>A1954 - IPad New</option>
                  <option value='A1567 - IPad Air 2'>A1567 - IPad Air 2</option>
                  <option value='A1674 - IPad Air 2'>A1674 - IPad Air 2</option>
                  <option value='A1823 - IPad Air 2'>A1823 - IPad Air 2</option>
                  <option value='A1954 - IPad New'>A2604 - IPad New</option>
                  <option value='A2604 - IPad Air 9'>A2604 - IPad Air 9</option>
                </select>
              </th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th><input class="form-control" oninput="this.value = this.value.toUpperCase()" type="text" id="txtNome" /></th>
              <th>--</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($listTransportadora as $row) {
            ?>
              <tr id="tabela">
                <td><?= $row['RESPONSAVEL'] ?></td>
                <td><?= $row['EMAIL'] ?></td>
                <td><?= $row['STATUS'] ?></td>
                <td><?= $row['MODELO'] ?></td>
                <td><?= $row['PART_NUMBER'] ?></td>
                <td><?= $row['SERIAL'] ?></td>
                <td><?= $row['IMEI'] ?></td>
                <td><?= $row['CHIP'] ?></td>
                <td><?= $row['OBS'] ?></td>
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

    <!-- fim da tabela -->

    <!-- Modal novo IPad-->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <i class="far fa-file"></i>
              IPad
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

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
                      <label for="responsavel">
                        Nome do(a) Responsável:
                      </label>
                      <input id="responsavel" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="status">
                        Status:
                      </label>
                      <select id="status" class="form-control" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 3">
                        <option value="">--</option>
                        <option value="ESTOQUE">ESTOQUE</option>
                        <option value="EM USO">EM USO</option>
                        <option value="TRANSITO">TRANSITO</option>
                        <option value="TRANSITO DE MANUTENÇÃO">TRANSITO DE MANUTENÇÃO</option>
                        <option value="TRANSITO DE DESLIGAMENTO">TRANSITO DE DESLIGAMENTO</option>
                        <option value="ROUBADO">ROUBADO</option>
                        <option value="PERDIDO">PERDIDO</option>
                        <option value="USO INTERNO">USO INTERNO</option>
                        <option value="MANUTENÇÃO INTERNA">MANUTENÇÃO INTERNA</option>
                        <option value="MANUTENÇÃO EXTERNA">MANUTENÇÃO EXTERNA</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="email">
                        E-MAIL:
                      </label>
                      <input id="email" class="form-control"  type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="modelo">
                        Modelo:
                      </label>
                      <!-- <input id="modelo" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text"> -->
                      <select id="modelo" class="form-control" data-live-search="true" data-actions-box="true" data-selected-text-format="count > 3">
                        <option value=''>--</option>
                        <option value='A1475 - IPad Air'>A1475 - IPad Air</option>
                        <option value='A1954 - IPad Air'>A1954 - IPad New</option>
                        <option value='A1567 - IPad Air 2'>A1567 - IPad Air 2</option>
                        <option value='A1674 - IPad Air 2'>A1674 - IPad Air 2</option>
                        <option value='A1823 - IPad Air 2'>A1823 - IPad Air 2</option>
                        <option value='A1954 - IPad New'>A2604 - IPad New</option>
                        <option value='A2604 - IPad Air 9'>A2604 - IPad Air 9</option>
                    </select>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="status">
                        Part number:
                      </label>
                      <input id="part_number" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="imei">
                        IMEI:
                      </label>
                      <input id="imei" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="chip">
                        CHIP:
                      </label>
                      <input id="chip" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="serial">
                        Serial
                      </label>
                      <input id="serial" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                      <label for="obs">
                        Observação:
                      </label>
                      <input id="obs" class="form-control" oninput="this.value = this.value.toUpperCase()" type="text">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <div class="modal-footer">

                      <button type="button" class="btn btn-danger" id="bt_desliga">
                        <i class="far fa-trash-alt"></i>
                        Desligar usuario
                      </button>

                      <button type="button" class="btn btn-danger" id="bt_delete">
                        <i class="far fa-trash-alt"></i>
                        Excluir
                      </button>

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="far fa-window-close"></i>
                        Fechar
                      </button>

                      <button type="button" class="btn btn-success" id="bt_atribui">
                      <i class="fa fa-user-plus"></i>
                        Atribuir
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

  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="<?= base_url('js/arealogada/ipads/IPads.js?v=1.10') ?>"></script>
  <script src="<?= base_url('js/arealogada/ipads/filtro.js?v=1.10') ?>"></script>
  <script src="<?= base_url('vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js') ?>"></script>
  <script>
      //TENTATIVA DE FAZER O CONTADOR:
      var namesBar = ['Em Uso', 'Estoque', 'Em Trânsito', 'Roubados', 'Manutenção', 'Uso Interno'];
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
        colors: ["#102de6", "#46e610", "#e69810", "#e61010", "#7209eb","#4b4a4f" ], //[azul,verde,laranja,Vermelho,Roxo e Cinza]

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
            text: 'IPads (quantidades)',
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

      $('#bt_desliga').click(function() {
        $("#modalExemplo").modal('show');
      });

      $('#bt_atribui').click(function() {
        $("#modalExemplo").modal('show');
      });


      $('#bt_confirm').click(function() {

        $.ajax({
          type: "POST",
          dataType: "json",
          cache: false,
          url: "IPads/deleteApont",
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
              location.reload(true);
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
        url: "IPads/getRegister",
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
            $("#status_do_chip").val(jsonContent['register']['STATUS_DO_CHIP']);
            $("#modelo").val(jsonContent['register']['MODELO']);
            $("#part_number").val(jsonContent['register']['PART_NUMBER']);
            $("#imei").val(jsonContent['register']['IMEI']);
            $("#serial").val(jsonContent['register']['SERIAL']);
            $("#email").val(jsonContent['register']['EMAIL']);
            $("#chip").val(jsonContent['register']['CHIP']);
            $("#obs").val(jsonContent['register']['OBS']);


            $("#bt_atribui").show();
            $("#bt_delete").show();
            $("#bt_desliga").show();
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



      $('#responsavel').val('');
      $('#email').val('');
      $('#modelo').val('');
      $('#part_number').val('');
      $('#imei').val('');
      $('#serial').val('');

    }
  </script>

</body>

</html>