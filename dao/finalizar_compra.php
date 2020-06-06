<?php  
	require_once('../conexao/conexao.php');
	session_start();
	$pag= (int)$_POST['formapagamento'];

	if($pag == 0){
		$pag = 2;
	}
    
	$parcelas = $_POST['parcelas'];
	$finalizar = 'FECHADA';
	$cdcompra = $_SESSION['cdcompra'];
	

	$sql = "UPDATE compra set
	situacaocompra = '$finalizar',
	cdformapagamento = '$pag',
	quantparcelas = '$parcelas'
	where cdcompra = $cdcompra";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php? page=forms/form_compra&fin=1";
	</script>
	<?php
}else{
	
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	
}


?>