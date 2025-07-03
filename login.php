<?php
    session_start();

    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;

    if (isset($_SESSION['usuario'])) {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    if(isset($_POST['email'], $_POST['senha'])){

        $email = $obUsuario->email = $_POST["email"];
        $senha = $obUsuario->senha = $_POST["senha"];
        
        if ($email != '' && $senha != ''){

            $verificarUsuario = Usuario::getUsuarioSenha($email);

            if ($verificarUsuario != '' && password_verify($senha, $verificarUsuario->senha)){
                $usuario = Usuario::getUsuario($email);

                $_SESSION['usuario'] = $usuario->id;

                $obMensagem->getMensagem("index.php", "success", "Bem vindo ".$usuario->nome);
            } else {
                $obMensagem->getMensagem("login.php", "error", "Usuário ou senha incorretos. Por favor, tente novamente.");
            }
        } else {
            $obMensagem->getMensagem("login.php", "error", "Por favor preencha todos os campos!");
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/login.php';
    include __DIR__.'/includes/footer.php';
           