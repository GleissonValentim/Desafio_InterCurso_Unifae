<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Times</h4>
            </div>
            <div class="data-tables">
                <?php if(!empty($times)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Time</th>
                                <th>Nome</th>
                                <th>Gestor</th>
                                <th>Numeo de atletas</th>
                                <th>Modalidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($times as $time): ?>
                                <?php foreach($time as $novoTime): ?> 
                                    <tr class="infos">
                                        <td><?= $countTime++ ?></td>
                                        <td><?= $novoTime->nome ?></td>
                                        <td><?= $novo[$novoTime->id]?></td>
                                        <td><?= $cont ?></td>
                                        <td><?= $modalidades[$novoTime->id]->nome?></td> 
                                    </tr>
                                <?php endforeach; ?>  
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Você não faz parte de nenhum time!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
