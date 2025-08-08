<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obModalidade = new Modalidade;

    
    $modalidades = Modalidade::getModalidades() ?? null;
    $countModalidade = 1;
    
    $excluir = $_POST['excluir'] ?? null;
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

    if($excluir){
        $id = $_POST['excluir'];

        $verificaModalidade = Jogo::verificaModalidade($id);

        if(count($verificaModalidade) < 1){
            $deleteModalidade = Modalidade::deleteModalidade($id);
            $obMensagem->getMensagem("modalidades.php", "success", "modalidade excluida com sucesso!");
        } else {
            $obMensagem->getMensagem("modalidades.php", "error", "Não foi possível excluir esta modalidade, pois ela está vinculada a um ou mais jogos.", "&id=$id");
        }
    } 

    header('Content-Type: aplication/json');
    echo json_encode($modalidades);

    // include __DIR__.'/includes/header.php';
    // include __DIR__.'/includes/editar_modalidades.php';
    // include __DIR__.'/includes/footer.php';
?>