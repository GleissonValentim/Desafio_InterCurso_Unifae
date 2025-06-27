<?php

    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    $obUsuario = new Usuario;

    if(isset($_POST['email'], $_POST['senha'])){

        $email = $obUsuario->email = $_POST["email"];
        $senha = $obUsuario->senha = $_POST["senha"];
        
        if ($email != '' && $senha != ''){

            $verificarUsuario = Usuario::getUsuario($email);
            $verificarSenha = password_verify($senha, $verificarUsuario);

            if ($verificarUsuario != '' && $verificarSenha){
                header('location: login.php?status=successes');
            } else {
                header('location: login.php?status=error');
            }
        } else {
            header('location: login.php?status=error');
        }
        exit;
    }

    include __DIR__.'/vendor/autoload.php';

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/login.php';
    include __DIR__.'/includes/footer.php';
           