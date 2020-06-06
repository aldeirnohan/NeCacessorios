<?php
require_once '../conexao/conexao.php';
$nome = mb_strtoupper($_POST['nome']);
$email = mb_strtoupper($_POST['email']);
$celular = $_POST['celular'];
$bairro = mb_strtoupper($_POST['bairro']);
$rua = mb_strtoupper($_POST['rua']);
$login = $_POST['login'];
$senha = $_POST['senha'];
$numcasa = $_POST['numcasa'];
$sexo = $_POST['sexo'];
$codigo = $_POST['cdfuncionario'];
$cdfuncionario = $_POST['cdfuncionario'];
?>
<?php


$sql = "UPDATE funcionario SET nome = '$nome', email = '$email', celular = '$celular', bairro = '$bairro', rua = '$rua', login = '$login', senha = '$senha' , sexo = '$sexo' , numcasa = '$numcasa' WHERE cdfuncionario = $codigo";

$query= pg_query($conex,$sql);
if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php? page=forms/form_funcionario&cad=0&funcionario=<?php echo $nome; ?>&cod=<?php echo $login; ?>";
	</script>
</script>"

<?php

}else{
	echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
