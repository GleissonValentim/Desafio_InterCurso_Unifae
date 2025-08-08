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

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $time = Time::getTimeId($_SESSION['usuario']);
    
    if(isset($_POST['del'])){
        $id = $_POST['del'];
        $excluir = Usuario_and_time::excluirAtleta($id, $time->id);

        $idUsuario = $obUsuario->id = $id;
        $tipo = $obUsuario->tipo = 'comum';

        $editarTipo = $obUsuario->deleteGestor();

        if($excluir || $editarTipo){
            $menssagem = ["menssagem" => "Atleta removido com sucesso.", "erro" => false];
        } else {
            $menssagem = ["menssagem" => "Erro ao remover o atleta.", "erro" => true];
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>