<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
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

                $nomeDuplicado = false;

                foreach ($verificarModalidades as $verificarModalidade) {
                    if ($verificarModalidade->id != $idEditar) {
                        $nomeDuplicado = true;
                        break;
                    }
                }

                if (!$nomeDuplicado) {
                    $obModalidade->editarModalidade();
                    header('location: modalidades.php?status=success');
                } else {
                    header('Location: editar_modalidades.php?id=' . $id . '&status=error');
                }
            } else {
                header('Location: editar_modalidades.php?id=' . $id . '&status=error');
            }
        exit;
        }
    } 

    if($excluir){
        $id = $_POST['excluir'];

        $deleteJogo = Jogo::deleteJogoModalidade($id);
        $deleteModalidade = Modalidade::deleteModalidade($id);

        if($deleteJogo && $deleteModalidade){
            header('location: modalidades.php?status=success');
        } else {
            header('Location: editar_modalidades.php?id=' . $id . '&status=error');
        }
    } 

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/editar_modalidades.php';
    include __DIR__.'/includes/footer.php';
?>