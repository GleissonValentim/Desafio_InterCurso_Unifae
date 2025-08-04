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
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $id = $_SESSION['usuario'];
    $times = Time::getTimesId($id);

    $countTime = 1;

    $cont = [];
    foreach($times as $time){
        $numeroAtletas = Usuario_and_time::getAtletasStatus($time->id, '1');
        $cont = count($numeroAtletas);
    }

    $meuTime = Time::getTimeId($_SESSION['usuario']);

    if(!empty($meuTime)){
        $modalidade = Modalidade::getModalidade($meuTime ->id_modalidade) ?? null;
    } else {
        $meuTime = null;
    }

    // if(is_array($times)){
    //     $time = Time::getTimeId($_SESSION['usuario']);
    
    //     if ($time && is_object($time)) {
    //         $modalidade = Modalidade::getModalidade($time->id_modalidade) ?? null;

         

    //         $cont = 0;
    //         if(is_object($numeroAtletas) && $numeroAtletas){
    //             foreach($numeroAtletas as $numeroAtleta){
    //                 $cont ++;
    //             }
    //         }
    //     } else {
    //         $modalidade = null;
    //     }
    // }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_times.php';
    include __DIR__.'/includes/footer.php';
?>