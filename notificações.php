<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Time;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;
    $Usuario_and_time = new Usuario_and_time;

    if (!isset($_SESSION['usuario'])) {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    } 

    $id = $_SESSION['usuario'];
    $notificacoes = Usuario_and_time::getUsuariosStatus($id, 0);

    $times = [];
    foreach($notificacoes as $notificacao){
        $times[] = Time::getTime($notificacao->id_time);
    }

    $flatTimes = [];
    foreach ($times as $subArray) {
        foreach ($subArray as $timeObj) {
            $flatTimes[] = $timeObj;
        }
    }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_notificações.php';
    include __DIR__.'/includes/footer.php';
?>