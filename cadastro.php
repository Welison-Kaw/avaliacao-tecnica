<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
<head>
	<title>Cadastro de Atividades</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">

	<?php
		require_once('php/conn.php');
		
		$database = open_database();

		$sql = "SELECT * FROM TB_STATUS";
		$dsStatus = $database->query($sql);

		$vNome = '';
		$vDesc = '';
		$vDtInicio = '';
		$vDtTermino = '';
		$vStatus = '';
		$vSituacao = '';
		if ($_GET['cd']) {
			$sql = "SELECT NM_ATIVIDADE, DS_ATIVIDADE, DATE_FORMAT(DT_INICIO, '%d/%m/%Y') AS DT_INICIO, 
			DATE_FORMAT(DT_FIM, '%d/%m/%Y') AS DT_FIM, CD_STATUS, CD_SITUACAO
				FROM TB_ATIVIDADE WHERE CD_ATIVIDADE = " . $_GET['cd'];
			$dsAtividade = $database->query($sql);
			$dsAtividade = mysqli_fetch_assoc($dsAtividade);
			$vNome = $dsAtividade['NM_ATIVIDADE'];
			$vDesc = $dsAtividade['DS_ATIVIDADE'];
			$vDtInicio = $dsAtividade['DT_INICIO'];
			$vDtTermino = $dsAtividade['DT_FIM'];
			$vStatus = $dsAtividade['CD_STATUS'];
			$vSituacao = $dsAtividade['CD_SITUACAO'];
		}
	?>
</head>
<body>

<div class="container">
	<h1>Cadastro de Atividades</h1>
	<!--<div class="row">
		<div class="col-sm-6">
			<h2>Cadastro</h2>
		</div>
	</div>-->

	<div class="msg"></div>

	<form id="formAtividade" data-toggle="validator" role="form" method="POST" action="php/insert.php">
		<input type="hidden" id="cdAtividade" name="cdAtividade" value="<?php echo $_GET['cd'] ;?>">
		<div class="form-group">
			<label class="control-label col-form-label" for="nome">Nome *</label>
			<input id="nome" class="form-control" type="text" name="nome" placeholder="Nome da Atividade" maxlength="255" required value=<?php echo "'$vNome'"; ?>>
			<div class="help-block with-errors"></div>
		</div>

		<div class="form-group">
			<label for="desc">Descrição</label>
			<textarea id="desc" class="form-control" name="desc" placeholder="Descrição da Atividade" maxlength="600"><?php echo "$vDesc"; ?></textarea>
			<div class="help-block with-errors"></div>
		</div>

		<div class="row form-group">
			<div class="col-md-6 mb-3">
				<label for="dtinicio">Data de Início *</label>
				<input type="text" class="form-control" id="dtinicio" name="dtinicio" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" maxlength="10" required value=<?php echo "'$vDtInicio'"; ?>>
				<div class="help-block with-errors"></div>
			</div>
			<div class="col-md-6 mb-3">
				<label for="dttermino">Data de Término</label>
				<input type="text"  class="form-control" id="dttermino" name="dttermino" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" placeholder="DD/MM/YYYY" maxlength="10" value=<?php echo "'$vDtTermino'"; ?>>
				<div class="help-block with-errors"></div>
				<div class="faltaConcluido">Para o Status de Concluído, este campo é obrigatório!</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 mb-3">
				<label for="status">Status *</label>
				<select id="status" name="status" class="form-control" required>
					<option value="" <?php echo ($vStatus == '') ? 'selected' : ''; ?>></option>
					<?php
						foreach ($dsStatus as $row) {
							echo "<option value=" . $row['CD_STATUS'];
							echo ($row['CD_STATUS'] == $vStatus) ? ' selected="selected"' : '';
							echo ">" . $row['NM_STATUS'] . "</option>";
						}
					?>
				</select>
				<div class="help-block with-errors"></div>
			</div>

			<div class="form-group col-md-6 mb-3">
				<div class="form-group">
					<label>Situação *</label>
				</div>

				<div class="col-md-3">
					<label class="form-check-label">
						<input class="form-check-input" type="radio" value="1" name="situacao" <?php echo ($vSituacao == 1 || $vSituacao == '') ? 'checked' : '' ?>>Ativo
					</label>
				</div>
				<div class="col-md-3">
					<label class="form-check-label">
						<input class="form-check-input" type="radio" value="0" name="situacao" <?php echo ($vSituacao == 0) ? 'checked' : '' ?>>Inativo
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<p>Os campos com <b>*</b> são de preenchimento obrigatório!</p>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Enviar</button>
			<button type="reset"  class="btn btn-default">Limpar</button>
			<a class="btn btn-danger" href="lista.php">Voltar</a>
		</div>
	</form>
</div>
<?php close_database($database); ?>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/validator.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>