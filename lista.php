<!DOCTYPE html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
<head>
	<title>Listagem de Atividades</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

	<?php
		require_once('php/conn.php');
		
		$database = open_database();

		$sql = "SELECT A.CD_ATIVIDADE, A.NM_ATIVIDADE, DATE_FORMAT(A.DT_INICIO, '%d/%m/%Y') AS DT_INICIO,
						 DATE_FORMAT(A.DT_FIM, '%d/%m/%Y') AS DT_FIM, S.CD_STATUS, S.NM_STATUS, 
						 CASE WHEN A.CD_SITUACAO = 1 THEN 'Ativo' ELSE 'Inativo' END AS CD_SITUACAO
				FROM TB_ATIVIDADE A 
				LEFT JOIN TB_STATUS S ON A.CD_STATUS = S.CD_STATUS";

		$dsAtividade = $database->query($sql);

		$sql = "SELECT * FROM TB_STATUS";
		$dsStatus = $database->query($sql);
	?>
</head>
<body>

<main class="container">
	<div class="row">
		<div class="col-sm-6">
			<h2>Consulta de Atividades</h2>
		</div>
	</div>

	<form id="formFiltro" role="form" method="POST" action="php/select.php">
		<div class="col-md-6 mb-3">
			<label for="status">Status</label>
			<select id="status" name="status" class="form-control">
				<option value="" selected>Todos</option>
				<?php
					foreach ($dsStatus as $row) {
						echo "<option value=" . $row['CD_STATUS'] . ">" . $row['NM_STATUS'] . "</option>";
					}
				?>
			</select>
			<div class="help-block with-errors"></div>
		</div>
		<div class="form-group col-md-6 mb-3">
			<label for="status">Situação</label>
			<select id="status" name="situacao" class="form-control">
				<option value="" selected>Todos</option>
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</div>

		<div class="form-group col-md-6">
			<button type="submit" class="btn btn-primary">Filtrar</button>
			<button type="button" class="btn btn-default" id="btnReset">Listar Todos</button>
		</div>
	</form>

	<table class="table table-hover table-bordered" id="listaAtividade">
		<thead class="thead-inverse">
			<tr>
				<th></th>
				<th>Nome</th>
				<th>Data de Início</th>
				<th>Data de Término</th>
				<th>Status</th>
				<th>Situação</th>
			</tr>
		</thead>

		<tbody>
			<?php
				foreach ($dsAtividade as $row) {
					echo "<tr";
					echo $row['CD_STATUS'] ==  1 ? ' style="background-color: #9CE4F8;">' : '>';
					echo "<td><a class='btn btn-info' href='cadastro.php?cd=" . $row['CD_ATIVIDADE'] . "'>Editar</a></td>";
					echo "<td>" . $row['NM_ATIVIDADE'] . "</td>";
					echo "<td>" . $row['DT_INICIO'] . "</td>";
					echo "<td>" . $row['DT_FIM'] . "</td>";
					echo "<td>" . $row['NM_STATUS'] . "</td>";
					echo "<td>" . $row['CD_SITUACAO'] . "</td>";
					echo "</tr>";
					//echo "<tr></tr>";
				}
			?>
		</tbody>

	</table>

	<div class="row">
		<div class="col-sm-2 text-right h3">
			<a class="btn btn-success" href="cadastro.php">Nova Atividade</a>
			<!--<a class="btn btn-primary" href="#"><i class="fa fa-refresh"></i>Atualizar</a>-->
		</div>
	</div>
</main>

<?php close_database($database); ?>
</body>
</html>