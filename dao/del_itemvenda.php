<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM itemvenda WHERE cditemvenda = $_REQUEST[codigo];";
  session_start();
  $cdvenda=$_SESSION['cdvenda'];
  $cliente = $_SESSION['cliente'];
 
$query = pg_query($conex,$sql);
if (isset($query)) {
  //escrever aqui a mensagem de ok do delete.
  ?>
  <script>
    location.href="../indexSistema.php?page=forms/form_venda&cdvenda=<?php echo $cdvenda;?>&cliente=<?php echo $cliente; ?>";
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
