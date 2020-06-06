<?php

require_once('../conexao/conexao.php');
$nome = $_POST['nome'];
$cdcategoriaprod = $_POST['cdcategoriaprod'];
$descricao = $_POST['descricao'];
$codigo = $_POST['cdproduto'];


$nomeArquivo = $_FILES['file']['name'];
$dataAtual = date("d/m/Y H:i:s");
$hash = $codigo. $dataAtual;

$nomehash = md5($hash);

$arrayNomeArquivo = explode('.', $nomeArquivo);

$extensao = end($arrayNomeArquivo);

$endereco_imagem = "imagens/produtos/".$nomehash.".".$extensao;

?>
<?php



if(empty($nomeArquivo) ==  false){
	$sql = "UPDATE produto set
	nome = '$nome',
	cdcategoriaprod = '$cdcategoriaprod',
	imgproduto = '$endereco_imagem',
	descricao = '$descricao'
	where cdproduto = $codigo";

	$query= pg_query($conex,$sql);

	if($query){
		if(move_uploaded_file($_FILES["file"]["tmp_name"],"../" .$endereco_imagem)){
		}
	}
} else {
	$sql = "UPDATE produto set
	nome = '$nome',
	cdcategoriaprod = '$cdcategoriaprod',
	descricao = '$descricao'
	where cdproduto = $codigo";

	$query= pg_query($conex,$sql);
}


if (isset($query)) {
	?>
	<script>
	location.href="../indexSistema.php? page=forms/form_produto&cad=0&produto=<?php echo $nome; ?>&cod=<?php echo $nome; ?>";
	</script>
	<?php
}else{
	echo "Não foi possivel editar o produto - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
