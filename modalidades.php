<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Modalidade;

    $modalidades = Modalidade::getModalidades() ?? null;

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/listar_modalidades.php';
    include __DIR__.'/includes/footer.php';
?>