<div class="row">
  <h3 class="text-center">Forma de Pagamento</h3>
  <form class="form-horizontal" name="pagamento" action="dao/cad_categoriaprod.php" method="post" >
    <div class="form-group">
      <label>Tipo</label>
      <select name="nome" class="form-control">
      <option value="COSMÉTICO">COSMÉTICO</option>
      <option value="FOLHEADOS">FOLHEADOS</option>
      <option value="PERFUMARIA">PERFUMARIA</option>
      <option value="LINGERIE">LINGERIE</option>
      </select>
    </div>                 
       <button type="submit" class="btn btn-primary">Cadastrar</button>
       <button type="reset" class="btn btn-primary">Limpar</button>

  </form>
</div>