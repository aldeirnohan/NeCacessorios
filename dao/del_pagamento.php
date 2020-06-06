<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM formapagamento WHERE cdformapagamento = $_REQUEST[codigo];";
$query = pg_query($conex,$sql);
if (isset($query)) {
  //escrever aqui a mensagem de ok do delete.
  ?>
  <script>alert('Forma de pagamento Excluída com sucesso');
  location.href="../indexSistema.php? page=exibir/listar_pagamento&codigo=";
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
