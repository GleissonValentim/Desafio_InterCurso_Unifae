<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Modalidades</h4>
                <button type="button" class="btn enviar pr-4 pl-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Cadastrar Modalidade</button>
            </div>
            <div class="data-tables">
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
                    <tbody id="exibir_modalidades">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="cadastrar_modalidade">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastrar modalidade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
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
        </div>
        <div class="modal-footer">
            <button type="submit" value="enviar" id="btn-show-sweetalert" class="btn enviar mt-2 pr-4 pl-4 mr-2">Enviar</button>
            <button type="button" class="btn cancelar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editarModalidade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="atualizar_modalidade">
        <div class="modal-header">
            <h5 class="modal-title" id="editarModalidade">Editar modalidade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control" name="nome" value="<?= $modalidade->nome ?>">
            </div>
            <div class="form-group">
                <label for="regras">Atletas: </label>
                <input type="number" class="form-control" name="atletas" value="<?= $modalidade->numero_atletas ?>">
            </div>
            <div class="form-group">
                <label for="regras">Regras: </label>
                <textarea class="form-control" name="regras" rows="6"><?= $modalidade->regras ?></textarea>
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
