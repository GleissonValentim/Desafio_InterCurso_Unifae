<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <form action="definir_atletas.php" method="POST" class="row d-flex justify-content-between align-items-center mb-4">
                <div class="col-auto">
                    <h4 class="header-title">Atletas do time</h4>
                </div>
            </form>
            <div class="data-tables">
                <?php if(!empty($atletas)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($flatAtletas as $atleta): ?>
                                <tr class="infos">
                                    <td><?= $atleta->nome ?></td>
                                    <td><?= $atleta->email ?></td>
                                    <td><?= $atleta->tipo ?></td>
                                    <form action="atletas.php" method="POST">
                                        <td><button type="hidden" class="btn btn-danger deletar-formulario ml-2" value="<?= $atleta->id ?>" name="remover">Remover Atleta</button></td>
                                    </form>
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
