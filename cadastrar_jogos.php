<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    $obJogo = new Jogo;

    use \App\Entity\Modalidade;
    $obModalidade = new Modalidade;

    if(isset($_POST['nome'], $_POST['local'], $_POST['modalidade'], $_POST['data'])){

        $verificarModalidadeId = Modalidade::getModalidadeId($_POST['modalidade']);

        if(empty($verificarModalidadeId)){
            header('location: cadastrar_jogos.php?status=error');
            exit;
        }

        $nome = $obJogo->nome = $_POST["nome"];
        $local = $obJogo->local = $_POST["local"];
        $modalidade = $obJogo->modalidade = $verificarModalidadeId->id;
        $data = $obJogo->data = $_POST["data"];

        if ($nome != '' && $local != '' && $_POST['modalidade'] != '' && $data != ''){

            $verificarJogo = Jogo::getJogo($nome);
            
            if(count($verificarJogo) < 1){
                $obJogo->cadastrar();
                header('location: jogos.php?status=success');
            } else {
                header('location: cadastrar_jogos.php?status=error');
            }
        } else {
            header('location: cadastrar_jogos.php?status=error');
        }
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/jogos.php';
    include __DIR__.'/includes/footer.php';
?>