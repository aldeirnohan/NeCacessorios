<?php
require_once '../conexao/conexao.php';
$nome = $_POST['nome'];

?>
<?php
$sql = "INSERT INTO categoriaprod(
	nome

)
VALUES('$nome')";

$query= pg_query($conex,$sql);
if (isset($query)) {
	# code...
	?>
	<script>
	alert('Categoria do produto  cadastrada com sucesso!');
	location.href="../indexSistema.php";
	</script>"

	<?php


}else{
	echo "Não foi possivel inserir o registro - entre em contato com o Gostoso do Bigode  <br><br>".infotech.pg_result_error(result);
}
?>