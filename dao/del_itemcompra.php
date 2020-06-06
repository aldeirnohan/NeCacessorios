<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM itemcompra WHERE cditemcompra = $_REQUEST[codigo];";
  session_start();
  $cdcompra=$_SESSION['cdcompra'];
  $fornecedor = $_SESSION['fornecedor'];
 
$query = pg_query($conex,$sql);
if (isset($query)) {
  //escrever aqui a mensagem de ok do delete.
  ?>
  <script>
    location.href="../indexSistema.php?page=forms/form_compra&cdcompra=<?php echo $cdcompra;?>&fornecedor=<?php echo $fornecedor; ?>";
  </script>"
  <?php
} else {
  ?>

  <script>
  alert('Erro ao Excluir Forma de Pagamento');
  location.href="../indexSistema.php? page=exibir/listar_pagamento&codigo=";
  </script>"

  <?php
}
?>
