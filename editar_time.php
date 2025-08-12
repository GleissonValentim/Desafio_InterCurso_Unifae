<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Modalidade;
    use \App\Entity\Jogo;
    use \App\Entity\Usuario;
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
        $timeJogando = Time::getTimesJogos($id, 47, 'Não começou', 'Em andamento');

        if($timeJogando1){
            $menssagem = ["menssagem" => "O time está participando de um jogo que ésta em andamento!", "erro" => true];
        } else {
            $deletar = Time::deleteTime($id);
        
            if($deletar){
                $menssagem = ["menssagem" => "Time excluido com sucesso!", "erro" => false];
            }
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>