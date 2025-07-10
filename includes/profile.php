<div class="row justify-content-center mt-5">
    <div class="card col-5">
        <div class="card-body">
            <h4 class="header-title mb-3">Seus dados pessoais</h4>
            <form action="editar_perfil.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" value="<?= $usuario->nome ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" name="email" value="<?= $usuario->email ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="senha">Nova senha: </label>
                    <input type="password" class="form-control" name="senha">
                </div>
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar senha: </label>
                    <input type="password" class="form-control" name="confirmar_senha">
                </div>
                <button type="submit" class="btn enviar mt-2 pr-4 pl-4">Editar</button>
            </form>
        </div>
    </div>
</div>