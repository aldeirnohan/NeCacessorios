<?php
require_once"../conexao/conexao.php";
$sql = "DELETE FROM funcionario WHERE cdfuncionario = $_REQUEST[codigo];";
$slq_dados = "SELECT nome, login FROM funcionario WHERE cdfuncionario = $_REQUEST[codigo];";


$dados_busca = pg_query($conex,$slq_dados);
$dados = pg_fetch_assoc($dados_busca);

$nome = $dados['nome'];
$login =  $dados['login'];



$query = pg_query($conex,$sql);
if (isset($query)) {
    ?>
    <script>
      location.href="../indexSistema.php? page=exibir/listar_funcionario&codigo=&delete=true&funcionario=<?php echo $nome; ?>&cod=<?php echo $login; ?>";
    </script>"
    <?php
} else {
    ?>

    <script>
      location.href="../indexSistema.php? page=exibir/listar_funcionario&codigo=&delete=false&funcionario=<?php echo $nome; ?>&cod=<?php echo $login; ?>&motivo=Erro interno no sistema.";
    </script>

    <?php
  
}
?>
