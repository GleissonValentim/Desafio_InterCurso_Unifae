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

        if($jogo->status == 'Concluido'){
            $menssagem = ["menssagem" => "Voçe não tem acesso a essa página", "erro" => true];
        }   

        $verificarModalidade = Modalidade::getModalidade($jogo->id_modalidade);
    } else {
        $menssagem = ["menssagem" => "Voçe não tem acesso a essa página", "erro" => true];
    }

    $editar = $_POST['editar'] ?? null;

    $modalidades = Modalidade::getModalidades();

    $segundoTime = $jogo->time2;
    $primeiroTime = $jogo->time1;

    // $perdedor = Time::getPerdedor(1, 'Classificatória Extra');

    // echo $perdedor->nome;
    // $proximoJogo = Jogo::getJogo(190);

    // echo $proximoJogo->time1;
                        
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

                // if ($segundoTime == null && isset($primeiroTime)){
                //     $obMensagem->getMensagem("editar_jogos.php", "error", "Os times ainda não foram definidos", "&id=$id");            
                // } 

                $verificar = false;
                // if(isset($vencedor) && $status != 'Concluido'){
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

                            $jogo = Jogo::getJogo($id);

                            if($jogo->id_proximo_jogo != null){
                                $idProximoJogo = $obJogo->id = $jogo->id_proximo_jogo;
                                $proximoJogo = Jogo::getJogo($idProximoJogo);

                                if($proximoJogo->time1 == null){
                                    $time1ProximoJogo = $obJogo->time_1 = $jogo->vencedor;
                                    $obJogo->editarTime1();
                                } else if($proximoJogo->time2 == null){
                                    $time2ProximoJogo = $obJogo->time_2 = $jogo->vencedor;
                                    $obJogo->editarTime2();
                                }
                                $menssagem = ["menssagem" => "jogo editado com sucesso!", "erro" => false];
                            }
                    } else {
                        $menssagem = ["menssagem" => "Esse jogo já foi cadastrado. Por favor, tente novamente.", "erro" => true];
                    }
                } else {
                    $menssagem = ["menssagem" => "Ao definir um vencedor o status deve ser marcado como concluido.", "erro" => true];
                }
            } else {
                $menssagem = ["menssagem" => "Por favor, preencha todos os campos!", "erro" => true];
            }
        }
    } 

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>