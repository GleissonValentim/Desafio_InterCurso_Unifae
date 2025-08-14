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

    if(isset($_POST['edit'])){
        $id = $obUsuario->id = $_POST['edit'];
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

        if($obTime){  
            $menssagem = ["menssagem" => "Erro ao remover o gestor, pois ele está vinculado a um ou mais times!", "erro" => true];
        } else {
            $tipo = $obUsuario->tipo = "comum";
            $remover = $obUsuario->deleteGestor();
            if($remover){
                $menssagem = ["menssagem" => "Gestor removido com sucesso!", "erro" => false];
            } else {
                $menssagem = ["menssagem" => "Erro ao remover o gestor!", "erro" => true];
            }
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>