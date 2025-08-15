<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;
    $obTime = new Time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $countUsuario = 1;

    $usuarios = [];
    if(isset($_POST['usuarios'])){
        if($_POST['usuarios'] == 'gestor'){
            $usuarios = Usuario::getUsuarios("gestor");
            $titulo = "Gestores";
    
        } else if($_POST['usuarios'] == 'comum'){
            $usuarios = Usuario::getUsuarios("comum");
            $titulo = "Usuários comuns";
   
        } else {
            $usuarios = Usuario::getUsuarios("gestor");
            $titulo = "Gestores";
        }
    } else {
        $usuarios = Usuario::getUsuarios("gestor");
        $titulo = "Gestores";
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_usuarios.php';
    include __DIR__.'/includes/footer.php';
?>