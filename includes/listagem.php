<div class="mt-5 row justify-content-center tabela">
    <div class="card listar-jogos">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4 filtragem">
                <h4 class="header-title">Jogos</h4>
                <form action="index.php" class="d-flex" method="POST">
                    <select class="form-control mr-2" name="modalidades">
                        <?php if(empty($getModalidades)): ?>
                                <option value="">Selecione</option>
                            <?php else: ?>
                                <option value=""><?= $filtro ?></option>
                            <?php endif; ?>
                            <?php foreach($getModalidades as $getModalidade): ?>
                                <option value="<?= $getModalidade->id ?>"><?= $getModalidade->nome ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn enviar">Filtrar</button>
                </form>
            </div>
            <div class="data-tables">
                <?php if(!empty($jogos)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Jogo</th>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jogos as $jogo ): ?>
                                <?php if($jogo->id_modalidade == $modalidadesFiltadas->id):?>
                                    <tr class="infos">
                                        <td><?= $countJogos++ ?></td>
                                        <td><?= $jogo->nome ?></td>
                                        <td><?= $jogo->local ?></td>
                                        <td><?= $modalidades[$jogo->id]->nome ?></td>
                                        <td><?= $data[$jogo->id] ?></td>
                                        <td><?= $jogo->horario ?></td>
                                        <?php if($jogo->time1 != null): ?>
                                            <td><?= $times1[$jogo->id]->nome ?></td>
                                        <?php else: ?>
                                            <td class="proximo_jogo">Vencedor do jogo <?= $count[$jogo->id] ?></td>
                                        <?php endif; ?>
                                        <?php if($jogo->time2 != null): ?>
                                            <td><?= $times2[$jogo->id]->nome ?></td>
                                        <?php else: ?>
                                            <td class="proximo_jogo">Vencedor do jogo <?= $count[$jogo->id] ?></td>
                                        <?php endif; ?>
                                        <?php if(empty($vencedor[$jogo->id])): ?>
                                            <td>Não tem</td>
                                        <?php else: ?>
                                            <td><?= $vencedor[$jogo->id]->nome ?></a></td>
                                        <?php endif; ?>
                                        <td><?= $etapas[$jogo->id]->Nome ?></td>
                                        <td><?= $jogo->status ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhum jogo cadastrado!</strong></p>
                <?php endif; ?>
                <?php if($vazio): ?>
                    <p class="text-center mt-5"><strong>Não há nenhum jogo cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


            


