<?php
require_once '../conexao/conexao.php';
$tipo = $_POST['tipo'];
$forma = $_POST['forma'];

?>
<?php
$sql = "INSERT INTO formapagamento(
	tipopagamento,
	formapagamento

)
VALUES('$tipo','$forma')";

$query= pg_query($conex,$sql);
if (isset($query)) {
	# code...
	?>
	<script>
	alert('Forma de pagamento cadastrada com sucesso!');
	location.href="../indexSistema.php";
	</script>"

	<?php


}else{
	echo "Não foi possivel inserir o registro - entre em contato com o Gostoso do Bigode  <br><br>".infotech.pg_result_error(result);
}
?>
