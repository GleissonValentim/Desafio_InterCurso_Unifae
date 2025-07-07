<div class="row justify-content-center mt-5">
    <div class="card col-5">
        <div class="card-body">
            <h4 class="header-title mb-3">Cadastrar time</h4>
            <form action="cadastrar_times.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome do time">
                </div>
                <div class="form-group">
                    <label for="modalidade">Modalidade: </label>
                    <select class="form-control" name="modalidade">
                        <option value="">Selecione uma modalidade</option>
                        <?php foreach($modalidades as $modalidade): ?>
                            <option value="<?= $modalidade->id ?>"><?= $modalidade->nome?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn enviar mt-2 pr-4 pl-4">Enviar</button>
            </form>
        </div>
    </div>
</div>