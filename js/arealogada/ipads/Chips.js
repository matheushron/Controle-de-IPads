$(function () {
	$("#bt_save").click(function () {
		$.ajax({
			type: "POST",
			dataType: "json",
			cache: false,
			url: "Chips/insert",
			data: {
				id: $("#id").val(),
				status_do_chip: document.getElementById('status_do_chip').value,
				linha_do_chip: document.getElementById('linha_do_chip').value,
				conta_do_chip: document.getElementById('conta_do_chip').value,
				serial: document.getElementById('serial').value,
				chip: document.getElementById('chip').value
			},
			beforeSend: function () {
				$("#msg").html("<div class=\"alert alert-warning\" role=\"alert\"><i class=\"far fa-clock\"></i> Carregando...</div>");
			},
			success: function (jsonContent) {
				if (jsonContent['err']) {
					$("#" + jsonContent['field']).focus();
					$("#msg").html(jsonContent['msg']);
				}
				location.reload(true);
				$("#msg").html(jsonContent['msg']);
				clearForm();
				getList();
				$("#modalExemplo").modal('hide');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$("#msg").html("Erro: " + xhr.statusText + xhr.responseText);
			}
		});

	});

	getList();

	$("#filt_data_atendi, " +
		"#filt_id_usua_atendido, " +
		"#filt_id_usua_atendente, " +
		"#filt_queixa").keyup(function () {
		if (event.keyCode == 13) $("#filt_consult").click();
	});


});

var getList = function (event) {

	$.ajax({
		type: "POST",
		dataType: "html",
		cache: false,
		url: "Chips/tabelaChip",
		data: {
			filt_transportadora: $('#filt_transportadora').val()
		},
		beforeSend: function () {
			$("#list").html("Carregando...");
		},
		success: function (htmlContent) {
			$("#list").html(htmlContent);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			$("#list").html("Erro: " + xhr.statusText + xhr.responseText);
		}
	});

}



var clearForm = function (event) {

	$("#id_transportadora").val('');
	$("#nome_transportadora").val('');
	$("#codigo_sap_transportadora").val('');

	$("#msg").html("");
	$("#bt_delete").hide();
	$("#bt_save").show();
	$("#bt_user_plus").show();

}

var disableForm = function (event) {

	$("#data_atendi").prop('disabled', true);
	$("#id_usua_atendido").prop('disabled', true);
	$("#id_usua_atendente").prop('disabled', true);

	$("#pressao_arterial").prop('disabled', true);
	$("#temperatura").prop('disabled', true);
	$("#saturacao").prop('disabled', true);
	$("#frequencia").prop('disabled', true);

	$("#queixa").prop('disabled', true);

	$("#acidente_trabalho").prop('disabled', true);
	$("#medicamento").prop('disabled', true);
	$("#procedimento").prop('disabled', true);
	$("#conduta").prop('disabled', true);

}
