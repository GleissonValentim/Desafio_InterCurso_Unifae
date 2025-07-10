<div class="mt-5 row justify-content-center tabela">
    <div class="card col-10">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h4 class="header-title">Meu time</h4>
                <a href="cadastrar_times.php"><button class="btn enviar pr-4 pl-4">Cadastrar Time</button></a>
            </div>
            <div class="data-tables">
                <?php if(!empty($times)): ?>
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Nome</th>
                                <th>Numero de Atletas</th>
                                <th>Modalidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($times as $time): ?>
                                <tr class="infos">
                                    <td><?= $time->nome?></a></td>
                                    <td><?= $cont?></td>
                                    <td><?= $modalidade->nome ?></a></td>
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center mt-5"><strong>Não há nenhum time cadastrado!</strong></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
