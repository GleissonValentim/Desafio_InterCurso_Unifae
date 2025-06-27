<?php

    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    $obUsuario = new Usuario;

    // testar se o formulario funciona
    // print_r($_POST);

    if(isset($_POST['nome'], $_POST['tipo'], $_POST['email'], $_POST['senha'], $_POST['confirmar_senha'])){

        $senhaProtegida = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $nome = $obUsuario->nome = $_POST["nome"];
        $tipo = $obUsuario->tipo = $_POST["tipo"];
        $email = $obUsuario->email = $_POST["email"];
        $senha = $obUsuario->senha = $senhaProtegida;
        $confirmar_senha = $_POST["confirmar_senha"];
        
        if ($nome != '' && $tipo != '' && $email != '' && $_POST['senha'] != '' && $confirmar_senha != ''){

            if ($_POST["senha"] == $confirmar_senha){
                $obUsuario->cadastrar();
                header('location: index.php?status=success');
            } else {
                header('location: register.php?status=error');
            }
        } else {
            header('location: register.php?status=error');
        }
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/register.php';
    include __DIR__.'/includes/footer.php';
           