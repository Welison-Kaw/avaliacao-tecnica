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

$sql = "UPDATE TB_ATIVIDADE SET
			NM_ATIVIDADE = '".$_POST['nome']."',
			DS_ATIVIDADE = '".$_POST['desc']."',
			DT_INICIO = $fDtInicio,
			DT_FIM = $fDtTermino,
			CD_STATUS = '".$_POST['status']."',
			CD_SITUACAO = '".$_POST['situacao']."'
		WHERE CD_ATIVIDADE = ".$_POST['cdAtividade'];

//$sql = "UPDATE TB_ATIVIDADE SET	NM_ATIVIDADE = '".$_POST['nome']."',DS_ATIVIDADE = '".$_POST['desc']."', DT_INICIO = $fDtInicio, DT_FIM = $fDtTermino, CD_STATUS = '".$_POST['status']."', CD_SITUACAO = '".$_POST['situacao']."' WHERE CD_ATIVIDADE = ".$_POST['cdAtividade'];
//echo $sql;

if ($database->query($sql) === TRUE) {
	echo "1";
} else {
	echo "0";
}

close_database($database);
?>