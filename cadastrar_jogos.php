<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obJogo = new Jogo;

    use \App\Entity\Modalidade;
    $obModalidade = new Modalidade;

    $modalidades = Modalidade::getModalidades();

    if(isset($_POST['nome'], $_POST['local'], $_POST['modalidade'], $_POST['data'])){

        $nome = $obJogo->nome = $_POST["nome"];
        $local = $obJogo->local = $_POST["local"];
        // if (empty($_POST['modalidade'])){
        //     $modalidade = $obJogo->modalidade = $_POST['modalidade'];
        // }
        $modalidade = $obJogo->modalidade = $_POST['modalidade'];
        $data = $obJogo->data = $_POST["data"];

        if ($nome != '' && $local != '' && $_POST['modalidade'] != '' && $data != ''){

            $verificarJogo = Jogo::getJogoNome($nome);
            
            if(count($verificarJogo) < 1){
                $obJogo->cadastrar();
                $obMensagem->getMensagem("jogos.php", "success", "jogo cadastrado com sucesso!");
            } else {
                $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Esse jogo já foi cadastrado. Por favor cadastre outro.");
            }
        } else {
            $obMensagem->getMensagem("cadastrar_jogos.php", "error", "Por favor preencha todos os campos!");
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/jogos.php';
    include __DIR__.'/includes/footer.php';
?>