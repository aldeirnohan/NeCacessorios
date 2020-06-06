<?php
require_once('../conexao/conexao.php');
$categoriaprod = $_POST['nome'];
$codigo = $_POST['cdcategoriaprod'];

?>
<?php
$sql = "UPDATE categoriaprod set
nome= '$categoriaprod'
where cdcategoriaprod= $codigo";

$query= pg_query($conex,$sql);

if (isset($query)) {
	?>
	<script>
	alert('Categoria produta editado  com sucesso');
	location.href="../indexSistema.php? page=exibir/listar_categoriaprod&codigo=&alterado=1";
	</script>"
</script>"
<?php
}else{
	echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}
?>
