<?php

    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    $obUsuario = new Usuario;

    if(isset($_POST['email'], $_POST['senha'])){

        $email = $obUsuario->email = $_POST["email"];
        $senha = $obUsuario->senha = $_POST["senha"];
        
        if ($email != '' && $senha != ''){

            $verificarUsuario = Usuario::getUsuarioSenha($email);

            if ($verificarUsuario != '' && password_verify($senha, $verificarUsuario->senha)){
                header('location: index.php?status=success');
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
           