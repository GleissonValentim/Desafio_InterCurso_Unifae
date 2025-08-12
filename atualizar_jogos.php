<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Mensagem;
    use \App\Entity\Time;
    use \App\Entity\Modalidade;
    use \App\Entity\Usuario;
    $obMensagem = new Mensagem;
    $obJogo = new Jogo;

    $saida = '';

    if (isset($_SESSION['usuario'])) {
        $usuario = Usuario::getUsuarioId($_SESSION['usuario']);
        if ($usuario->tipo != "Organizador") {
            $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
        }

    } else {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    }

    if($_POST['edit']){
        $id = $_POST['edit'];
        $jogo = Jogo::getJogo($id);

        $time1= Time::getIdTime($jogo->time1);
        $time2 = Time::getIdTime($jogo->time2);  

        $verificarModalidade = Modalidade::getModalidade($jogo->id_modalidade);

        if(!empty($jogo->time1)){
            $option1 = '<option value="'. $jogo->time1 .'">'.$time1->nome.'</option>';
        } else {
            $option1 = null;
        }

        if(!empty($jogo->time2)){
            $option2 = '<option value="'. $jogo->time2 .'">'.$time2->nome.'</option>';
        } else {
            $option2 = null;
        }

        if($jogo->status == 'Não começou'){
            $status = '<option value="">Selecione</option>';
        } else {
            $status = '<option value="'. $jogo->status .'">'. $jogo->status .'</option>';
        }

        $saida .= '
             <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control" name="nome" value="'.$jogo->nome.'" placeholder="Digite o nome do jogo">
            </div>
            <div class="form-group">
                <label for="local">Local: </label>
                <input type="hidden" name="id" id="id" class="form-control" value="'.$jogo->id.'">
                <input type="text" class="form-control" name="local" value="'.$jogo->local.'" placeholder="Digite o local do jogo">
            </div>
            <div class="form-group">
                <label for="data">Data: </label>
                <input type="date" class="form-control" name="data" min="2025-07-01" value="'.$jogo->data.'">
            </div>
            <div class="form-group">
                <label for="horario">Horario: </label>
                <input type="time" class="form-control" name="horario" placeholder="Digite o horário do jogo" value="'.$jogo->horario.'">
            </div>
            <div class="form-group">
                <label for="vencedor">Vencedor: </label>
                <select class="form-control" name="vencedor">
                    <option value="">Selecione</option>
                    '.$option1.'
                    '.$option2.'
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status: </label>
                <select class="form-control" name="status">
                    '.$status.'
                    <option value="Em andamento">Em andamento</option>
                    <option value="concluido">Concluido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="modalidade">Modalidade: </label>
                <select class="form-control" name="modalidade">
                    <option value="'.$verificarModalidade->id.'">'.$verificarModalidade->nome.'</option>
                </select>
            </div> 
        ';
    }

    header('Content-Type: aplication/json');
    echo json_encode($saida);
?>