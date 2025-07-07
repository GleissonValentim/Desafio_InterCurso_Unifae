<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Modalidade;
    $obMensagem = new Mensagem;
    $obTime = new time;

    $modalidades = Modalidade::getModalidades();

    if(isset($_POST['nome'], $_POST['modalidade'])){

        $id = $_SESSION['usuario'];
        $nome = $obTime->nome = $_POST["nome"];
        $gestor = $obTime->gestor = $id;
        $modalidade = $obTime->modalidade = $_POST['modalidade'];

        if ($nome != '' && $modalidade != ''){

            $verificarTime = Time::getTimeNome($nome, $modalidade);
            $verificarGestor = Time::getTimesId($id);
            
            if (count($verificarGestor) < 1){
                if(count($verificarTime) < 1){
                    $obTime->cadastrar();
                    $obMensagem->getMensagem("times.php", "success", "Time cadastrado com sucesso!");
                } else {
                    $obMensagem->getMensagem("cadastrar_times.php", "error", "Esse Time já foi cadastrado. Por favor cadastre outro.");
                }
            } else {
                $obMensagem->getMensagem("cadastrar_times.php", "error", "Voçe só pode cadastrar no máximo 1 time.");
            }
        } else {
            $obMensagem->getMensagem("cadastrar_times.php", "error", "Por favor preencha todos os campos!");
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/times.php';
    include __DIR__.'/includes/footer.php';
?>