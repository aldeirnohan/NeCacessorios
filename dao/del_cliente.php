<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM cliente WHERE cdcliente = $_REQUEST[codigo];";
$slq_dados = "SELECT nome, cpf FROM cliente WHERE cdcliente = $_REQUEST[codigo];";
$teste = "SELECT distinct c.cdcliente, c.celular, c.bairro, c.rua, c.cpf, c.nome, c.sexo, c.idade, c.numcasa
FROM cliente c
inner join venda v on v.cdcliente = c.cdcliente and c.cdcliente = $_REQUEST[codigo];";

$ss = pg_query($conex,$teste);
$dados_busca = pg_query($conex,$slq_dados);
$dados = pg_fetch_assoc($dados_busca);

$nome = $dados['nome'];
$cpf =  $dados['cpf'];

if (pg_num_rows($ss)>0){

  ?>

  <script>
    location.href="../indexSistema.php? page=exibir/listar_clientes&codigo=&delete=false&cliente=<?php echo $nome; ?>&cod=<?php echo $cpf; ?>&motivo=Cliente possuí dados de venda cadastrados.";
  </script>"

  <?php
}else{
  $query = pg_query($conex,$sql);
  if (isset($query)) {
    ?>
    <script>
      location.href="../indexSistema.php? page=exibir/listar_clientes&codigo=&delete=true&cliente=<?php echo $nome; ?>&cod=<?php echo $cpf; ?>";
    </script>"
    <?php
  } else {
    ?>

    <script>
      location.href="../indexSistema.php? page=exibir/listar_clientes&codigo=&delete=false&cliente=<?php echo $nome; ?>&cod=<?php echo $cpf; ?>&motivo=Erro interno no sistema.";
    </script>"

    <?php
  }
}
?>
