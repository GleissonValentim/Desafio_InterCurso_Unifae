<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/definir_gestor.php';
    include __DIR__.'/includes/footer.php';
?>