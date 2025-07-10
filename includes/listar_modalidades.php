<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Modalidades</h4>
                <a href="cadastrar_modalidades.php"><button class="btn enviar pr-4 pl-4">Cadastrar Modalidade</button></a>
            </div>
            <div class="data-tables">
                <?php if(!empty($modalidades)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Nome</th>
                                <th>Regras</th>
                                <th>Numeo máximo de atletas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($modalidades as $modalidade): ?>
                                <tr class="infos">
                                    <td><?= $modalidade->nome?></td>
                                    <td><?= $modalidade->regras?></td>
                                    <td><?= $modalidade->numero_atletas?></td>
                                    <form action="modalidades.php" method="POST">
                                        <td>
                                            <button type="hidden" class="btn enviar-formulario ml-2" value="<?=$modalidade->id?>" name="editar">Editar</button>
                                            <button type="hidden" class="btn btn-danger deletar-formulario ml-2" value="<?=$modalidade->id?>" name="excluir">Deletar</button>
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
