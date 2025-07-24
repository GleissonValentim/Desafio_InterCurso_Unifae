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
    // $getModalidades = Modalidade::getModalidades();
    // $jogos = Jogo::getJogosModalidade($modalidade);

    $jogos = Jogo::getJogos();
    $countJogos = 1;

    $times1 = [];
    $times2 = [];
    $vencedor = [];
    $etapas = [];
    $verificaJogos = [];

    foreach($jogos as $jogo){
        $times1[$jogo->id] = Time::getIdTime($jogo->time1);
        $times2[$jogo->id] = Time::getIdTime($jogo->time2);
        $vencedor[$jogo->id] = Time::getIdTime($jogo->vencedor);
        $etapas[$jogo->id] = Etapa::getEtapa($jogo->id_etapa);
        $verificaJogos = Jogo::verificaProximoJogo($jogo->id);
    }

    // print_r($verificaJogos);

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

    // $jogosAtual = Jogo::getEtapa(1, 'Semifinal');
    // $proximosJogos = Jogo::verificaDiferencaEtapa(1, 'Classificatória', 'Semifinal', null);

    // $k = 0; // índice da próxima fase (próximo jogo)

    // for ($i = 0; $i < count($jogosAtual); $i += 2) {
    //     // Jogo atual 1
    //     $obJogo->id = $jogosAtual[$i]->id;
    //     $obJogo->modalidade = 1;
    //     $obJogo->id_proximo_jogo = $proximosJogos[$k]->id;
    //     $obJogo->editarJogo();

    //     // Jogo atual 2
    //     if($k >= 2){
    //         $obJogo->id = $jogosAtual[$i + 1]->id;
    //         $obJogo->modalidade = 1;
    //         $obJogo->id_proximo_jogo = $proximosJogos[$k]->id;
    //         $eu = $obJogo->editarJogo();
    //     }

    //     // Próximo jogo da próxima fase
    //     $k++;
    // }
    // // print_r($proximosJogos);

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>