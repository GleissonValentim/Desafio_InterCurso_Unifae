<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Usuario_and_time;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;
    $Usuario_and_time = new Usuario_and_time;
    $obTime = new Time;

    $time = Time::getTimeId($_SESSION['usuario']);
    $atletasTime = Usuario_and_time::getAtletasTime($time->id);

    $atletas = [];
    foreach($atletasTime as $atletaTime){
        $atletas = Usuario::getUsuariosId($atletaTime->id_atleta);
    }

    $titulo = "Atletas do time";
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_atletas_time.php';
    include __DIR__.'/includes/footer.php';
?>