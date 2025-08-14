<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obUsuario = new Usuario;
    $Usuario_and_time = new Usuario_and_time;
    $obMensagem = new Mensagem;
    $obTime = new Time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $usuarios = Usuario::getUsuariosStatus('comum', 'atleta');
    $titulo = "Usuários comuns";
    $countAtleta = 1;

    $id = $_SESSION['usuario'];
    $times = Time::getTimesId($id);

    $getModalidades = [];
    foreach($times as $time){
        $getModalidades[$time->id] = Modalidade::getModalidade($time->id_modalidade);
    }

    $totalAtletas = Modalidade::getModalidade(1); 
    $atletasAtual = Usuario_and_time::getUsuarios(9);
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_atletas.php';
    include __DIR__.'/includes/footer.php';
?>