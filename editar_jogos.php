<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    $obJogo = new Jogo;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $jogo = Jogo::getJogo($id);
        $verificarModalidade = Modalidade::getModalidade($jogo->id_modalidade);
    }

    $editar = $_POST['editar'] ?? null;
    $excluir = $_POST['excluir'] ?? null;

    if($editar){
        $idEditar = $_POST['editar'];

        if(isset($_POST['nome'], $_POST['local'], $_POST['modalidade'], $_POST['data'])){

            $verificarModalidadeId = Modalidade::getModalidadeId($_POST['modalidade']);

            if(empty($verificarModalidadeId)){
                header('Location: editar_jogos.php?id=' . $idEditar . '&status=error');
            } else {
                $id = $obJogo->id = $idEditar;
                $nome = $obJogo->nome = $_POST["nome"];
                $local = $obJogo->local = $_POST["local"];
                $modalidade = $obJogo->modalidade = $verificarModalidadeId->id;
                $data = $obJogo->data = $_POST["data"];

                if ($nome != '' && $local != '' && $_POST['modalidade'] != '' && $data != ''){

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
                        header('location: jogos.php?status=success');
                    } else {
                        header('Location: editar_jogos.php?id=' . $id . '&status=error');
                    }
                } else {
                    header('Location: editar_jogos.php?id=' . $id . '&status=error');
                }
            }
        }
    } 

    if($excluir){
        $id = $_POST['excluir'];

        $deleteJogo = Jogo::deleteJogo($id);

        if($deleteJogo){
            header('location: jogos.php?status=success');
        } else {
            header('Location: editar_jogos.php?id=' . $id . '&status=error');
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/editar_jogos.php';
    include __DIR__.'/includes/footer.php';
?>