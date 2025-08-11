<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    use \App\Entity\jogo;
    $obModalidade = new Modalidade;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $menssagem = "Voçe não tem acesso a essa página";
        }
    } else {
        $menssagem = "Voçe não tem acesso a essa página"; $erro = true;
    }

    if(empty($_POST["id"])){
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
    } else {
        $idEditar = $_POST['id'];

        if(isset($_POST['nome'], $_POST['regras'], $_POST['atletas'])){
            $id = $obModalidade->id = $idEditar;
            $nome = $obModalidade->nome = $_POST["nome"];
            $regras = $obModalidade->regras = $_POST["regras"];
            $atletas = $obModalidade->numero_atletas = $_POST["atletas"];

            if ($nome != '' && $regras != '' && $atletas != ''){

                $verificarModalidades = Modalidade::getModalidadeNome($nome);

                if(empty($verificarModalidades)){
                    $menssagem = ["menssagem" => "Erro ao editar a modalidade. Por favor, tente novamente.", "erro" => true];
                }

                $nomeDuplicado = false;

                foreach ($verificarModalidades as $verificarModalidade) {
                    if ($verificarModalidade->id != $idEditar) {
                        $nomeDuplicado = true;
                        break;
                    }
                }

                if (!$nomeDuplicado) {
                    $modalidadeAndamento = Jogo::verificaDiferencaEtapa($id, 'concluida', null, null);

                    if (empty($modalidadeAndamento)){
                        $obModalidade->editarModalidade();
                        $menssagem = ["menssagem" => "modalidade editada com sucesso!", "erro" => false];
                    } else {
                        $menssagem = ["menssagem" => "Essa modalidade está vinculdada há jogos que estão em andamento", "erro" => true];
                    }
                } else {
                    $menssagem = ["menssagem" => "Essa modalidade já foi cadastrada. Por favor, tente novamente.", "erro" => true];
                }
            } else {
                $menssagem = ["menssagem" => "Por favor, preencha todos os campos!", "erro" => true];
            }
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>