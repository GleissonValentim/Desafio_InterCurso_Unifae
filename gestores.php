<?php 
    require_once 'vendor/autoload.php';

    session_start();

    // use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    // $obMensagem = new Mensagem;
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
            $filtro = "Gestor";
        } else if($_POST['usuarios'] == 'comum'){
            $usuarios = Usuario::getUsuarios("comum");
            $titulo = "Usuarios comuns";
            $filtro = "Comum";
        } else {
            $usuarios = Usuario::getUsuarios("gestor");
            $titulo = "Gestores";
        }
    } else {
        $usuarios = Usuario::getUsuarios("gestor");
        $titulo = "Gestores";
        $filtro = "Gestor";
    }

    if(isset($_POST['id'])){
        $id = $obUsuario->id = $_POST['id'];
        $tipo = $obUsuario->tipo = "gestor";
        $definir = $obUsuario->getUsuarioTipo();

        if($definir){
            $menssagem = ["menssagem" => "Usuário definido como gestor com sucesso!", "erro" => false];
        } else {
            $menssagem = ["menssagem" => "Erro ao definir o usuário como gestor!", "erro" => true];
        }
    }

    if(isset($_POST['del'])){
        $id = $obUsuario->id = $_POST['del'];
        $obTime = Time::getTimeId($id);

        if(!$obTime){  
            $tipo = $obUsuario->tipo = "comum";
            $remover = $obUsuario->deleteGestor();
            if($remover){
                $menssagem = ["menssagem" => "Gestor removido com sucesso!", "erro" => false];
            } else {
                $menssagem = ["menssagem" => "Erro ao remover o gestor!", "erro" => true];
            }
        } else {
            // $obMensagem->getMensagem("redefinir_gestor.php", "warning", "", "&id=$id");
            $menssagem = ["menssagem" => "Para remover este gestor, desvincule-o primeiro do time.", "erro" => true];
        }
    }

    // header('Content-Type: aplication/json');
    // echo json_encode($menssagem);

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_usuarios.php';
    include __DIR__.'/includes/footer.php';
?>