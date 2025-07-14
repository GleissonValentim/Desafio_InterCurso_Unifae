<div class="row justify-content-center mt-5 pb-5">
    <div class="card col-5">
        <div class="card-body">
            <h4 class="header-title mb-3">Cadastrar Jogos</h4>
            <form action="cadastrar_jogos.php" method="POST">
                <div class="form-group">
                    <label for="modalidade">Modalidade: </label>
                    <select class="form-control" name="modalidade">
                        <option value="">Selecione uma modalidade</option>
                        <?php foreach($modalidades as $modalidade): ?>
                            <option value="<?= $modalidade->id ?>"><?= $modalidade->nome?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn enviar mt-2 pr-4 pl-4">Sortear</button>
            </form>
        </div>
    </div>
</div>