<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM produto WHERE cdproduto = $_REQUEST[codigo];";
$slq_dados = "SELECT nome, quantidade FROM produto WHERE cdproduto = $_REQUEST[codigo];";
$dados_busca = pg_query($conex,$slq_dados);
$dados = pg_fetch_assoc($dados_busca);
$nome = $dados['nome'];
$quantidade =  $dados['quantidade'];
$query = pg_query($conex,$sql);
if (isset($query)) {
  //escrever aqui a mensagem de ok do delete.
  ?>
  <script>
     location.href="../indexSistema.php? page=exibir/listar_produtos&codigo=&delete=true&produto=<?php echo $nome; ?>&cod=<?php echo $quantidade; ?>";
  </script>"
  <?php
} else {
  ?>

  <script>
   location.href="../indexSistema.php? page=exibir/listar_produtos&codigo=&delete=false&produto=<?php echo $nome; ?>&cod=<?php echo $quantidade; ?>&motivo=Erro interno no sistema.";
  </script>"

  <?php
}
?>
