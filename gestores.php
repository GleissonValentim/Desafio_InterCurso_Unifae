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

    $usuarios = [];
    if(isset($_POST['usuarios'])){
        if($_POST['usuarios'] == 'gestor'){
            $usuarios = Usuario::getUsuarios("gestor");
            $titulo = "Gestores";
        } else if($_POST['usuarios'] == 'comum'){
            $usuarios = Usuario::getUsuarios("comum");
            $titulo = "Usuarios comuns";
        } else {
            $usuarios = Usuario::getUsuarios("gestor");
            $titulo = "Gestores";
        }
    } else {
        $usuarios = Usuario::getUsuarios("gestor");
        $titulo = "Gestores";
    }

    if(isset($_POST['definir'])){
        $id = $obUsuario->id = $_POST['definir'];
        $tipo = $obUsuario->tipo = "gestor";
        $definir = $obUsuario->getUsuarioTipo();

        if($definir){
            $obMensagem->getMensagem("gestores.php", "success", "Usuário definido como gestor com sucesso!");
        } else {
            $obMensagem->getMensagem("gestores.php", "error", "Erro ao definir o usuário como gestor!");
        }
    }

    if(isset($_POST['remover'])){
        $id = $obUsuario->id = $_POST['remover'];
        $obTime = Time::getTimeId($id);

        if(!$obTime){  
            $tipo = $obUsuario->tipo = "comum";
            $remover = $obUsuario->deleteGestor();
            if($remover){
                $obMensagem->getMensagem("gestores.php", "success", "Gestor removido com sucesso!");
            } else {
                $obMensagem->getMensagem("gestores.php", "error", "Erro ao remover o gestor!");
            }
        } else {
            $obMensagem->getMensagem("redefinir_gestor.php", "warning", "Para remover este gestor, desvincule-o primeiro do time.", "&id=$id");
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_usuarios.php';
    include __DIR__.'/includes/footer.php';
?>