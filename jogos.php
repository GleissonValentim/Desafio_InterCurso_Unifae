<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $jogos = Jogo::getJogos() ?? null;

    $modalidades = [];
    foreach($jogos as $jogo ){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    $excluir = $_POST['excluir'] ?? null;
    $editar = $_POST['editar'] ?? null;

    if($excluir){
        $id = $_POST['excluir'];

        $deleteJogo = Jogo::deleteJogo($id);

        if($deleteJogo){
            $obMensagem->getMensagem("jogos.php", "success", "jogo excluido com sucesso!");
        } else {
            $obMensagem->getMensagem("jogos.php", "error", "Falha ao excluir o jogo. Por favor, tente novamente.", "&id=$id");
        }
    } 

    if($editar){
        $obMensagem->getMensagem("editar_jogos.php", "warning", "Atenção: após definir o status do jogo como 'Concluído', não será mais possível editá-lo.", "&id=$editar");
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>