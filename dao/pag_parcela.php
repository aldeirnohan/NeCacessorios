<?php  
   	require_once '../conexao/conexao.php';
  
  	$cdcliente = $_POST['nome'];

  	foreach($_POST['parcelavenda'] AS $cdparc) {

		$sql = "UPDATE parcelavenda set situacaopag = 'PAGA' where cdparcelavenda = $cdparc";
		$query= pg_query($conex,$sql);

	}
  

	if (isset($query)) {
		?>
		<script>
			alert("Parcela Paga")
			location.href="../indexSistema.php?page=forms/paga_parcelasvenda&cliente=<?php echo $cdcliente; ?>";
		</script>
	<?php
	}else{
	
		echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	}
?>