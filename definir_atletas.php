<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Modalidade;
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

    $usuarios = Usuario::getUsuariosStatus();
    $titulo = "Usuarios comuns";

    if(isset($_POST['definir'])){
        $id = $Usuario_and_time->atleta = $_POST['definir'];
        $idGestor = $_SESSION['usuario'];
        $idTime = Time::getTimeId($idGestor);

        if($idTime){
            $numeroAtletas = Usuario_and_time::getAtletas($idTime->id);

            $id_jogador = $Usuario_and_time->atleta = $_POST['definir'];
            $id_time = $Usuario_and_time->time = $idTime->id;
            $status = $Usuario_and_time->status = 0;

            $totalAtletas = Modalidade::getModalidade($idTime->id); 
            $atletasAtual = Usuario_and_time::getAtletasTime($idTime->id);
            
            if(count($atletasAtual) <= $totalAtletas){
                $novoMembro = $Usuario_and_time->cadastrar();

                if($novoMembro){
                    $novoStatus = $Usuario_and_time->alterarStatus();

                    if($novoStatus){
                        $obMensagem->getMensagem("definir_atletas.php", "success", "Solicitação enviada! O usuário precisa confirmar sua participação no time.");
                    } else {
                        $obMensagem->getMensagem("definir_atletas.php", "error", "Erro ao convidar o usuário!");
                    }
                } else {
                    $obMensagem->getMensagem("definir_atletas.php", "error", "Erro ao convidar o usuário!");
                }
            } else {
                $obMensagem->getMensagem("definir_atletas.php", "error", "A modalidade $totalAtletas->nome possui um limite máximo de $totalAtletas->numero_atletas atletas.");
            }
        } else {
            $obMensagem->getMensagem("definir_atletas.php", "error", "Você ainda não tem um time!");
        }
    }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_atletas.php';
    include __DIR__.'/includes/footer.php';
?>