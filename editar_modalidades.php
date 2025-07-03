<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obModalidade = new Modalidade;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $modalidade = Modalidade::getModalidade($id);
    }

    $editar = $_POST['editar'] ?? null;
    $excluir = $_POST['excluir'] ?? null;

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
                    $obModalidade->editarModalidade();
                    $obMensagem->getMensagem("modalidades.php", "success", "modalidade editada com sucesso!");
                } else {
                    $obMensagem->getMensagem("editar_modalidades.php?id=" . $id, "error", "Essa modalidade já foi cadastrada. Por favor, tente novamente.");
                }
            } else {
                $obMensagem->getMensagem("editar_modalidades.php?id=" . $id, "error", "Por favor, preencha todos os campos!");
            }
        }
    } 

    if($excluir){
        $id = $_POST['excluir'];

        $deleteJogo = Jogo::deleteJogoModalidade($id);
        $deleteModalidade = Modalidade::deleteModalidade($id);

        if($deleteJogo && $deleteModalidade){
            $obMensagem->getMensagem("modalidades.php", "success", "modalidade excluida com sucesso!");
        } else {
            $obMensagem->getMensagem("editar_modalidades.php?id=".$id, "error", "Falha ao excluir a modalidade. Por favor, tente novamente.");
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/editar_modalidades.php';
    include __DIR__.'/includes/footer.php';
?>