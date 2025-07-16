<div class="mt-5 row justify-content-center tabela">
    <div class="card col-11">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Jogos</h4>
                <div class="col-auto d-flex align-items-center">
                    <!-- <select class="form-control mr-2" name="usuarios">
                        <option value="">Selecione</option>
                        <option value="gestor">Gestor</option>
                        <option value="comum">Comum</option>
                    </select> -->
                    <!-- <button type="submit" class="btn enviar ml-2">Filtrar</button> -->
                    <a href="cadastrar_jogos.php"><button class="btn enviar pr-4 pl-4">Sortear Jogos</button></a>
                </div>
            </div>
            <div class="data-tables">
                <?php if(!empty($jogos)): ?>
                    <table id="dataTable" class="text-center jogos">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Modalidade</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>Time-1</th>
                                <th>Time-2</th>
                                <th>Vencedor</th>
                                <th>Etapa</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jogos as $jogo): ?>
                                <tr class="infos">
                                    <td><?= $jogo->nome ?></td>
                                    <td><?= $jogo->local ?></td>
                                    <td><?= $modalidades[$jogo->id]->nome ?></td>
                                    <td><?= $jogo->data ?></td>
                                    <td><?= $jogo->horario ?></td>
                                    <?php if($jogo->time1 != null && $jogo->time2 != null): ?>
                                        <td><?= $times1[$jogo->id]->nome ?></td>
                                        <td><?= $times2[$jogo->id]->nome ?></td>
                                    <?php else: ?>
                                        <td></td>
                                        <td></td>
                                    <?php endif; ?>
                                    <?php if(empty($vencedor[$jogo->id])): ?>
                                        <td>Não tem</td>
                                    <?php else: ?>
                                        <td><?= $vencedor[$jogo->id]->nome ?></a></td>
                                    <?php endif; ?>
                                    <td><?= $jogo->etapa ?></td>
                                    <td><?= $jogo->status ?></td>
                                    <form action="jogos.php" method="POST">
                                        <td>
                                            <?php if($jogo->status != 'concluido'): ?>
                                                <button type="hidden" class="btn enviar-formulario ml-2" value="<?=$jogo->id?>" name="editar">Editar</button>
                                            <?php endif; ?>
                                            <button type="hidden" class="btn btn-danger deletar-formulario ml-2" value="<?=$jogo->id?>" name="excluir">Deletar</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhum jogo cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

