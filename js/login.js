$(function(){
	
	$("#email, #pass").on('keypress', function(e){
	  if(e.which == 13){
	    $("#btnEntrar").click();
	  }	
	});
	
	$("#btnEntrar").click(function(){
		
		if($("#email").val() == ""){
			$("#msg").html("Informe o usu&aacute;rio");
			$("#email").focus();
			return false;
		}
		
		if($("#pass").val() == ""){
			$("#msg").html("Informe a senha");
			$("#pass").focus();
			return false;
		}
		
		vpar  = "pEmail=" + $("#email").val();
		vpar += "&pPass=" + $("#pass").val();
		
		$.ajax({ 
		  type: "POST", 
		  dataType: "json", 
		  cache: false, 
		  url: "autenticacao/validar",
		  data: vpar,
		  beforeSend: function(){
		    $("#msg").html("Carregando...");
		  },
		  success: function(jsonContent){
		    if(jsonContent.success == "true"){
		      location.href = 'arealogada/principal';
		    } else {
		      $("#msg").html(jsonContent.msg);
		    }
		  },
		  error: function (xhr, ajaxOptions, thrownError){
		    $("#msg").html("Erro: " + xhr.statusText + xhr.responseText);
		  }
		});
	  
	});
});