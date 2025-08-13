<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Modalidade;
    $obMensagem = new Mensagem;
    $obTime = new time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "comum" && $usuario->tipo != "atleta") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $id = $_SESSION['usuario'];

    $todosTimes = Usuario_and_time::getTimes($id, 1);
    $countTime = 1;

    $times = [];
    foreach($todosTimes as $time){
        $times[] = Time::getTime($time->id_time); 
    }

    $gestores = [];
    $novo = [];
    $cont = [];
    $modalidades = [];
    foreach($times as $time){
        foreach($time as $novoTime){
            $gestores[$novoTime->id] = Usuario::getUsuariosId($novoTime->id_gestor);
            $numeroAtletas = Usuario_and_time::getAtletasStatus($novoTime->id, '1');
            $modalidades[$novoTime->id] = Modalidade::getModalidade($novoTime->id_modalidade);
            $cont = count($numeroAtletas);

            foreach($gestores as $gestor){
                foreach($gestor as $novoGestor){
                    if($novoGestor->id == $novoTime->id_gestor){
                        $novo[$novoTime->id] = $novoGestor->nome;
                    }
                }
            }
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/timesParticipando.php';
    include __DIR__.'/includes/footer.php';
?>
