<?php  
	require_once('../conexao/conexao.php');
	session_start();
	$cdvenda=$_SESSION['cdvenda'];
	$cliente = $_SESSION['cliente'];
	$qtd = $_POST['quant_item'];
	$desc = ($_POST['%desconto'] / 100);
	$cditemvenda = $_POST['cditemvenda'];
	$sql = "UPDATE itemvenda set
	quantidade = '$qtd',
	percentualdesconunit= '$desc'
	where cditemvenda = $cditemvenda";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php?page=forms/form_venda&cad=0&cdvenda=<?php echo $cdvenda;?>&cliente=<?php echo $cliente; ?>";
	</script>"
	<?php
}else{
	
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	
}


?>