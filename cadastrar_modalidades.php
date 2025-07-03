<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    use \App\Entity\Modalidade;
    $obModalidade = new Modalidade;

    if(isset($_POST['nome'], $_POST['regras'], $_POST['atletas'])){

        $nome = $obModalidade->nome = $_POST["nome"];
        $regras = $obModalidade->regras = $_POST["regras"];
        $atletas = $obModalidade->numero_atletas = $_POST["atletas"];

        if ($nome != '' && $regras != '' && $atletas != ''){

            $verificarModalidade = Modalidade::getModalidadeNome($nome);
            
            if(count($verificarModalidade) < 1){
                $obModalidade->cadastrar();
                $obMensagem->getMensagem("modalidades.php", "success", "Modalidade cadastrado com sucesso!");
            } else {
                $obMensagem->getMensagem("cadastrar_modalidades.php", "error", "Essa modalidade já foi cadastrada. Por favor cadastre outra.");
            }
        } else {
             $obMensagem->getMensagem("cadastrar_modalidades.php", "error", "Por favor preencha todos os campos!");
        }
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/modalidades.php';
    include __DIR__.'/includes/footer.php';
?>