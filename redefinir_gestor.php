<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $usuario = Usuario::getUsuarioId($id);
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/redefinir_gestor.php';
    include __DIR__.'/includes/footer.php';
?>