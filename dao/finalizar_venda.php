<?php  
	require_once('../conexao/conexao.php');
	$pag= (int)$_POST['formapagamento'];
	$parcelas = $_POST['parcelas'];
	$finalizar = 'FECHADA';
	$cdvenda = $_POST['cdvenda'];

	if($pag == 0){
		$pag = 2;
	}

	$sql = "UPDATE venda set
	situacaovenda = '$finalizar',
	quantparcelas = '$parcelas',
	cdformapagamento = '$pag'
	where cdvenda = $cdvenda";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php? page=forms/form_venda&fin=1";
	</script>
	<?php
}else{
	
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	
}


?>