<div class="row justify-content-center mt-5">
    <div class="card col-5 ">
        <div class="card-body">
            <h4 class="header-title mb-3">Cadastrar modalidade</h4>
            <form action="cadastrar_modalidades.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome da modalidade">
                </div>
                <div class="form-group">
                    <label for="regras">Atletas: </label>
                    <input type="number" class="form-control" name="atletas" placeholder="Digite o número máximo permitido de atletas">
                </div>
                <div class="form-group">
                    <label for="regras">Regras: </label>
                    <textarea class="form-control" name="regras" rows="6" placeholder="Digite as regras"></textarea>
                </div>
                <button type="submit" value="enviar" class="btn enviar mt-2 pr-4 pl-4">Enviar</button>
            </form>
        </div>
    </div>
</div>