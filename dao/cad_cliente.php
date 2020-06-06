<?php
require_once '../conexao/conexao.php';
$nome = mb_strtoupper($_POST['nome']);
$cpf = $_POST['cpf'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$celular = $_POST['celular'];
$rua = mb_strtoupper($_POST['rua']);
$numero = $_POST['numero'];
$bairro = mb_strtoupper($_POST['bairro']);

?>
<?php
$sql = "INSERT INTO cliente(celular,
	bairro,
	rua,
	cpf,
	nome,
	sexo,
	idade,
	numcasa
)
VALUES('$celular','$bairro','$rua','$cpf','$nome','$sexo','$idade','$numero')";

$query= pg_query($conex,$sql);
if (isset($query)) {
	# code...
	?>
	<script>
	location.href="../indexSistema.php? page=forms/form_cliente&cad=1&cliente=<?php echo $nome; ?>&cod=<?php echo $cpf; ?>";
	</script>"

	<?php


}else{

	echo "Não foi possivel inserir o registro - entre em contato com o Gostoso do Bigode  <br><br>".infotech.pg_result_error(result);
}
?>
