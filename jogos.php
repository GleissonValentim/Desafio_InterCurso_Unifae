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
    } else {
        $modalidadesFiltadas = Modalidade::getModalidade(1);
        
        if(empty($modalidadesFiltadas)){
            $modalidadesFiltadas = null;
        }
    }

    $getModalidades = Modalidade::getModalidades();

    $times1 = [];
    $times2 = [];
    $vencedor = [];
    $etapas = [];
    $data = [];
    $vazio = false;
    $verificaJogos = Jogo::verificaProximoJogo();

    foreach($jogos as $jogo){
        $times1[$jogo->id] = Time::getIdTime($jogo->time1);
        $times2[$jogo->id] = Time::getIdTime($jogo->time2);
        $vencedor[$jogo->id] = Time::getIdTime($jogo->vencedor);
        $etapas[$jogo->id] = Etapa::getEtapa($jogo->id_etapa);

        if($jogo->id_modalidade == $modalidadesFiltadas->id){
            $vazio = false;
        } else {
            $vazio = true;
        }

        if(!empty($jogo->data)){
            $data[$jogo->id] = DateTime::createFromFormat('Y-m-d', $jogo->data)->format('d/m/Y');
        } else {
            $data[$jogo->id] = null;
        }
    }

    $count = [];
    $count2 = [];
    $i = -1;
    $j = 0;
    foreach($jogos as $jogo){
        foreach($verificaJogos as $verificaJogo){
            if($jogo->id == $verificaJogo->id_proximo_jogo){
                $i++;
                $j = $i + 1;

                $count[$jogo->id] = $i;
                $count2[$jogo->id] = $j;
            }
        }
    }

    $modalidades = [];
    foreach($jogos as $jogo ){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    $editar = $_POST['editar'] ?? null;

    if($editar){
        $obMensagem->getMensagem("editar_jogos.php", "warning", "Atenção: após definir o status do jogo como 'Concluído', não será mais possível editá-lo.", "&id=$editar");
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>