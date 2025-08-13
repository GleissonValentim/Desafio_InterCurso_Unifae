<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Meu time</h4>
                <button type="button" class="btn enviar pr-4 pl-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Cadastrar Time</button>
            </div>
            <div class="data-tables">
                <?php if(!empty($times)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Time</th>
                                <th>Nome</th>
                                <th>Numero de Atletas</th>
                                <th>Modalidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($times as $time): ?>
                                <tr class="infos">
                                    <td><?= $countTime++ ?></td>
                                    <td><?= $time->nome?></td>
                                    <td><?= $cont?></td>
                                    <td><?= $modalidades[$time->id]->nome ?></td>
                                    <td><button class="btn btn-danger deletar-formulario ml-2 remover_time" id="<?= $time->id ?>">Excluir time</button></td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhum time cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="cadastrar_time">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Time</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control" name="nome" placeholder="Digite o nome do time">
            </div>
            <div class="form-group">
                <label for="modalidade">Modalidade: </label>
                <select class="form-control" name="modalidade">
                    <option value="">Selecione uma modalidade</option>
                    <?php foreach($getModalidades as $modalidade): ?>
                        <option value="<?= $modalidade->id ?>"><?= $modalidade->nome?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" value="enviar" id="btn-show-sweetalert" class="btn enviar mt-2 pr-4 pl-4 mr-2">Enviar</button>
            <button type="button" class="btn cancelar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>
