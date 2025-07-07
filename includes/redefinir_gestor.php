<div class="row justify-content-center mt-5">
    <div class="card col-5 ">
        <div class="card-body">
            <h4 class="header-title mb-3">Definir gestor</h4>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="nome">Gestor antigo: </label>
                    <input type="text" class="form-control" name="antigo" value="<?= $usuario->nome ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="modalidade">Modalidade: </label>
                    <select class="form-control" name="gestor">
                        <option value="">Selecione uma gestor</option>
                        <?php foreach($gestores as $gestor): ?>
                            <option value="<?= $gestor->id ?>"><?= $gestor->nome?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex">
                    <button type="hidden" name="editar" class="btn enviar mt-2 pr-4 pl-4">Redefinir</button>
                </div>
            </form>
        </div>
    </div>
</div>