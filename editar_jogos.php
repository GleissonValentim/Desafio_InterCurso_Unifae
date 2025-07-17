<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Time;
    use \App\Entity\Mensagem;
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

    $id = $_GET['id'];
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $jogo = Jogo::getJogo($id);
        $time1= Time::getIdTime($jogo->time1);
        $time2 = Time::getIdTime($jogo->time2);

        if($jogo->status == 'concluido'){
            $obMensagem->getMensagem("jogos.php", "error", "Voçe não tem acesso a essa página");
        }   

        $verificarModalidade = Modalidade::getModalidade($jogo->id_modalidade);
    } else {
        $obMensagem->getMensagem("jogos.php", "error", "Voçe não tem acesso a essa página");
    }

    $editar = $_POST['editar'] ?? null;

    $modalidades = Modalidade::getModalidades();

    

    // Sorteio
                        // $timesVencedores = Jogo::getJogosVencedor(1);
                        // $classificacao = Jogo::verificaModalidadeEtapa(1, 'Classificatória');
                        // $semifinal = Jogo::verificaModalidadeEtapa(1, 'Semifinal');
                        // $final = Jogo::verificaModalidadeEtapa(1, 'Final');
                        // $extra = Jogo::verificaModalidadeEtapa(1, 'Classificatória Extra');

                        // $vencedor = $obJogo->vencedor = 1;
                        // $novaClassificacao = count($classificacao);

                        // $etapafinal = false;
                        // $etapaSemifinal = false;
                        // $timesImpar = false;

                        // $classificacao = count($classificacao);

                        // $etapa= Jogo::getEtapa(1, 'Classificatória');
                        // $contEtapa = count($etapa) - 1;
                        // if($etapa[$contEtapa]->vencedor != null){
                        //     $novaClassificacao += 1;
                        // }

                        // $soma = $novaClassificacao + count($semifinal);

                        // if(count($extra) == 1 && count($timesVencedores) == $classificacao){
                        //     $timesImpar = true;
                            
                        // } else if(count($timesVencedores) == $novaClassificacao){
                        //     $etapaSemifinal = true;
                            
                        // } else if(count($timesVencedores) == $soma){
                        //     $etapafinal = true;
                        // }

                        // if($etapaSemifinal == true || $etapafinal == true || $timesImpar == true){
                        //     $contTimes = 0;
                        //     $times = null;

                        //     $repetidos = [];
                        //     if($etapaSemifinal || $timesImpar){
                        //         $times = Time::getVencedores(1);
                        //         $contTimes = count($times);
                                
                        //     } else if($etapafinal){
                        //         $times = Time::getVencedoresEtapa(1, 'Semifinal');
                        //         $contTimes = count($times);
                        //     }

                        //     $contTimes = $contTimes / 2;
                        //     $indice = 0;
                        //     for($i = 0; $i < $contTimes; $i++){
                            
                        //         $id1 = null;
                        //         $id2 = null;
                        //         if($timesImpar){
                        //             $timeSorteado = array_rand($times);

                        //             $impar = Time::getTimeImpar(1, 'Classificatória');

                        //             $id1 = $impar[0]->id;
                        //             $id2 = $times[$timeSorteado]->id;
                        //         } else {
                        //             $timesSorteados = array_rand($times, 2);

                        //             $id1 = $times[$timesSorteados[0]]->id;
                        //             $id2 = $times[$timesSorteados[1]]->id;

                        //         }

                        //         $repetido = false;
                        //         foreach($repetidos as $timeRepetido){
                        //             if($timeRepetido == $id1 || $timeRepetido == $id2){
                        //                 $repetido = true;
                                        
                        //                 if(!$timesImpar){
                                            
                        //                 }
                        //                 break;
                        //             } 
                        //         }

                        //         if($repetido == false){
                        //             if($timesImpar){
                        //                 $obJogo->id = $extra[0]->id;
                        //             } else if($etapaSemifinal){
                        //                 $eu = $obJogo->id = $semifinal[$indice]->id;
                        //                 echo $eu;
                        //             } else {
                        //                 $obJogo->id = $final[$indice]->id;
                        //             }

                        //             $obJogo->modalidade = 1;
                        //             $time1 = $obJogo->time_1 = $id1;
                        //             $time2 = $obJogo->time_2 = $id2;

                        //             if($timesImpar){
                        //                 $obJogo->editarJogoTime('Classificatória Extra');
                                        
                        //             } else if($etapaSemifinal){
                        //                 $obJogo->editarJogoTime('Semifinal');
                                        
                        //             } else {
                        //                 $obJogo->editarJogoTime('Final');
                        //             }

                        //             $repetidos[] = $id1;
                        //             $repetidos[] = $id2;
                        //             $indice++;
                        //         }
                        //     }
                        // }

                        // echo $soma;
                        // echo count($timesVencedores);
    
                        
                        
    if($editar){
        $idEditar = $_POST['editar'];

        if(isset($_POST['nome'], $_POST['local'], $_POST['modalidade'], $_POST['data'], $_POST['status'], $_POST['horario'], $_POST['vencedor'])){

            $id = $obJogo->id = $idEditar;
            $nome = $obJogo->nome = $_POST["nome"];
            $local = $obJogo->local = $_POST["local"];
            $modalidade = $obJogo->modalidade = $_POST['modalidade'];
            $data = $obJogo->data = $_POST["data"];
            $status = $obJogo->status = $_POST["status"];
            $horario = $obJogo->horario = $_POST["horario"];
            $vencedor = $obJogo->vencedor = $_POST["vencedor"];

            if ($nome != '' && $local != '' && $_POST['modalidade'] && $data != '' && $horario != ''){

                $verificarJogos = Jogo::getJogoNome($nome);

                // $verificar = false;
                // if($vencedor != '' && $status != 'Concluido' || empty($vencedor) && $status == 'Concluido'){
                //     $verificar = true;
                // }

                $nomeDuplicado = false;

                foreach ($verificarJogos as $verificarJogo) {
                    if ($verificarJogo->id != $idEditar) {
                        $nomeDuplicado = true;
                        break;
                    }
                }
                
                if ($verificar == false){ 
                    if (!$nomeDuplicado) {
                        $obJogo->editarJogo();

                        $eu = null;

                        // Sorteio
                        $timesVencedores = Jogo::getJogosVencedor($modalidade);
                        $classificacao = Jogo::verificaModalidadeEtapa($modalidade, 'Classificatória');
                        $semifinal = Jogo::verificaModalidadeEtapa($modalidade, 'Semifinal');
                        $final = Jogo::verificaModalidadeEtapa($modalidade, 'Final');
                        $extra = Jogo::verificaModalidadeEtapa($modalidade, 'Classificatória Extra');

                        $etapafinal = false;
                        $etapaSemifinal = false;
                        $timesImpar = false;

                        $novaClassificacao = count($classificacao);

                        $etapa= Jogo::getEtapa($modalidade, 'Classificatória');
                        $contEtapa = count($etapa) - 1;
                        if($etapa[$contEtapa]->vencedor != null){
                            $novaClassificacao += 1;
                        }

                        $soma = $novaClassificacao + count($semifinal);

                        if(count($extra) == 1 && count($timesVencedores) == count($classificacao)){
                            $timesImpar = true;
                        } else if(count($timesVencedores) == $novaClassificacao){
                            $etapaSemifinal = true;
                        } else if(count($timesVencedores) == $soma){
                            $etapafinal = true;
                        }

                        if($etapaSemifinal == true || $etapafinal == true || $timesImpar == true){
                            $contTimes = 0;
                            $times = null;

                            $repetidos = [];
                            if($etapaSemifinal || $timesImpar){
                                $times = Time::getVencedores($modalidade);
                                $contTimes = count($times);
                            } else if($etapafinal){
                                $times = Time::getVencedoresEtapa($modalidade, 'Semifinal');
                                $contTimes = count($times);
                            }

                            $contTimes = $contTimes / 2;
                            $indice = 0;
                            for($i = 0; $i < $contTimes; $i++){
                            
                                $id1 = null;
                                $id2 = null;
                                if($timesImpar){
                                    $timeSorteado = array_rand($times);

                                    $impar = Time::getTimeImpar($modalidade, 'Classificatória');

                                    $id1 = $impar[0]->id;
                                    $id2 = $times[$timeSorteado]->id;
                                } else {
                                    $timesSorteados = array_rand($times, 2);

                                    $id1 = $times[$timesSorteados[0]]->id;
                                    $id2 = $times[$timesSorteados[1]]->id;
                                }

                                $repetido = false;
                                foreach($repetidos as $timeRepetido){
                                    if($timeRepetido == $id1 || $timeRepetido == $id2){
                                        $repetido = true;
                                        // if(!$timesImpar){
                                        //     $contTimes = $contTimes + 1;
                                        // }
                                        break;
                                    } 
                                }

                                if($repetido == false){
                                    if($timesImpar){
                                        $obJogo->id = $extra[0]->id;
                                    } else if($etapaSemifinal){
                                        $obJogo->id = $semifinal[$indice]->id;
                                    } else {
                                        $obJogo->id = $final[$indice]->id;
                                    }

                                    $obJogo->modalidade = $modalidade;
                                    $time1 = $obJogo->time_1 = $id1;
                                    $time2 = $obJogo->time_2 = $id2;

                                    if($timesImpar){
                                        $obJogo->editarJogoTime('Classificatória Extra');
                                    } else if($etapaSemifinal){
                                        $obJogo->editarJogoTime('Semifinal');
                                    } else {
                                        $obJogo->editarJogoTime('Final');
                                    }

                                    $repetidos[] = $id1;
                                    $repetidos[] = $id2;
                                    $indice++;
                                }
                            }
                        }

                        $obMensagem->getMensagem("jogos.php", "success", "jogo editado com sucesso!".$novaClassificacao);
                    } else {
                        $obMensagem->getMensagem("editar_jogos.php", "error", "Esse jogo já foi cadastrado. Por favor, tente novamente.", "&id=$id");
                    }
                } else {
                    $obMensagem->getMensagem("editar_jogos.php", "error", "Ao definir um vencedor o status deve ser marcado como concluido.", "&id=$id");
                }
            } else {
                $obMensagem->getMensagem("editar_jogos.php", "error", "Por favor, preencha todos os campos!", "&id=$id");
            }
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/editar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>