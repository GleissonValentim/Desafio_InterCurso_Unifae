<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Notificações</h4>
            </div>
            <div class="data-tables">
                <?php if(!empty($notificacoes)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Time</th>
                                <th>Notificação</th>
                                <th>Modalidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($flatTimes as $time): ?>
                                <tr class="infos">
                                    <td><?= $time->nome ?></td>
                                    <td>Convidou você a fazer parte do time</td>
                                    <td><?= $modalidades[$time->id]->nome ?></td>
                                    <td>
                                        <button type="hidden" class="btn enviar-formulario ml-2 editar_notificacao" id="<?= $time->id ?>" name="aceitar">Aceitar</button>
                                        <button type="hidden" class="btn btn-danger deletar-formulario ml-2 remover_notificacao" id="<?= $time->id ?>" name="recusar">Recusar</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhuma notificação!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
