<?php

    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Time;
    use \App\Entity\Modalidade;

    $jogos = Jogo::getJogosFinal();

    $times1 = [];
    $times2 = [];
    $vencedor = [];
    foreach($jogos as $jogo){
        $times1[$jogo->id] = Time::getIdTime($jogo->time1);
        $times2[$jogo->id] = Time::getIdTime($jogo->time2);
        $vencedor[$jogo->id] = Time::getIdTime($jogo->vencedor);
    }

    $modalidades = [];
    foreach($jogos as $jogo ){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listagem.php';
    include __DIR__.'/includes/footer.php';
           
    
