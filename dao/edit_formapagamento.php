<?php
require_once('../conexao/conexao.php');
$tipopagamento = $_POST['tipopagamento'];
$formapagamento = $_POST['formapagamento'];
$codigo = $_POST['cdformapagamento'];

?>
<?php
$sql = "UPDATE formapagamento set
tipopagamento = '$tipopagamento',
formapagamento = '$formapagamento'
where cdformapagamento= $codigo";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
	alert('Forma de pagamento editado  com sucesso');
	location.href="../indexSistema.php? page=exibir/listar_pagamento&codigo=&alterado=1";
	</script>"
</script>"
<?php
}else{
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
