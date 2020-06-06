<?php
require_once('../conexao/conexao.php');
$nome = mb_strtoupper($_POST['nomerazaosocial']);
$estado = mb_strtoupper($_POST['estado']);
$cidade = mb_strtoupper($_POST['cidade']);
$rua = mb_strtoupper($_POST['rua']);
$bairro = mb_strtoupper($_POST['bairro']);
$cnpj = $_POST['cnpj'];
$email = mb_strtoupper($_POST['email']);
$telefone = $_POST['telefone'];
$cdfornecedor = $_POST['cdfornecedor'];
$numero = $_POST['numero'];

?>
<?php
$sql = "UPDATE fornecedor set
nomerazaosocial = '$nome',
estado = '$estado',
cidade = '$cidade',
rua = '$rua',
bairro = '$bairro',
cnpj = '$cnpj',
email = '$email',
telefone = '$telefone',
numero = '$numero'
where cdfornecedor = $cdfornecedor";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
	location.href="../indexSistema.php? page=forms/form_fornecedor&cad=0&fornecedor=<?php echo $nome; ?>&cod=<?php echo $cnpj; ?>";
	</script>"
	<?php
}else{
	
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
	
}
?>
