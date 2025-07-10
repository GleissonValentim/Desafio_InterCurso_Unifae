<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    $obModalidade = new Modalidade;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

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