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
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $usuario): ?>
                                <tr class="infos">
                                    <td><?= $usuario->nome ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td><?= $usuario->tipo ?></td>
                                    <form action="definir_atletas.php" method="POST">
                                        <td><button type="hidden" class="btn enviar-formulario ml-2" value="<?= $usuario->id ?>" name="definir">Definir Atleta</button></td>
                                    </form>
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
