<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obJogo = new Jogo;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $jogo = Jogo::getJogo($id);
        $verificarModalidade = Modalidade::getModalidade($jogo->id_modalidade);
    }

    $editar = $_POST['editar'] ?? null;
    $excluir = $_POST['excluir'] ?? null;

    $modalidades = Modalidade::getModalidadesNaoUsadas();

    if($editar){
        $idEditar = $_POST['editar'];

        if(isset($_POST['nome'], $_POST['local'], $_POST['modalidade'], $_POST['data'])){

            $id = $obJogo->id = $idEditar;
            $nome = $obJogo->nome = $_POST["nome"];
            $local = $obJogo->local = $_POST["local"];
            $modalidade = $obJogo->modalidade = $_POST['modalidade'];
            $data = $obJogo->data = $_POST["data"];

            if ($nome != '' && $local != '' && $_POST['modalidade'] && $data != ''){

                $verificarJogos = Jogo::getJogoNome($nome);

                $nomeDuplicado = false;

                foreach ($verificarJogos as $verificarJogo) {
                    if ($verificarJogo->id != $idEditar) {
                        $nomeDuplicado = true;
                        break;
                    }
                }

                if (!$nomeDuplicado) {
                    $obJogo->editarJogo();
                    $obMensagem->getMensagem("jogos.php", "success", "jogo editado com sucesso!");
                } else {
                    $obMensagem->getMensagem("editar_jogos.php", "error", "Esse jogo já foi cadastrado. Por favor, tente novamente.", "&id=$id");
                }
            } else {
                $obMensagem->getMensagem("editar_jogos.php", "error", "Por favor, preencha todos os campos!", "&id=$id");
            }
        }
    } 

    if($excluir){
        $id = $_POST['excluir'];

        $deleteJogo = Jogo::deleteJogo($id);

        if($deleteJogo){
            $obMensagem->getMensagem("jogos.php", "success", "jogo excluido com sucesso!");
        } else {
            $obMensagem->getMensagem("editar_jogos.php", "error", "Falha ao excluir o jogo. Por favor, tente novamente.", "&id=$id");
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/editar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>