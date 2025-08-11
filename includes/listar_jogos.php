<div class="mt-5 row justify-content-center tabela">
    <div class="card listar-jogos">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4 filtragem">
                <h4 class="header-title">Jogos</h4>
                <div class="d-flex align-items-center">
                    <!-- <a href="cadastrar_jogos.php"><button class="btn enviar pr-4">Sortear Jogos</button></a> -->
                     <button type="button" class="btn enviar pr-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Sortear jogos</button>
                    <form action="jogos.php" class="d-flex" method="POST">
                        <select class="form-control ml-4 mr-2" name="modalidades">
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
            </div>
            <div class="data-tables">
                <table id="dataTable" class="text-center jogos">
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
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody class="listar_jogos">
                        
                    </tbody>
                </table>
                <!-- <?php if(!empty($jogos)): ?>
                    <table id="dataTable" class="text-center jogos">
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
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="listar_jogos">
                            <?php foreach($jogos as $jogo): ?>
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
                                            <td class="proximo_jogo">Vencedor do jogo <?= $count2[$jogo->id] ?></td>
                                        <?php endif; ?>
                                        <?php if(empty($vencedor[$jogo->id])): ?>
                                            <td>Não tem</td>
                                        <?php else: ?>
                                            <td><?= $vencedor[$jogo->id]->nome ?></a></td>
                                        <?php endif; ?>
                                        <td><?= $etapas[$jogo->id]->Nome ?></td>
                                        <td><?= $jogo->status ?></td>
                                        <form action="jogos.php" method="POST">
                                            <td>
                                                <?php if($jogo->status != 'concluido'): ?>
                                                    <button type="button" class="btn enviar-formulario ml-2 editar_jogos" data-toggle="modal" data-target="#exampleEdit" data-whatever="@mdo" id="<?=$jogo->id?> " name="editar">Editar Jogo</button>
                                                <?php endif; ?>
                                            </td>
                                        </form>
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
                <?php endif; ?>  -->
            </div>
        </div>
    </div>
</div>

<!-- Modal sortear -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="sortear_jogos">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sortear Jogos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <label for="modalidade">Modalidade: </label>
                <select class="form-control" name="modalidade">
                    <option value="">Selecione uma modalidade</option>
                    <?php foreach($modalidades as $modalidade): ?>
                        <option value="<?= $modalidade->id ?>"><?= $modalidade->nome?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="modal-footer">
            <button type="submit" value="enviar" id="btn-show-sweetalert" class="btn enviar mt-2 pr-4 pl-4 mr-2">Sortear</button>
            <button type="button" class="btn cancelar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal editar -->
<div class="modal fade" id="exampleEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" id="sortear_jogos">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar jogo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control" name="nome" value="<?=$jogo->nome?>" placeholder="Digite o nome do jogo">
            </div>
            <div class="form-group">
                <label for="local">Local: </label>
                <input type="text" class="form-control" name="local" value="<?=$jogo->local?>" placeholder="Digite o local do jogo">
            </div>
            <div class="form-group">
                <label for="data">Data: </label>
                <input type="date" class="form-control" name="data" min="2025-07-01" value="<?=$jogo->data?>">
            </div>
            <div class="form-group">
                <label for="horario">Horario: </label>
                <input type="time" class="form-control" name="horario" placeholder="Digite o horário do jogo" value="<?=$jogo->horario?>">
            </div>
            <div class="form-group">
                <label for="vencedor">Vencedor: </label>
                <select class="form-control" name="vencedor">
                    <option value="">Selecione</option>
                    <option value="<?= $jogo->time1 ?>"><?= $time1->nome ?></option>
                    <?php if(!empty($jogo->time2)): ?>
                        <option value="<?= $jogo->time2 ?>"><?= $time2->nome ?></option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status: </label>
                <select class="form-control" name="status">
                    <?php if($jogo->status == 'Não começou'): ?>
                        <option value="">Selecione</option>
                    <?php else: ?>
                        <option value="<?= $jogo->status ?>"><?= $jogo->status ?></option>
                    <?php endif; ?>
                    <option value="Em andamento">Em andamento</option>
                    <option value="concluido">Concluido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="modalidade">Modalidade: </label>
                <select class="form-control" name="modalidade">
                    <option value="<?=$verificarModalidade->id?>"><?=$verificarModalidade->nome?></option>
                    <?php foreach($modalidades as $modalidade): ?>
                        <option value="<?= $modalidade->id ?>"><?= $modalidade->nome?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" value="enviar" id="btn-show-sweetalert" class="btn enviar mt-2 pr-4 pl-4 mr-2">Sortear</button>
            <button type="button" class="btn cancelar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>


