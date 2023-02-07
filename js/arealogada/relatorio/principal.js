$(function(){
  
  listUsers({filt_atendido: 'S'}, "#filt_id_usua_atendido");
  listUsers({filt_atendente: 'S'}, "#filt_id_usua_atendente");
  listSetor();

  $("#filt_data_atendi, " +
    "#filt_id_usua_atendido, " + 
    "#filt_id_usua_atendente, " + 
    "#filt_id_setor, " +
    "#filt_queixa").keyup(function(){ 
      if(event.keyCode == 13) $("#filt_consult").click();
  });

});

var listUsers = function(pData = {}, pElement = ".list-users"){

  $.ajax({
    type: "POST",
    dataType: "json",
    cache: false,
    url: "principal/listUsers",
    data: pData,
    beforeSend: function(){
      $(pElement).empty().append($("<option>").text('Carregando...').val(''));
    },
    success: function(jsonContent){

      if(jsonContent['level'] == 'ERROR'){
        $("#msg_btn").html(jsonContent['msg']);
        return false;
      }
      $("#msg_btn").html("");
      $(pElement).empty().append($("<option>").text(' -- ').val(''));

      $.each(jsonContent['list'], function(index, value){
          
        var id_re;
        if(value['id_re'] == '' || !value['id_re']){
          id_re = value['cpf_usua'];
        } else {
          id_re = value['id_re'];
        }

        $(pElement).append($("<option>").text(value['nome_usua'] + " - " + id_re + " (" + value['nome_setor'] + ")").val(value['id_usua']));
      });
    },
    error: function(xhr, ajaxOptions, thrownError){
      $("#msg_btn").html("Erro: " + xhr.statusText + xhr.responseText);
    }
  });

}

var getList = function(event){
    
  $.ajax({
    type: "POST",
    dataType: "html",
    cache: false,
    url: "principal/list",
    data: {
      filt_data_atendi_de: $('#filt_data_atendi_de').val(),
      filt_data_atendi_ate: $('#filt_data_atendi_ate').val(),
      filt_id_usua_atendido: $('#filt_id_usua_atendido').val(),
      filt_id_usua_atendente: $('#filt_id_usua_atendente').val(),
      filt_id_setor: $('#filt_id_setor').val(),
      filt_queixa: $("#filt_queixa").val()
    },
    beforeSend: function(){
      $("#list").html("Carregando...");
    },
    success: function(htmlContent){
      $("#list").html(htmlContent);
    },
    error: function(xhr, ajaxOptions, thrownError){
      $("#list").html("Erro: " + xhr.statusText + xhr.responseText);
    }
  });

}

var listSetor = function(pData = {}, pElement = "#filt_id_setor"){

  $.ajax({
    type: "POST",
    dataType: "json",
    cache: false,
    url: "principal/listSetor",
    data: pData,
    beforeSend: function(){
      $(pElement).empty().append($("<option>").text('Carregando...').val(''));
    },
    success: function(jsonContent){

      if(jsonContent['level'] == 'ERROR'){
        $("#msg_btn").html(jsonContent['msg']);
        return false;
      }
      $("#msg_btn").html("");
      $(pElement).empty().append($("<option>").text(' -- ').val(''));

      $.each(jsonContent['list'], function(index, value){

        $(pElement).append($("<option>").text(value['nome_setor']).val(value['id_setor']));
      });
    },
    error: function(xhr, ajaxOptions, thrownError){
      $("#msg_btn").html("Erro: " + xhr.statusText + xhr.responseText);
    }
  });

}