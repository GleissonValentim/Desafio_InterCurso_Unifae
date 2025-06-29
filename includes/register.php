
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="register.php"  method="POST">
                    <div class="login-form-head">
                        <h4>Crie sua Conta</h4>
                        <p>Bem-vindo! Cadastre-se e junte-se a nós</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputName1">Nome: </label>
                            <input type="text" id="exampleInputName1" name="nome">
                            <i class="ti-user"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email: </label>
                            <input type="email" id="exampleInputEmail1" name="email">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Senha: </label>
                            <input type="password" id="exampleInputPassword1" name="senha">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword2">Confirmar senha: </label>
                            <input type="password" id="exampleInputPassword2" name="confirmar_senha">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <select name="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option value="Atleta">Atleta</option>
                                <option value="Organizador">Organizador</option>
                                <option value="Gestor de time">Gestor de time</option>
                            </select>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" value="enviar">Enviar <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Você já tem uma conta? <a href="login.php">Entrar</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>