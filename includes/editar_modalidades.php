<div class="row justify-content-center mt-5">
    <div class="card col-5 ">
        <div class="card-body">
            <h4 class="header-title mb-3">Editar modalidade</h4>
            <form action="editar_modalidades.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" value="<?= $modalidade->nome ?>">
                </div>
                <div class="form-group">
                    <label for="regras">Atletas: </label>
                    <input type="number" class="form-control" name="atletas" value="<?= $modalidade->numero_atletas ?>">
                </div>
                <div class="form-group">
                    <label for="regras">Regras: </label>
                    <textarea class="form-control" name="regras" rows="6"><?= $modalidade->regras ?></textarea>
                </div>
                <div class="d-flex">
                    <button type="hidden" name="editar" class="btn enviar mt-2 mr-2 pr-4 pl-4" value="<?= $modalidade->id ?>">Editar</button>
                    <button type="hidden" name="excluir" class="btn btn-danger mt-2 pr-4 pl-4" value="<?= $modalidade->id ?>">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>