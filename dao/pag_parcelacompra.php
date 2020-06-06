<?php  
   	require_once '../conexao/conexao.php';
  
  	$cdfornecedor = $_POST['nome'];

  	foreach($_POST['parcelacompra'] AS $cdparc) {

		$sql = "UPDATE parcelacompra set situacaopag = 'PAGA' where cdparcelacompra = $cdparc";
		$query= pg_query($conex,$sql);

	}
  

	if (isset($query)) {
		?>
		<script>
			alert("Parcela Paga");
			location.href="../indexSistema.php?page=forms/paga_parcelascompra&fornecedor=<?php echo $cdfornecedor; ?>";
		</script>
	<?php
	}else{
	
		echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	}
?>