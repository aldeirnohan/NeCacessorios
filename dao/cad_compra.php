<?php
require_once '../conexao/conexao.php';
$numero = 30;

$cdfornecedor= (int)$_POST['nome_fornecedor'];
$cdfuncionario = $_POST['cdfuncionario'];
$fornecedor=$_POST['nome_fornecedor'];

?>
<?php
$sql = "INSERT INTO compra(prazoemdias,datacompra,cdfornecedor,cdfuncionario) VALUES('$numero','now()','$cdfornecedor','$cdfuncionario')";
$query= pg_query($conex,$sql);
$busca_compra = pg_query($conex,"select max(cdcompra) from compra") or die( "impossivel fazer a busca");
$cdcompra = pg_fetch_result($busca_compra,0,0);

if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php?page=forms/form_compra&cdcompra=<?php echo $cdcompra;?>&fornecedor=<?php echo $fornecedor; ?>";
	</script>

	<?php

}else{
	echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
