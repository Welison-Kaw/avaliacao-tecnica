$(document).ready(function(){
	//$.mask.definitions['~']='[+-]';
	$('#dttermino').mask('99/99/9999');
	$('#dtinicio').mask('99/99/9999');

	var alertSucCad = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button><strong>Cadastro realizado com sucesso!</strong></div>';
	var alertSucEdit = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button><strong>Edição realizada com sucesso!</strong></div>';

	var alertDan = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">&times;</span></button><strong>Erro!</strong></div>';

	$('#formAtividade').submit(function(event){
		event.preventDefault();
		if ($('#status').val() == 1){
			if ($('#dttermino').val().length == 0) {
				//alert('teste');
				$('.faltaConcluido').show();
				return;				
			}
		}
		var formData = $('#formAtividade').serialize();
		$.ajax({
			type: 'POST',
			url: $('#formAtividade').attr('action'),
			data: formData
		}).done(function(response){
			if (response == 1) {
				if ($('#formAtividade').attr('action') == 'php/insert.php')
					$('.msg').append(alertSucCad);
				else 
					$('.msg').append(alertSucEdit);
			} else {
				$('.msg').append(alertDan);
			}
		})
	})

	if ($('#formAtividade').length > 0) {
		$('.faltaConcluido').hide();
		$('.faltaConcluido').css('color', '#a94442');

		if ($('#formAtividade #cdAtividade').val() > 0) {
			$('button[type="submit"').html('Editar');
			$('button[type="reset"]').remove();
			$('#formAtividade').attr('action', 'php/update.php');
		}
	}

	$('#formFiltro').submit(function(event){
		event.preventDefault();
		var formData = $('#formFiltro').serialize();
		$.ajax({
			type: 'POST',
			url: $('#formFiltro').attr('action'),
			data: formData
		}).done(function(response){
			$('#listaAtividade tbody').html(response);
		})
	})

	$('#btnReset').click(function(event){
		$('#formFiltro')[0].reset();
		var formData = $('#formFiltro').serialize();
		$.ajax({
			type: 'POST',
			url: $('#formFiltro').attr('action'),
			data: formData
		}).done(function(response){
			$('#listaAtividade tbody').html(response);
		})
	})
})