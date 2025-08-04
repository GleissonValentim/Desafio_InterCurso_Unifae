<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Modalidade;
    $obMensagem = new Mensagem;
    $obTime = new time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "comum" && $usuario->tipo != "atleta") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $id = $_SESSION['usuario'];

    $todosTimes = Usuario_and_time::getTimes($id, 1);
    $countTime = 1;

    $times = [];
    foreach($todosTimes as $time){
        $times = Time::getTime($time->id_time); 
    }

    $gestores = [];
    $cont = [];
    foreach($times as $time){
        $gestores = Usuario::getUsuariosId($time->id_gestor);

        $numeroAtletas = Usuario_and_time::getAtletasStatus($time->id, '1');
        $cont = count($numeroAtletas);
    }

    $modalidades = [];
    foreach($times as $time){
        $modalidades[$time->id] = Modalidade::getModalidade($time->id_modalidade);
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/timesParticipando.php';
    include __DIR__.'/includes/footer.php';
?>
