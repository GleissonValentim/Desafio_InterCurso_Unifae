<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <form action="definir_atletas.php" method="POST" class="row d-flex justify-content-between align-items-center mb-4">
                <div class="col-auto">
                    <h4 class="header-title"><?= $titulo ?></h4>
                </div>
            </form>
            <div class="data-tables">
                <?php if(!empty($usuarios)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Usuário</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $usuario): ?>
                                <tr class="infos">
                                    <td><?= $countAtleta++ ?></td>
                                    <td><?= $usuario->nome ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td><?= $usuario->tipo ?></td>
                                    <!-- <td><button type="hidden" class="btn enviar-formulario ml-2 definir_atleta" id="<?= $usuario->id ?>" name="definir">Definir Atleta</button></td> -->
                                    <td><button type="button" class="btn enviar-formulario ml-2 definir_atleta_1" value="<?= $usuario->id ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Definir Atleta</button></td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhum usuário cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="definir_atleta_2">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Escolha um time</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <label for="times">Meus times: </label>
            <select class="form-control id_atleta" name="modalidade">
                <option value="">Selecione</option>
                <?php foreach($times as $time): ?>
                    <option value="<?= $time->id ?>"><?= $getModalidades[$time->id]->nome ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" value="enviar" class="btn enviar mt-2 pr-4 pl-4 mr-2">Definir atleta</button>
            <button type="button" class="btn cancelar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>
