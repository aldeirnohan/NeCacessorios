<?php
require_once '../conexao/conexao.php';
$nome = mb_strtoupper($_POST['nomerazaosocial']);
$cnpj = $_POST['cnpj'];
$telefone= $_POST['telefone'];
$email = mb_strtoupper($_POST['email']);
$bairro = $_POST['bairro'];
$rua = mb_strtoupper($_POST['rua']);
$estado = mb_strtoupper($_POST['estado']);
$cidade = mb_strtoupper($_POST['cidade']);
$numero = $_POST['numero'];


?>
<?php
$sql = "INSERT INTO fornecedor(estado, cidade, bairro, rua, nomerazaosocial, cnpj, email, telefone,numero) VALUES('$estado','$cidade','$bairro','$rua','$nome','$cnpj','$email','$telefone',$numero)";
$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
	location.href="../indexSistema.php? page=forms/form_fornecedor&cad=1&fornecedor=<?php echo $nome; ?>&cod=<?php echo $cnpj; ?>";
	</script>"

	<?php

}else{
	echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
