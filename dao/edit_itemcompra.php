<?php  
	require_once('../conexao/conexao.php');
	session_start();
	$cdcompra=$_SESSION['cdcompra'];
	$fornecedor = $_SESSION['fornecedor'];
	$qtd = $_POST['quant_item'];
	$compra =$_POST['valorunitcompra'];
	$venda = $_POST['valorunitvenda'];
	$cditemcompra = $_POST['cditemcompra'];
	$sql = "UPDATE itemcompra set
	quantidade = '$qtd',
	valorunitcompra = '$compra',
	valorunitvenda = '$venda'
	where cditemcompra = $cditemcompra";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php?page=forms/form_compra&cad=0&cdcompra=<?php echo $cdcompra;?>&fornecedor=<?php echo $fornecedor; ?>";
	</script>"
	<?php
}else{
	
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	
}


?>