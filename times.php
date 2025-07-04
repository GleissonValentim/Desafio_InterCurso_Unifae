<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Usuario_and_time;
    $obMensagem = new Mensagem;
    $obTime = new time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $id = $_SESSION['usuario'];
    $times = Time::getTimesId($id) ?? null;
    
    $numeroAtletas = Usuario_and_time::getAtletas($id) ?? 0;
    $cont = count($numeroAtletas);

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_times.php';
    include __DIR__.'/includes/footer.php';
?>