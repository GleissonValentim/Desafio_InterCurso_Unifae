<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    $obMensagem = new Mensagem;
    $obJogo = new Jogo;

    use \App\Entity\Modalidade;
    $obModalidade = new Modalidade;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $modalidades = Modalidade::getModalidades();

    if (isset($_POST['modalidade'])){
        $repetidos = [];

        $modalidadeNome = Modalidade::getModalidade($_POST['modalidade']);

        $jogos = Jogo::verificaModalidadeNome($modalidadeNome->id);
        $jogosVencedores = Jogo::getJogosVencedor($modalidadeNome->id);

        $id1 = null;
        $id2 = null;

        $contTimes = 0;
        $times = null;
        if($jogosVencedores){
            $times = Time::getVencedores($modalidadeNome->id);
            foreach($times as $time){
                $contTimes++;
            }
        } else {
            $times = Time::getModalidade($modalidadeNome->id);
            foreach($times as $time){
                $contTimes++;
            }
        }

        $contTimes = $contTimes / 2;

        $cont = 0;
        if($contTimes > 1){
            while($cont < $contTimes){
                $timesSorteados = array_rand($times, 2);

                $id1 = $times[$timesSorteados[0]]->id;
                $id2 = $times[$timesSorteados[1]]->id;

                $repetido = false;
                foreach($repetidos as $timeRepetido){
                    if($timeRepetido == $id1 || $timeRepetido == $id2){
                        echo $id2;
                        $repetido = true;
                        break;
                    } 
                }

                if($repetido == false){
                    $modalidade = $obJogo->modalidade = $modalidadeNome->id;
                    $time1 = $obJogo->time_1 = $id1;
                    $time2 = $obJogo->time_2 = $id2;

                    $cadastrar = $obJogo->cadastrar();

                    if($cadastrar){
                        $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
                    } else {
                        $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
                    }

                    $repetidos[] = $id1;
                    $repetidos[] = $id2;

                    $cont ++;
                }
            }
        } else {
            $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não é possivel sortear mais jogos.");
        }   
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/jogos.php';
    include __DIR__.'/includes/footer.php';
?>