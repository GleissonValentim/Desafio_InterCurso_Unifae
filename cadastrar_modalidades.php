<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    $obModalidade = new Modalidade;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $menssagem = "Voçe não tem acesso a essa página";
        }
    } else {
        $menssagem = "Voçe não tem acesso a essa página"; $erro = true;
    }

    if(isset($_POST['nome'], $_POST['regras'], $_POST['atletas'])){

        $nome = $obModalidade->nome = $_POST["nome"];
        $regras = $obModalidade->regras = $_POST["regras"];
        $atletas = $obModalidade->numero_atletas = $_POST["atletas"];

        if ($nome != '' && $regras != '' && $atletas != ''){

            $verificarModalidade = Modalidade::getModalidadeNome($nome);
            
            if(count($verificarModalidade) < 1){
                $obModalidade->cadastrar();
                $menssagem = ["menssagem" => "Modalidade cadastrada com sucesso!", "erro" => false];
            } else {
                $menssagem = ["menssagem" => "Essa modalidade já foi cadastrada. Por favor cadastre outra.", "erro" => true];
            }
        } else {
             $menssagem = ["menssagem" => "Por favor preencha todos os campos!", "erro" => true];
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>