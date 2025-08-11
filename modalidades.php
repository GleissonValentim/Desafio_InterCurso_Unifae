<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    use \App\Entity\Jogo;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;

    $saida = "";
    
    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $modalidades = Modalidade::getModalidades() ?? null;

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_modalidades.php';
    include __DIR__.'/includes/footer.php';
?>