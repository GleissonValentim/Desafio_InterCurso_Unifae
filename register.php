<?php
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;

    // if (!isset($_SESSION['usuario'])) {
    //     $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    // }

    if(isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['confirmar_senha'])){

        $senhaProtegida = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $nome = $obUsuario->nome = $_POST["nome"];
        $tipo = $obUsuario->tipo = "comum";
        $email = $obUsuario->email = $_POST["email"];
        $senha = $obUsuario->senha = $senhaProtegida;
        $confirmar_senha = $_POST["confirmar_senha"];
        
        if ($nome != '' && $email != '' && $_POST['senha'] != '' && $confirmar_senha != ''){

            $verificarUsuario = Usuario::getUsuarioEmail($email);

            if ($_POST["senha"] == $confirmar_senha && count($verificarUsuario) < 1){
                $obUsuario->cadastrar();
                $obMensagem->getMensagem("index.php", "success", "Usuário cadastrado com sucesso!");
            } else {
                $obMensagem->getMensagem("register.php", "error", "As senhas não batem. Por favor, tente novamente.");
            }
        } else {
            $obMensagem->getMensagem("register.php", "error", "Por favor preencha todos os campos!");
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/register.php';
    include __DIR__.'/includes/footer.php';
           