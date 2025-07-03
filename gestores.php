<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;

    $usuarios = Usuario::getUsuarios("gestor") ?? null;

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_usuarios.php';
    include __DIR__.'/includes/footer.php';
?>