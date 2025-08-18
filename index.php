<?php

    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Time;
    use \App\Entity\Etapa;
    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    $obUsuario = new Usuario;
    $obEtapa = new Etapa;

    $jogos = Jogo::getJogosFinal();
    $countJogos = 1;
    $getModalidades = Modalidade::getModalidades();

    $modalidadesFiltadas;
    if(isset($_POST['modalidades'])){
        $modalidadesFiltadas = Modalidade::getModalidade($_POST['modalidades']);

        if($modalidadesFiltadas){
            $titulo = 'Jogos de '.$modalidadesFiltadas->nome;
        } else {
            $titulo = 'Jogos';
        }
    } else {
        $modalidadesFiltadas = Modalidade::getModalidade(1);
        if($modalidadesFiltadas){
            $titulo = 'Jogos de '.$modalidadesFiltadas->nome;
        } else {
            $titulo = 'Jogos';
        }
        
        if(empty($modalidadesFiltadas)){
            $modalidadesFiltadas = null;
            $titulo = 'Jogos';
        }
    }
    
    $times1 = [];
    $times2 = [];
    $vencedor = [];
    $etapas = [];
    $data = [];
    $vazio = false;
    $verificaJogos = Jogo::verificaProximoJogo();

    $etapa = Etapa::getEtapaNome('Quartas de final');

    foreach($jogos as $jogo){
        $times1[$jogo->id] = Time::getIdTime($jogo->time1);
        $times2[$jogo->id] = Time::getIdTime($jogo->time2);
        $vencedor[$jogo->id] = Time::getIdTime($jogo->vencedor);
        $etapas[$jogo->id] = Etapa::getEtapa($jogo->id_etapa);

        if($modalidadesFiltadas){
            if($jogo->id_modalidade == $modalidadesFiltadas->id){
                $vazio = false;
            } else {
                $vazio = true;
            }
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

    // Criar conta do Organizador
    $organizador = Usuario::getUsuarios('Organizador');
    if(empty($organizador)){
        $senhaProtegida = password_hash(123, PASSWORD_DEFAULT);
        $nome = $obUsuario->nome = "Gleisson";
        $tipo = $obUsuario->tipo = "Organizador";
        $email = $obUsuario->email = "organizador@gmail.com";
        $senha = $obUsuario->senha = $senhaProtegida;

        $obUsuario->cadastrar();
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listagem.php';
    include __DIR__.'/includes/footer.php';
           
    
