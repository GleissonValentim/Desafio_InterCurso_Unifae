<div class="row justify-content-center mt-5">
    <div class="card col-5">
        <div class="card-body">
            <h4 class="header-title mb-3">Editar Jogo</h4>
            <form action="editar_jogos.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" value="<?=$jogo->nome?>">
                </div>
                <div class="form-group">
                    <label for="local">Local: </label>
                    <input type="text" class="form-control" name="local" value="<?=$jogo->local?>">
                </div>
                <!-- <div class="form-group">
                    <label for="data">Modalidade: </label>
                    <input type="modalidade" class="form-control" name="modalidade" value="<?=$verificarModalidade->nome?>">
                </div> -->
                <div class="form-group">
                    <label for="data">Data: </label>
                    <input type="date" class="form-control" name="data" min="2025-07-01" value="<?=$jogo->data?>">
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
                <div class="d-flex">
                    <button type="hidden" name="editar" class="btn enviar mt-2 mr-2 pr-4 pl-4" value="<?= $jogo->id ?>">Editar</button>
                    <button type="hidden" name="excluir" class="btn btn-danger mt-2 pr-4 pl-4" value="<?= $jogo->id ?>">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>