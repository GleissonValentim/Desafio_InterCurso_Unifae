<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\jogo;

    use \App\Entity\Modalidade;

    $jogos = Jogo::getJogos() ?? null;

    foreach($jogos as $jogo ){
        $verificarModalidade = Modalidade::getModalidade($jogo->id_modalidade);
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>