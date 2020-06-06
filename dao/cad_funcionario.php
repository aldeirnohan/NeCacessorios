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


?>
<?php
$sql = "INSERT INTO funcionario(nome, email, celular, bairro, rua, login, senha, numcasa, sexo) 
    VALUES('$nome','$email','$celular','$bairro','$rua','$login','$senha','$numcasa','$sexo')";
$query= pg_query($conex,$sql);
if (isset($query)) {
	?>
	<script>
		location.href="../indexSistema.php? page=forms/form_funcionario&cad=1&funcionario=<?php echo $nome; ?>&cod=<?php echo $login; ?>";
	</script>

	<?php

}else{
	echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
