<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Modalidade;
    $obModalidade = new Modalidade;

    if(isset($_POST['nome'], $_POST['regras'], $_POST['atletas'])){

        $nome = $obModalidade->nome = $_POST["nome"];
        $regras = $obModalidade->regras = $_POST["regras"];
        $atletas = $obModalidade->numero_atletas = $_POST["atletas"];

        if ($nome != '' && $regras != '' && $atletas != ''){

            $verificarModalidade = Modalidade::getModalidades($nome);
            
            if(count($verificarModalidade) < 1){
                $obModalidade->cadastrar();
                header('location: index.php?status=success');
            } else {
                header('location: modalidades.php?status=error');
            }
        } else {
            header('location: modalidades.php?status=error');
        }
        exit;
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/modalidades.php';
    include __DIR__.'/includes/footer.php';
?>