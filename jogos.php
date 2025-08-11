<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Time;
    use \App\Entity\Mensagem;
    use \App\Entity\Etapa;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obJogo = new Jogo;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $modalidade = $_POST['modalidades'] ?? null;

    $jogos = [];
    $jogos = Jogo::getJogos();
    $countJogos = 1;

    $modalidadesFiltadas;
    if(isset($_POST['modalidades'])){
        $modalidadesFiltadas = Modalidade::getModalidade($_POST['modalidades']);
        $filtro = $modalidadesFiltadas->nome;
    } else {
        $modalidadesFiltadas = Modalidade::getModalidade(1);
        $filtro = $modalidadesFiltadas->nome;
        
        if(empty($modalidadesFiltadas)){
            $modalidadesFiltadas = null;
        }
    }

    $getModalidades = Modalidade::getModalidades();

    $modalidades = [];
    foreach($jogos as $jogo){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    print_r($modalidades);

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>