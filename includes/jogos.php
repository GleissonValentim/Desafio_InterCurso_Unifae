<div class="row justify-content-center mt-5 pb-5">
    <div class="card col-5">
        <div class="card-body">
            <h4 class="header-title mb-3">Cadastrar Jogo</h4>
            <form action="cadastrar_jogos.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome do jogo">
                </div>
                <div class="form-group">
                    <label for="local">Local: </label>
                    <input type="text" class="form-control" name="local" placeholder="Digite o local do jogo">
                </div>
                <div class="form-group">
                    <label for="data">Data: </label>
                    <input type="date" class="form-control" name="data" min="2025-07-01" placeholder="Digite a data do jogo">
                </div>
                <div class="form-group">
                    <label for="time_1">Time-1: </label>
                    <select class="form-control" name="time_1">
                        <option value="">Selecione um time</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="time_2">Time-2: </label>
                    <select class="form-control" name="time_2">
                        <option value="">Selecione um time</option>
                    </select>
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