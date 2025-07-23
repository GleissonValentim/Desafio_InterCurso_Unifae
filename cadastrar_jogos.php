<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Etapa;
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

    // $jogosAtual = Jogo::getEtapa(1, 1);
    // $proximosJogos = Jogo::getEtapasEspecificas(1, 1);

    
    // if($proximosJogos[1]->time1 == null || $proximosJogos[1]->time2 == null){
    //     $obJogo->id = $jogosAtual[0]->id;
    //     $obJogo->id_proximo_jogo = $proximosJogos[1]->id;
    //     $obJogo->editarProximoJogo();

    //     // Jogo atual 2
    //     if($jogosAtual >= 2){
    //         $obJogo->id = $jogosAtual[0 + 1]->id;
    //         $obJogo->id_proximo_jogo = $proximosJogos[1]->id;
    //         $obJogo->editarProximoJogo();
    //     }    
    // }

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

        $contPartidas = $contTimes;
        $timeExtra = 0;
        $removidos = null;
        $extra = 0;

        $timeImpar = false;
        if(count($times) != 8 && count($times) != 16 && count($times) != 4){
            $elevado = 1;
            while($elevado * 2 <= count($times)){
                $elevado *= 2;
            }

            $extra = count($times) - $elevado;
            
            $timesRemovidos = $times;
            $removidos = array_splice($timesRemovidos, 0, $extra * 2);
            $timeImpar = true;
        }

        if($timeImpar == true){
            $k = 0;
            while($k != $extra){
                
                $modalidade = $obJogo->modalidade = $modalidadeNome->id;
                $time1 = $obJogo->time_1 = $removidos[$k * 2]->id;
                $time2 = $obJogo->time_2 = $removidos[$k * 2 + 1]->id;
                $status = $obJogo->status = "Não começou";

                $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Classificatória Extra')->id;
                
                $cadastrar = $obJogo->cadastrar();

                if($cadastrar){
                    $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
                } else {
                    $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
                }

                $k++;
            }
        }

        $contPartidas = $contTimes;
        $contTimes = floor($contTimes / 2);
        $j = 0;

        if($contTimes %2 == 1){
            $contTimes -= 1;
        }

        if($contTimes > 1){
            for($i = 0; $i < $contTimes; $i++){
                // $etapa = Etapa::getEtapaNome('Classificatória')->id;
                // $timeImpar = Time::getTimeImpar($modalidadeNome->id, $etapa);

                $repetido = false;
        
                $contarTimes = count($times);
                $contRemovidos = count($removidos);
                $contarTimes -= $contRemovidos; 

                if($timeImpar){
                    if($j != $contarTimes - 1){
                        $timesSorteados = array_rand($times, 2);

                        $id1 = $times[$timesSorteados[0]]->id;
                        $id2 = $times[$timesSorteados[1]]->id;

                        foreach($repetidos as $timeRepetido){
                            if($timeRepetido == $id1 || $timeRepetido == $id2){
                                $repetido = true;
                                
                                break;
                            } 
                        }

                        foreach($removidos as $removido){
                            if($removido->id == $id1 || $removido->id == $id2){
                                $repetido = true;
                                
                                break;
                            } 
                        }

                        if($repetido == true){
                            $contTimes = $contTimes + 1;
                        }
                    } else {
                        $id1 = null;
                        $id2 = null;
                    }
                } else {
                    $timesSorteados = array_rand($times, 2);

                    $id1 = $times[$timesSorteados[0]]->id;
                    $id2 = $times[$timesSorteados[1]]->id;

                    foreach($repetidos as $timeRepetido){
                        if($timeRepetido == $id1 || $timeRepetido == $id2){
                            $repetido = true;
                            $contTimes = $contTimes + 1;
                            
                            break;
                        } 
                    }
                }

                if($repetido == false){
                    $etapaJogo = 
                    $modalidade = $obJogo->modalidade = $modalidadeNome->id;
                    $time1 = $obJogo->time_1 = $id1;
                    $time2 = $obJogo->time_2 = $id2;
                    $status = $obJogo->status = "Não começou";

                    $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Classificatória')->id;
                                    
                    $cadastrar = $obJogo->cadastrar();

                    if($cadastrar){
                        $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
                    } else {
                        $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
                    }

                    $repetidos[] = $id1;
                    $repetidos[] = $id2;
                    $j++;
                }
            } 

        } else {
            $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não é possivel sortear mais jogos.");
        }   

        $rodadas = ceil(log($contPartidas, 2));
        if($rodadas > 1){
            for($i = 0; $i < $rodadas; $i++){
                $status = $obJogo->status = "Não começou";
                $time1 = $obJogo->time_1 = null;
                $time2 = $obJogo->time_2 = null;

                if ($i == $rodadas - 1){
                    $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Final')->id;
                } else {
                    $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Semifinal')->id;
                }
                
                $cadastrar = $obJogo->cadastrar();

                if($cadastrar){
                    $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!".count($times));
                } else {
                    $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
                }
            } 
        }

        $etapa = null;
        if($timeImpar){
            $etapa = Etapa::getEtapasEspecificas(1);
        } else {
            $etapa = Etapa::getEtapasEspecificas(2);
        }
        
        for($i = 0; $i < count($etapa); $i++){
            $jogosAtual = null;
            $proximosJogos = null;
            if($timeImpar){
                if($i == 0){
                    $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 1);
                    $proximosJogos = Jogo::getEtapasEspecificas($modalidadeNome->id, 1);
                } elseif($i == 1) {
                    $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 2);
                    $proximosJogos = Jogo::getEtapasEspecificas($modalidadeNome->id, 2);
                } elseif($i == 2) {
                    $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 3);
                    $proximosJogos = Jogo::getEtapasEspecificas($modalidadeNome->id, 3);
                }
            } else {
                if($i == 0){
                    $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 2);
                    $proximosJogos = Jogo::getEtapasEspecificas($modalidadeNome->id, 2);
                } elseif($i == 1) {
                    $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 3);
                    $proximosJogos = Jogo::getEtapasEspecificas($modalidadeNome->id, 3);
                } 
            }

            $k = 0;

            for ($j = 0; $j < count($jogosAtual); $j += 2) {
   
                while (
                    $k < count($proximosJogos) &&
                    $proximosJogos[$k]->time1 !== null &&
                    $proximosJogos[$k]->time2 !== null
                ) {
                    $k++; 
                }

                if ($k >= count($proximosJogos)) {
                    break;
                }

                $obJogo->id = $jogosAtual[$j]->id;
                $obJogo->id_proximo_jogo = $proximosJogos[$k]->id;
                $obJogo->editarProximoJogo();

                if (isset($jogosAtual[$j + 1])) {
                    $obJogo->id = $jogosAtual[$j + 1]->id;
                    $obJogo->id_proximo_jogo = $proximosJogos[$k]->id;
                    $obJogo->editarProximoJogo();
                }

                $k++; 
            }


        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/jogos.php';
    include __DIR__.'/includes/footer.php';
?>