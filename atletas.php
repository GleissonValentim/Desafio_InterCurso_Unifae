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

    if (is_object($time)) {
        $atletasTime = Usuario_and_time::getAtletasTime($time->id);

        $atletas = [];
        foreach($atletasTime as $atletaTime){
            $atletas[] = Usuario::getUsuariosId($atletaTime->id_atleta);
        }

        $flatAtletas = [];
        foreach ($atletas  as $subArray) {
            foreach ($subArray as $atletaObj) {
                $flatAtletas[] = $atletaObj;
            }
        }
    } 

    if(isset($_POST['remover'])){
        $id = $_POST['remover'];
        $excluir = Usuario_and_time::excluirAtleta($id);

        if($excluir){
            $obMensagem->getMensagem("atletas.php", "success", "Atleta removido com sucesso.");
        } else {
            $obMensagem->getMensagem("atletas.php", "error", "Erro ao remover o atleta.");
        }
    }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_atletas_time.php';
    include __DIR__.'/includes/footer.php';
?>