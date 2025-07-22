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
    $eu = null;

    // $timeImpar = Time::getTimeImpar(1, 'Classificatória');

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

        if($contTimes > 1){
            $contTimes = floor($contTimes / 2);

            for($i = 0; $i < $contTimes; $i++){
                $timesSorteados = array_rand($times, 2);

                $id1 = $times[$timesSorteados[0]]->id;
                $id2 = $times[$timesSorteados[1]]->id;

                $repetido = false;
                foreach($repetidos as $timeRepetido){
                    if($timeRepetido == $id1 || $timeRepetido == $id2){
                        $repetido = true;
                        $contTimes = $contTimes + 1;
                        break;
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

                $etapa = Etapa::getEtapaNome('Classificatória')->id;
                $timeImpar = Time::getTimeImpar($modalidadeNome->id, $etapa);

                if($i == 0 && $timeImpar){
                    $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Classificatória Extra')->id;
                } else if ($i == $rodadas - 1){
                    $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Final')->id;
                } else {
                    $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Semifinal')->id;
                }
                
                $cadastrar = $obJogo->cadastrar();

                if($cadastrar){
                    $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
                } else {
                    $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
                }
            } 
        }

        $etapa = Etapa::getEtapasEspecificas(2);
        
        for($i = 0; $i < count($etapa); $i++){
            $jogosAtual = null;
            $proximosJogos = null;
            if($i == 0){
                $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 2);
                $proximosJogos = Jogo::getEtapasEspecificas(1, 2);
            } elseif($i == 1) {
                $jogosAtual = Jogo::getEtapa($modalidadeNome->id, 3);
                $proximosJogos = Jogo::getEtapasEspecificas(1, 3);
            }

            $k = 0; 

            for ($j = 0; $j < count($jogosAtual); $j += 2) {
                // Jogo atual 1
                $obJogo->id = $jogosAtual[$j]->id;
                $obJogo->id_proximo_jogo = $proximosJogos[$k]->id;
                $obJogo->editarProximoJogo();

                // Jogo atual 2
                if($jogosAtual >= 2){
                    $obJogo->id = $jogosAtual[$j + 1]->id;
                    $obJogo->id_proximo_jogo = $proximosJogos[$k]->id;
                    $obJogo->editarProximoJogo();
                }

                $k++;
            }
        }
    }

    // $timeImpar = false;
        // if(count($times) % 2 == 1){
        //     $timeImpar = true;
        //     $contTimes = $contTimes + 1;
        // }

        // // if($timeImpar == true){
        // //     $timesSorteados = array_rand($times, 2);

        // //     $id1 = $times[$timesSorteados[0]]->id;
        // //     $id2 = $times[$timesSorteados[1]]->id;

        // //     // $repetido = false;
        // //     // foreach($repetidos as $timeRepetido){
        // //     //     if($timeRepetido == $id1 || $timeRepetido == $id2){
        // //     //         $repetido = true;
        // //     //         // $contTimes = $contTimes + 1;
        // //     //         break;
        // //     //     } 
        // //     // }

        // //     if($repetido == false){
        // //         $etapaJogo = 
        // //         $modalidade = $obJogo->modalidade = $modalidadeNome->id;
        // //         $time1 = $obJogo->time_1 = $id1;
        // //         $time2 = $obJogo->time_2 = $id2;
        // //         $status = $obJogo->status = "Não começou";

        // //         $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Classificatória Extra')->id;
                
        // //         $cadastrar = $obJogo->cadastrar();

        // //         if($cadastrar){
        // //             $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
        // //         } else {
        // //             $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
        // //         }

        // //         $repetidos[] = $id1;
        // //         $repetidos[] = $id2;

        // //         $timeImpar = false;
        // //     }
        // // }

        $contPartidas = $contTimes;
        // $contTimes = floor($contTimes / 2);

        // if($contTimes > 1){
        //     for($i = 0; $i < $contTimes; $i++){
        //         // $etapa = Etapa::getEtapaNome('Classificatória')->id;
        //         // $timeImpar = Time::getTimeImpar($modalidadeNome->id, $etapa);
             
        //         $timesSorteados = array_rand($times, 2);

        //         $id1 = $times[$timesSorteados[0]]->id;
        //         $id2 = $times[$timesSorteados[1]]->id;

        //         $repetido = false;
        //         foreach($repetidos as $timeRepetido){
        //             if($timeRepetido == $id1 || $timeRepetido == $id2){
        //                 $repetido = true;
        //                 $contTimes = $contTimes + 1;
        //                 break;
        //             } 
        //         }

        //         if($repetido == false){
        //             $etapaJogo = 
        //             $modalidade = $obJogo->modalidade = $modalidadeNome->id;
        //             $time1 = $obJogo->time_1 = $id1;
        //             $time2 = $obJogo->time_2 = $id2;
        //             $status = $obJogo->status = "Não começou";

        //             if($timeImpar == true){
        //                 $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Classificatória Extra')->id;
        //                 $timeImpar == false;
        //             } else {
        //                 $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Classificatória')->id;
        //             }
                    
        //             $cadastrar = $obJogo->cadastrar();

        //             if($cadastrar){
        //                 $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
        //             } else {
        //                 $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
        //             }

        //             $repetidos[] = $id1;
        //             $repetidos[] = $id2;
        //         }
        //     } 

        // } else {
        //     $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não é possivel sortear mais jogos.");
        // }   

        // $rodadas = ceil(log($contPartidas, 2));
        // if($rodadas > 1){
        //     for($i = 0; $i < $rodadas; $i++){
        //         $status = $obJogo->status = "Não começou";
        //         $time1 = $obJogo->time_1 = null;
        //         $time2 = $obJogo->time_2 = null;

        //         if ($i == $rodadas - 1){
        //             $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Final')->id;
        //         } else {
        //             $etapa = $obJogo->id_etapa = Etapa::getEtapaNome('Semifinal')->id;
        //         }
                
        //         $cadastrar = $obJogo->cadastrar();

        //         if($cadastrar){
        //             $obMensagem->getMensagem("jogos.php", "success", "Jogos sorteados com sucesso!");
        //         } else {
        //             $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Não há mais jogos para sortear.");
        //         }
        //     } 
        // }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/jogos.php';
    include __DIR__.'/includes/footer.php';
?>