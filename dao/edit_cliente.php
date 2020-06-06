<?php
require_once('../conexao/conexao.php');

	$nome = mb_strtoupper($_POST['nome']);
	$cpf = $_POST['cpf'];
	$idade = $_POST['idade'];
	$sexo = $_POST['sexo'];
	$celular = $_POST['celular'];
	$rua = mb_strtoupper($_POST['rua']);
	$numero = $_POST['numero'];
	$bairro = mb_strtoupper($_POST['bairro']);
	$codigo = $_POST['cdcliente'];


$sqlTeste = "SELECT cpf FROM cliente WHERE cpf = '$cpf' and cdcliente != '$codigo'";
$dadosTeste = pg_query($conex,$sqlTeste);

$dados = pg_fetch_assoc($dadosTeste);

if ($dados['cpf'] == ''){

	$sql = "UPDATE cliente set
	celular = '$celular',
	bairro = '$bairro',
	rua = '$rua',
	cpf = '$cpf',
	nome = '$nome',
	sexo = '$sexo',
	idade = '$idade',
	numcasa = '$numero'
	where cdcliente= $codigo";

	$query= pg_query($conex,$sql);

	if (isset($query)) {
		?>
		<script>
			location.href="../indexSistema.php? page=forms/form_cliente&cad=0&cliente=<?php echo $nome; ?>&cod=<?php echo $cpf; ?>";
		</script>
		<?php
} 

} else {

?>
		<script>
			location.href="../indexSistema.php? page=forms/form_cliente&cad=0&cliente=<?php echo $nome; ?>&cod=<?php echo $cpf; ?>&erro= Já existe um cadastro com esse CPF.";
		</script>
<?php
}
?>