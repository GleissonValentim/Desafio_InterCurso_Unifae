<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <form action="gestores.php" method="POST" class="row d-flex justify-content-between align-items-center mb-4">
                <div class="col-auto">
                    <h4 class="header-title"><?= $titulo ?></h4>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <select class="form-control ml-2" name="usuarios">
                        <!-- <option value="">Selecione</option> -->
                        <option value="gestor"><?= $filtro ?></option>
                        <option value="gestor">Gestor</option>
                        <option value="comum">Comum</option>
                    </select>
                    <button type="submit" class="btn enviar ml-2">Filtrar</button>
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
                                <?php if($titulo == "Gestores"): ?>
                                    <tr class="infos">
                                        <td><?= $countUsuario++ ?></td>
                                        <td><?= $usuario->nome ?></td>
                                        <td><?= $usuario->email ?></td>
                                        <td><?= $usuario->tipo ?></td>
                                        <!-- <form action="gestores.php" method="POST"> -->
                                            <td><button type="hidden" id="deletarGestor" class="btn btn-danger deletar-formulario ml-2" value="<?= $usuario->id ?>" name="remover">Remover gestor</button></td>
                                        <!-- </form> -->
                                    </tr>
                                <?php else: ?>
                                    <tr class="infos">
                                        <td><?= $countUsuario++ ?></td>
                                        <td><?= $usuario->nome ?></td>
                                        <td><?= $usuario->email ?></td>
                                        <td><?= $usuario->tipo ?></td>
                                        <!-- <form action="gestores.php" method="POST"> -->
                                            <td><button type="hidden" id="definir" class="btn enviar-formulario ml-2" value="<?= $usuario->id ?>" name="definir">Definir gestor</button></td>
                                        <!-- </form> -->
                                    </tr>
                                <?php endif; ?>
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
