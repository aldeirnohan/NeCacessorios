<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM categoriaprod WHERE cdcategoriaprod = $_REQUEST[codigo];";
$query = pg_query($conex,$sql);
if (isset($query)) {
  //escrever aqui a mensagem de ok do delete.
  ?>
  <script>alert('Forma de pagamento Excluída com sucesso');
  location.href="../indexSistema.php? page=exibir/listar_categoriaprod&codigo=";
  </script>"
  <?php
} else {
  ?>

  <script>
  alert('Erro ao Excluir Forma de Pagamento');
  location.href="../indexSistema.php? page=exibir/listar_categoriapro&codigo=";
  </script>"

  <?php
}
?>
