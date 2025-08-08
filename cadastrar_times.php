<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\time;
    use \App\Entity\Mensagem;
    use \App\Entity\Modalidade;
    use \App\Entity\Jogo;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obTime = new time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    if(isset($_POST['nome'], $_POST['modalidade'])){

        $id = $_SESSION['usuario'];
        $nome = $obTime->nome = $_POST["nome"];
        $gestor = $obTime->gestor = $id;
        $modalidade = $obTime->modalidade = $_POST['modalidade'];

        if ($nome != '' && $modalidade != ''){

            $verificarTime = Time::getTimeNome($nome, $modalidade);
            $verificarGestor = Time::getTimesId($id);
            $podeCadastrar = Jogo::getStatus($modalidade, 'Não começou', 'Em andamento');
            
            if (count($verificarGestor) < 1){
                if(count($verificarTime) < 1){
                    if(count($podeCadastrar) < 1){
                        $obTime->cadastrar();
                        $menssagem = ["menssagem" => "Time cadastrado com sucesso!", "erro" => false];
                    } else {
                        $menssagem = ["menssagem" => "Não é possível cadastrar um novo time enquanto houver jogos em andamento.", "erro" => true];
                    }
                } else {
                    $menssagem = ["menssagem" => "Esse Time já foi cadastrado. Por favor cadastre outro.", "erro" => true];
                }
            } else {
                $menssagem = ["menssagem" => "Voçe só pode cadastrar no máximo 1 time.", "erro" => true];
            }
        } else {
            $menssagem = ["menssagem" => "Por favor preencha todos os campos!", "erro" => true];
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>