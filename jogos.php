<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;

    $jogos = Jogo::getJogos() ?? null;

    $modalidades = [];
    foreach($jogos as $jogo ){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>