<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Usuario_and_time;

    $obMensagem = new Mensagem;
    $obTime = new time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    if(isset($_POST['del'])){
        $id = $_POST['del'];
        $getTime = Time::getIdTime($id);
        $timeJogando = Time::getTimesJogos($id, $getTime->id_modalidade, 'Não começou', 'Em andamento');

        if($timeJogando){
            $menssagem = ["menssagem" => "O time está participando de um jogo que ésta em andamento!", "erro" => true];
        } else {
            $deletar = Time::deleteTime($id);
        
            if($deletar){
                $menssagem = ["menssagem" => "Time excluido com sucesso!", "erro" => false];
            }
        }
    } elseif(isset($_POST['sair'])){
        $id = $_POST['sair'];
        $time = Time::getIdTime($id);
        $jogos = Time::getTimesJogos($id, $time->id_modalidade, 'Em andamento', 'Não começou');

        if($jogos){
            $menssagem = ["menssagem" => "Você não pode sair do time enquanto há jogos em andamento!", "erro" => true];
        } else {
            $sair = Usuario_and_time::excluirAtleta($_SESSION['usuario'], $id);

            if($sair){
                $menssagem = ["menssagem" => "Voçe saiu do time com sucesso!", "erro" => false];
            } else {
                $menssagem = ["menssagem" => "Erro ao sair do time!", "erro" => true];
            }
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>
