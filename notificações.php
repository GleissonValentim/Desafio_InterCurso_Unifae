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
    
    if(isset($_POST['recusar'])){
        $idTime = $_POST['recusar'];
        $excluir = Usuario_and_time::excluirAtleta($id, $idTime);

        if($excluir){
            $obMensagem->getMensagem("notificações.php", "success", "Convite recusado com sucesso.");
        } else {
            $obMensagem->getMensagem("notificações.php", "error", "Erro ao recusar o convite.");
        }
    }   

    if(isset($_POST['aceitar'])){
        $id_atleta = $Usuario_and_time->atleta = $id;
        $id_time = $Usuario_and_time->time = $_POST['aceitar'];
        $status = $Usuario_and_time->status = 1;
        $mudarStatus = $Usuario_and_time->alterarStatus();

        $id_usuario = $obUsuario->id = $id;
        $tipo = $obUsuario->tipo = "atleta";
        $mudarTipo = $obUsuario->getUsuarioTipo();

        if($mudarStatus){
            if($mudarTipo){
                $obMensagem->getMensagem("notificações.php", "success", "Convite aceito com sucesso.");
            } else {
                $obMensagem->getMensagem("notificações.php", "error", "Erro ao aceitar o convite.");
            } 
        } else {
            $obMensagem->getMensagem("notificações.php", "error", "Erro ao aceitar o convite.");
        }
    }  

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_notificações.php';
    include __DIR__.'/includes/footer.php';
?>