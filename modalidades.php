<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    use \App\Entity\Jogo;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    
    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $modalidades = Modalidade::getModalidades() ?? null;

    $excluir = $_POST['excluir'] ?? null;
    $editar = $_POST['editar'] ?? null;

    $countModalidade = 1;

    if($excluir){
        $id = $_POST['excluir'];

        $verificaModalidade = Jogo::verificaModalidade($id);

        if(count($verificaModalidade) < 1){
            $deleteModalidade = Modalidade::deleteModalidade($id);
            $obMensagem->getMensagem("modalidades.php", "success", "modalidade excluida com sucesso!");
        } else {
            $obMensagem->getMensagem("modalidades.php", "error", "Não foi possível excluir esta modalidade, pois ela está vinculada a um ou mais jogos.", "&id=$id");
        }
    } 

    if($editar){
        header("Location: editar_modalidades.php?id=$editar");
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_modalidades.php';
    include __DIR__.'/includes/footer.php';
?>