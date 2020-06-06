<?php

require_once('../conexao/conexao.php');
$nome = $_POST['nome'];
$cdcategoriaprod = $_POST['cdcategoriaprod'];
$cdfornecedor = $_POST['cdfornecedor'];
$descricao = $_POST['descricao'];
$nomeArquivo = $_FILES['file']['name'];
$dataAtual = date("d/m/Y H:i:s");
$hash = $dataAtual;

$nomehash = md5($hash);

$arrayNomeArquivo = explode('.', $nomeArquivo);

$extensao = end($arrayNomeArquivo);

$endereco_imagem = "imagens/produtos/".$nomehash.".".$extensao;

?>
<?php
$sql = "INSERT INTO produto (nome, cdcategoriaprod,  imgproduto, descricao, cdfornecedor) VALUES ('$nome',   $cdcategoriaprod, 
 '$endereco_imagem' , '$descricao' , '$cdfornecedor')";

$query= pg_query($conex,$sql);


if($nomeArquivo != ""){
	if($query){
		if(move_uploaded_file($_FILES["file"]["tmp_name"],"../" .$endereco_imagem)){
		}
	}
}


if (isset($query)) {
	?>
	<script>
	location.href="../indexSistema.php? page=forms/form_produto&cad=1&produto=<?php echo $nome; ?>&cod=<?php echo $nome; ?>";
	</script>"
	<?php
}else{
	echo "Não foi possivel cadastrar o produto - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
