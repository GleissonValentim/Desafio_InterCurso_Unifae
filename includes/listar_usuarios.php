<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Gestores</h4>
                <select class="form-control col-md-1" name="usuarios">
                    <option value="gestor">Gestor</option>
                    <option value="comum">Comum</option>
                </select>
            </div>
            <div class="data-tables">
                <?php if(!empty($usuarios)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $usuario ): ?>
                                <tr class="infos">
                                    <td><a href="#"><?= $usuario->nome ?></a></td>
                                    <td><a href="#"><?= $usuario->email ?></a></td>
                                    <td><a href="#"><?= $usuario->tipo ?></a></td>
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
