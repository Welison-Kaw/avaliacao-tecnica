<?php

require_once('conn.php');
$database = open_database();

$fStatus = $_POST['status'];
$fSituacao = $_POST['situacao'];

$sql = "SELECT A.CD_ATIVIDADE, A.NM_ATIVIDADE, DATE_FORMAT(A.DT_INICIO, '%d/%m/%Y') AS DT_INICIO,
				 DATE_FORMAT(A.DT_FIM, '%d/%m/%Y') AS DT_FIM, S.CD_STATUS, S.NM_STATUS, 
				 CASE WHEN A.CD_SITUACAO = 1 THEN 'Ativo' ELSE 'Inativo' END AS CD_SITUACAO
		FROM TB_ATIVIDADE A 
		LEFT JOIN TB_STATUS S ON A.CD_STATUS = S.CD_STATUS
		WHERE (A.CD_STATUS = '$fStatus' OR '' = '$fStatus') AND
		(A.CD_SITUACAO = '$fSituacao' OR '' = '$fSituacao')
		";

$dsAtividade = $database->query($sql);

$retorno = '';

foreach ($dsAtividade as $row) {
	$retorno .= "<tr";
	$retorno .= $row['CD_STATUS'] ==  1 ? ' style="background-color:#9CE4F8;">' : '>';
	$retorno .= "<td><a class='btn btn-info' href='cadastro.php?cd=" . $row['CD_ATIVIDADE'] . "'>Editar</a></td>";
	$retorno .= "<td>" . $row['NM_ATIVIDADE'] . "</td>";
	$retorno .= "<td>" . $row['DT_INICIO'] . "</td>";
	$retorno .= "<td>" . $row['DT_FIM'] . "</td>";
	$retorno .= "<td>" . $row['NM_STATUS'] . "</td>";
	$retorno .= "<td>" . $row['CD_SITUACAO'] . "</td>";
	$retorno .= "</tr>";
}

//print_r($data);

//echo json_encode($data[0]);
echo $retorno;
close_database($database);
//echo json_encode($dsAtividade);
?>