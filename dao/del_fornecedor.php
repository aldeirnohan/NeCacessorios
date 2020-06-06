<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM fornecedor WHERE cdfornecedor = $_REQUEST[codigo];";
$slq_dados = "SELECT nomerazaosocial, cnpj FROM fornecedor WHERE cdfornecedor = $_REQUEST[codigo];";
$teste = "SELECT distinct c.cdfornecedor, c.telefone, c.bairro, c.rua, c.cnpj, c.nomerazaosocial,
 c.estado, c.email, c.numero, c.cidade
FROM fornecedor c
inner join compra v on v.cdfornecedor = c.cdfornecedor and c.cdfornecedor = $_REQUEST[codigo];";

$ss = pg_query($conex,$teste);
$dados_busca = pg_query($conex,$slq_dados);
$dados = pg_fetch_assoc($dados_busca);

$nome = $dados['nomerazaosocial'];
$cnpj =  $dados['cnpj'];

if (pg_num_rows($ss)>0){

  ?>

  <script>
    location.href="../indexSistema.php? page=exibir/listar_fornecedores&codigo=&delete=false&fornecedor=<?php echo $nome; ?>&cod=<?php echo $cnpj; ?>&motivo= O forncedor possuí dados de de compra cadastrados.";
  </script>"

  <?php
}else{
  $query = pg_query($conex,$sql);
  if (isset($query)) {
    ?>
    <script>
      location.href="../indexSistema.php? page=exibir/listar_fornecedores&codigo=&delete=true&fornecedor=<?php echo $nome; ?>&cod=<?php echo $cnpj; ?>";
    </script>"
    <?php
  } else {
    ?>

    <script>
      location.href="../indexSistema.php? page=exibir/listar_fornecedores&codigo=&delete=false&forncedor=<?php echo $nome; ?>&cod=<?php echo $cnpj; ?>&motivo=Erro interno no sistema.";
    </script>"

    <?php
  }
}
?>
