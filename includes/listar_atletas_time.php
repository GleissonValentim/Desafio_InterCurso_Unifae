

<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body"> 
            <div class="row d-flex justify-content-between align-items-center mb-4 filtragem">
                <h4 class="header-title"><?= $titulo ?></h4>
                <form action="atletas.php" class="d-flex" method="POST">
                    <select class="form-control mr-2" name="modalidades">
                        <option value="">Selecione</option>
                        <?php if(isset($getModalidades)): ?>           
                            <?php foreach($getModalidades as $getModalidade): ?>
                                <option value="<?= $getModalidade->id ?>"><?= $getModalidade->nome ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <button type="submit" class="btn enviar">Filtrar</button>
                </form>
            </div>
            <div class="data-tables">
                <?php if(!empty($atletas)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Atleta</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($flatAtletas as $atleta): ?>
                                <tr class="infos">
                                    <td><?= $countAtleta++ ?></td>
                                    <td><?= $atleta->nome ?></td>
                                    <td><?= $atleta->email ?></td>
                                    <td><?= $atleta->tipo ?></td>
                                    <td><button type="hidden" class="btn btn-danger deletar-formulario ml-2 remover_atleta" id="<?= $atleta->id ?>" name="remover">Remover Atleta</button></td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhum atleta cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
