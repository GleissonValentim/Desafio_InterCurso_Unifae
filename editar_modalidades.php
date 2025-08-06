<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obModalidade = new Modalidade;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $modalidade = Modalidade::getModalidade($id);
    }

    $editar = $_POST['editar'] ?? null;

    if($editar){
        $idEditar = $_POST['editar'];

        if(isset($_POST['nome'], $_POST['regras'], $_POST['atletas'])){
            $id = $obModalidade->id = $idEditar;
            $nome = $obModalidade->nome = $_POST["nome"];
            $regras = $obModalidade->regras = $_POST["regras"];
            $atletas = $obModalidade->numero_atletas = $_POST["atletas"];

            if ($nome != '' && $regras != '' && $atletas != ''){

                $verificarModalidades = Modalidade::getModalidadeNome($nome);

                if(empty($verificarModalidades)){
                    $obMensagem->getMensagem("modalidades.php", "error", "Erro ao editar a modalidade. Por favor, tente novamente.");
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
                        $obMensagem->getMensagem("modalidades.php", "success", "modalidade editada com sucesso!");
                    } else {
                        $obMensagem->getMensagem("editar_modalidades.php", "error", "Essa modalidade está vinculdada há jogos que estão em andamento", "&id=$id");
                    }
                } else {
                    $obMensagem->getMensagem("editar_modalidades.php", "error", "Essa modalidade já foi cadastrada. Por favor, tente novamente.", "&id=$id");
                }
            } else {
                $obMensagem->getMensagem("editar_modalidades.php", "error", "Por favor, preencha todos os campos!", "&id=$id");
            }
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/editar_modalidades.php';
    include __DIR__.'/includes/footer.php';
?>