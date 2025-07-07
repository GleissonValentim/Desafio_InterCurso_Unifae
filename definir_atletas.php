<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Usuario_and_time;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;
    $Usuario_and_time = new Usuario_and_time;
    $obTime = new Time;

    $usuarios = Usuario::getUsuarios("comum");
    $titulo = "Usuarios comuns";

    if(isset($_POST['definir'])){
        $id = $obUsuario->id = $_POST['definir'];
        $tipo = $obUsuario->tipo = "atleta";
        $definir = $obUsuario->getUsuarioTipo();
        $time = Time::getTimeId($_SESSION['usuario']);

        $id_jogador = $Usuario_and_time->atleta = $id;
        $id_time = $Usuario_and_time->time = $time->id;
        $novoMembro = $Usuario_and_time->cadastrar();

        if($definir){
            $obMensagem->getMensagem("definir_atletas.php", "success", "Usuário definido como atleta com sucesso!");
        } else {
            $obMensagem->getMensagem("definir_atletas.php", "error", "Erro ao definir o usuário como atleta!");
        }
    }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_atletas.php';
    include __DIR__.'/includes/footer.php';
?>