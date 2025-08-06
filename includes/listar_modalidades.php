<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Modalidades</h4>
                <!-- <button type="button" class="btn enviar pr-4 pl-4" data-toggle="modal" data-target="#modalExemplo">
                    Cadastrar Modalidade
                </button> -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Falar com @mdo</button>
                <!-- <form action="" id="cadastrar">
                    <button class="btn enviar pr-4 pl-4">Cadastrar Modalidade</button><
                </form> -->
            </div>
            <div class="data-tables">
                <?php if(!empty($modalidades)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Modalidade</th>
                                <th>Nome</th>
                                <th>Regras</th>
                                <th>Numeo máximo de atletas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($modalidades as $modalidade): ?>
                                <tr class="infos">
                                    <td><?= $countModalidade++ ?></td>
                                    <td><?= $modalidade->nome?></td>
                                    <td><?= $modalidade->regras?></td>
                                    <td><?= $modalidade->numero_atletas?></td>
                                    <form action="modalidades.php" method="POST">
                                        <td>
                                            <button type="hidden" class="btn enviar-formulario ml-2" value="<?=$modalidade->id?>" name="editar">Editar</button>
                                            <button id="form1" type="hidden" class="btn btn-danger deletar-formulario ml-2" value="<?=$modalidade->id?>" name="excluir">Deletar</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhuma modalidade cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="row justify-content-center mt-5">
        <div class="card col-5 ">
            <div class="card-body">
                <h4 class="header-title mb-3">Cadastrar modalidade</h4>
                <form action="cadastrar_modalidades.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome da modalidade">
                    </div>
                    <div class="form-group">
                        <label for="regras">Atletas: </label>
                        <input type="number" class="form-control" name="atletas" placeholder="Digite o número máximo permitido de atletas">
                    </div>
                    <div class="form-group">
                        <label for="regras">Regras: </label>
                        <textarea class="form-control" name="regras" rows="6" placeholder="Digite as regras"></textarea>
                    </div>
                    <div class="d-flex">
                        <button type="submit" value="enviar" class="btn enviar mt-2 pr-4 pl-4 mr-2">Enviar</button>
                        <button type="button" class="btn enviar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar modalidade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" class="form-control" name="nome" placeholder="Digite o nome da modalidade">
          </div>
          <div class="form-group">
            <label for="regras">Atletas: </label>
            <input type="number" class="form-control" name="atletas" placeholder="Digite o número máximo permitido de atletas">
          </div>
          <div class="form-group">
            <label for="regras">Regras: </label>
            <textarea class="form-control" name="regras" rows="6" placeholder="Digite as regras"></textarea>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" value="enviar" class="btn enviar mt-2 pr-4 pl-4 mr-2">Enviar</button>
        <button type="button" class="btn enviar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    });
</script>