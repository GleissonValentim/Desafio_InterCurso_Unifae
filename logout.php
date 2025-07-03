<?php
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;

    unset($_SESSION['usuario']);

    $obMensagem->getMensagem("index.php", "success", "Sessão encerrada com sucesso!");