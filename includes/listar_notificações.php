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
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($notificacoes as $notificacao): ?>
                                <?php foreach($flatTimes as $time): ?>
                                    <tr class="infos">
                                        <td><?= $time->nome ?></td>
                                        <td>Convidou você a fazer parte do time</td>
                                        <form action="notificações.php" method="POST">
                                            <td>
                                                <button type="hidden" class="btn enviar-formulario ml-2" value="<?= $time->id ?>" name="aceitar">Aceitar</button>
                                                <button type="hidden" class="btn btn-danger deletar-formulario ml-2" value="<?= $time->id ?>" name="recusar">Recusar</button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?> 
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

<!-- <div class="mt-5 row justify-content-center">
    <div class="card col-lg-5">
        <div class="card-body">
            <h4 class="header-title mb-4">Notificações</h4>
            <div id="accordion4" class="according accordion-s3 gradiant-bg">
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#accordion41">Collapsible Group
                            Item #1</a>
                    </div>
                    <div id="accordion41" class="collapse show" data-parent="#accordion4">
                        <div class="card-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo eaque porro alias assumenda accusamus incidunt odio molestiae maxime quo atque in et quaerat, vel unde aliquam aperiam quidem consectetur omnis dicta officiis? Dolorum, error dolorem!
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion42">Collapsible
                            Group Item #2</a>
                    </div>
                    <div id="accordion42" class="collapse" data-parent="#accordion4">
                        <div class="card-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo eaque porro alias assumenda accusamus incidunt odio molestiae maxime quo atque in et quaerat, vel unde aliquam aperiam quidem consectetur omnis dicta officiis? Dolorum, error dolorem!
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion43">Collapsible
                            Group Item #3</a>
                    </div>
                    <div id="accordion43" class="collapse" data-parent="#accordion4">
                        <div class="card-body">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo eaque porro alias assumenda accusamus incidunt odio molestiae maxime quo atque in et quaerat, vel unde aliquam aperiam quidem consectetur omnis dicta officiis? Dolorum, error dolorem!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
