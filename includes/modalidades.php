<div class="row justify-content-center mt-5">
    <div class="card col-5 ">
        <form action="modalidades.php" class="card-body" method="POST">
            <h4 class="header-title">Cadastrar modalidade</h4>
            <form>
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome da modalidade">
                </div>
                <div class="form-group">
                    <label for="regras">Regras: </label>
                    <input type="text" class="form-control" name="regras" placeholder="Digite as regras">
                </div>
                <div class="form-group">
                    <label for="regras">Atletas: </label>
                    <input type="number" class="form-control" name="atletas" placeholder="Digite o número máximo permitido de atletas">
                </div>
                <button type="submit" value="enviar" class="btn enviar mt-2 pr-4 pl-4">Enviar</button>
            </form>
        </form>
    </div>
</div>