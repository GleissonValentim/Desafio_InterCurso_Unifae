<?php

    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Time;
    use \App\Entity\Etapa;
    use \App\Entity\Modalidade;

    $jogos = Jogo::getJogosFinal();
    $countJogos = 1;
    $getModalidades = Modalidade::getModalidades();

    $modalidadesFiltadas;
    if(isset($_POST['modalidades'])){
        $modalidadesFiltadas = Modalidade::getModalidade($_POST['modalidades']);
    } else {
        $modalidadesFiltadas = Modalidade::getModalidade(1);
        
        if(empty($modalidadesFiltadas)){
            $modalidadesFiltadas = null;
        }
    }

    $times1 = [];
    $times2 = [];
    $vencedor = [];
    $etapas = [];
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
    }

    $count = [];
    $i = 1;
    foreach($jogos as $jogo){
        foreach($verificaJogos as $verificaJogo){
            if($jogo->id == $verificaJogo->id_proximo_jogo){
                $count[$jogo->id] = $i;
                $i++;
            }
        }
    }

    $modalidades = [];
    foreach($jogos as $jogo ){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listagem.php';
    include __DIR__.'/includes/footer.php';
           
    
