<?php 
require_once('conn.php');
$database = open_database();

$fDtInicio = "null";
$fDtTermino = "null";

if (strlen($_POST['dtinicio']) > 0) {
	$fDtInicio = "STR_TO_DATE('".$_POST['dtinicio']."', '%d/%m/%Y')";
}

if (strlen($_POST['dttermino']) > 0) {
	$fDtTermino = "STR_TO_DATE('".$_POST['dttermino']."', '%d/%m/%Y')";
}

$sql = "INSERT INTO TB_ATIVIDADE (NM_ATIVIDADE, DS_ATIVIDADE, DT_INICIO, DT_FIM, CD_STATUS, CD_SITUACAO)
VALUES (
	'".$_POST['nome']."',
	'".$_POST['desc']."',
	$fDtInicio,
	$fDtTermino,
	".$_POST['status'].",
	".$_POST['situacao']."
	) ";

if ($database->query($sql) === TRUE) {
	echo "1";
} else {
	echo "0";
}
close_database($database);
?>