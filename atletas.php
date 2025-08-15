<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Modalidade;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;
    $Usuario_and_time = new Usuario_and_time;
    $obTime = new Time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    $countAtleta = 1;
    $getModalidades = Modalidade::getModalidades();

    $modalidadesFiltadas;
    if(isset($_POST['modalidades'])){
        $modalidadesFiltadas = Modalidade::getModalidade($_POST['modalidades']);
        $time = Time::getIdModalidade($_SESSION['usuario'], $_POST['modalidades']);
        if($time){
            $atletasTime = Usuario_and_time::getAtletasStatusModalidade($time->id, 1, $_POST['modalidades']);
            $titulo = 'Atletas do time de '.$modalidadesFiltadas->nome;
        } else {
            $atletasTime = null;
            $titulo = 'Atletas do time';
        }
    } else {
        $modalidadesFiltadas = Modalidade::getPrimeiraModalidade();       
        if(empty($modalidadesFiltadas)){
            $modalidadesFiltadas = null;
            $atletasTime = null;
            $titulo = 'Atletas do time';
        } else {
            $time = Time::getIdModalidade($_SESSION['usuario'], $modalidadesFiltadas->id);
            $atletasTime = Usuario_and_time::getAtletasStatusModalidade($time->id, 1, $modalidadesFiltadas->id);
            $titulo = 'Atletas do time de '.$modalidadesFiltadas->nome;
        }
    }

    $atletas = [];
    if($atletasTime){
        foreach($atletasTime as $atletaTime){
            $atletas[] = Usuario::getUsuariosId($atletaTime->id_atleta);
        }

        $flatAtletas = [];
        foreach ($atletas  as $subArray) {
            foreach ($subArray as $atletaObj) {
                $flatAtletas[] = $atletaObj;
            }
        }
    }
    
    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_atletas_time.php';
    include __DIR__.'/includes/footer.php';
?>