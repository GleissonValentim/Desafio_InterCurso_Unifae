<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;
    $obTime = new Time;

    $gestores = Usuario::getGestores();

    if(isset($_GET['id'], $_POST['gestor'])){
        $id = $_GET['id'];

        if(!empty($_POST["gestor"])){
            $usuario = Usuario::getUsuarioId($id);

            // gestor novo
            $gestorNovo = $obTime->gestor = $_POST["gestor"];
            $trocarTime = $obTime->trocarGestor($id, $gestorNovo);

            if($trocarTime){
                $idUsuario = $obUsuario->id = $id;
                $tipo = $obUsuario->tipo = "comum";
                $remover = $obUsuario->deleteGestor();
                if($remover){
                    $obMensagem->getMensagem("gestores.php", "success", "Gestor removido com sucesso!");
                } else {
                    $obMensagem->getMensagem("redefinir_gestor.php", "error", "Erro ao remover o gestor!");
                }
            } else {
                $obMensagem->getMensagem("redefinir_gestor.php", "error", "Erro ao remover o gestor!");
            }
        } else {
            $obMensagem->getMensagem("redefinir_gestor.php", "error", "Por favor, preencha todos os campos!", "&id=$id");
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/redefinir_gestor.php';
    include __DIR__.'/includes/footer.php';
?>