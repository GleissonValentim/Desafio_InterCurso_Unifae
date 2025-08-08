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
    
    if(isset($_POST['del'])){
        $idTime = $_POST['del'];
        $excluir = Usuario_and_time::excluirAtleta($id, $idTime);

        if($excluir){
            $menssagem = ["menssagem" => "Convite recusado com sucesso.", "erro" => false];
        } else {
            $menssagem = ["menssagem" => "Erro ao recusar o convite.", "erro" => true];
        }
    }   

    if(isset($_POST['edit'])){
        $id_atleta = $Usuario_and_time->atleta = $id;
        $id_time = $Usuario_and_time->time = $_POST['edit'];
        $status = $Usuario_and_time->status = 1;
        $mudarStatus = $Usuario_and_time->alterarStatus();

        $id_usuario = $obUsuario->id = $id;
        $tipo = $obUsuario->tipo = "atleta";
        $mudarTipo = $obUsuario->getUsuarioTipo();

        if($mudarStatus){
            if($mudarTipo){
                $menssagem = ["menssagem" => "Convite aceito com sucesso.", "erro" => false];
            } else {
                $menssagem = ["menssagem" => "Erro ao aceitar o convite.", "erro" => true];
            } 
        } else {
            $menssagem = ["menssagem" => "Erro ao aceitar o convite.", "erro" => true];
        }
    }  

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>