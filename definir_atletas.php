<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\Usuario;
    use \App\Entity\Time;
    use \App\Entity\Usuario_and_time;
    use \App\Entity\Modalidade;
    $obUsuario = new Usuario;
    $Usuario_and_time = new Usuario_and_time;
    $obTime = new Time;

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "gestor") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }
    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    if(isset($_POST['edit'])){
        $id = $Usuario_and_time->atleta = $_POST['edit'];
        $idGestor = $_SESSION['usuario'];
        $idTime = Time::getTimeId($idGestor);

        if($idTime){
            $numeroAtletas = Usuario_and_time::getAtletas($idTime->id);

            $id_jogador = $Usuario_and_time->atleta = $_POST['edit'];
            $id_time = $Usuario_and_time->time = $idTime->id;
            $status = $Usuario_and_time->status = 0;

            $totalAtletas = Modalidade::getModalidade($idTime->id_modalidade); 
            $atletasAtual = Usuario_and_time::getUsuarios($idTime->id);
            
            if(count($atletasAtual) < $totalAtletas->numero_atletas){
                $verificar = Usuario_and_time::verificarTime($id_jogador, $id_time);
                if(!$verificar){
                    $novoMembro = $Usuario_and_time->cadastrar();

                    if($novoMembro){
                        $novoStatus = $Usuario_and_time->alterarStatus();

                        if($novoStatus){
                            $menssagem = ["menssagem" => "Solicitação enviada! O usuário precisa confirmar sua participação no time.", "erro" => false];
                        } else {
                            $menssagem = ["menssagem" => "Erro ao convidar o usuário!", "erro" => true];
                        }
                    } else {
                        $menssagem = ["menssagem" => "Erro ao convidar o usuário!", "erro" => true];
                    }
                } else {
                    $menssagem = ["menssagem" => "Esse usuário já é membro da sua equipe ou já foi convidado!", "erro" => true];
                }
            } else {
                $menssagem = ["menssagem" => "A modalidade $totalAtletas->nome possui um limite máximo de $totalAtletas->numero_atletas atletas.", "erro" => true];
            }
        } else {
            $menssagem = ["menssagem" => "Você ainda não tem um time!", "erro" => true];
        }
    }

    header('Content-Type: aplication/json');
    echo json_encode($menssagem);
?>