<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Jogos</h4>
            </div>
            <div class="data-tables">
                <?php if(!empty($jogos)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Modalidade</th>
                                <th>Data</th>
                                <th>Time-1</th>
                                <th>Time-2</th>
                                <th>Vencedor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($jogos as $jogo ): ?>
                                <tr class="infos">
                                    <td><?= $jogo->nome ?></td>
                                    <td><?= $jogo->local ?></td>
                                    <td><?= $modalidades[$jogo->id]->nome ?></td>
                                    <td><?= $jogo->data ?></td>
                                    <td><?= $jogo->time_1 ?></td>
                                    <td><?= $jogo->time_2 ?></td>
                                    <td>Não tem</td>
                                    <td>Jogo ainda não começou</td>
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

            


