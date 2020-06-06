<?php
require_once '../conexao/conexao.php';
$numero = 30;

$cdcliente= (int)$_POST['nomes_cliente'];
$cdfuncionario = $_POST['cdfuncionario'];
$cliente=$_POST['nomes_cliente'];
?>
<?php
$sql = "INSERT INTO venda(prazoemdias,datavenda,cdcliente,cdfuncionario) VALUES('$numero','now()','$cdcliente','$cdfuncionario')";
$query= pg_query($conex,$sql);
$busca_venda = pg_query($conex,"select max(cdvenda) from venda") or die( "impossivel fazer a busca");
$cdvenda = pg_fetch_result($busca_venda,0,0);

if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php?page=forms/form_venda&cdvenda=<?php echo $cdvenda;?>&cliente=<?php echo $cliente; ?>";
	</script>

	<?php

}else{
	echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
