<?php 
    require_once 'vendor/autoload.php';

    session_start();

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Time;
    use \App\Entity\Mensagem;
    use \App\Entity\Etapa;
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

    $modalidade = $_POST['modalidades'] ?? null;

    $jogos = [];
    if(!empty($_GET['id'])){
        $jogos = Jogo::getJogosModalidade($_GET['id']);
    } else {
        $jogos = Jogo::getPrimeiroJogo();
    }

    $countJogos = 1;

    $modalidadesFiltadas;
    if(isset($_POST['modalidades'])){
        $modalidadesFiltadas = Modalidade::getModalidade($_POST['modalidades']);
        $filtro = $modalidadesFiltadas->nome;
    } else {
        $modalidadesFiltadas = Modalidade::getPrimeiraModalidade();
        $filtro = $modalidadesFiltadas->nome;
        
        if(empty($modalidadesFiltadas)){
            $modalidadesFiltadas = null;
        }
    }

    // if(isset($_POST['id'])){
    //     $jogos = Jogo::getJogosModalidade($_POST['id']);
    // }

    $getModalidades = Modalidade::getModalidades();

    $times1 = [];
    $times2 = [];
    $vencedor = [];
    $etapas = [];
    $data = [];
    $vazio = false;
    $verificaJogos = Jogo::verificaProximoJogo();

    foreach($jogos as $jogo){
        $times1[$jogo->id] = Time::getIdTime($jogo->time1);
        $times2[$jogo->id] = Time::getIdTime($jogo->time2);
        $vencedor[$jogo->id] = Time::getIdTime($jogo->vencedor);
        $etapas[$jogo->id] = Etapa::getEtapa($jogo->id_etapa);

        if($jogo->id_modalidade == $modalidadesFiltadas->id){
            $vazio = false;
        } else {
            $vazio = true;
        }

        if(!empty($jogo->data)){
            $data[$jogo->id] = DateTime::createFromFormat('Y-m-d', $jogo->data)->format('d/m/Y');
        } else {
            $data[$jogo->id] = null;
        }
    }

    $count = [];
    $count2 = [];
    $i = -1;
    $j = 0;
    foreach($jogos as $jogo){
        foreach($verificaJogos as $verificaJogo){
            if($jogo->id == $verificaJogo->id_proximo_jogo){
                $i++;
                $j = $i + 1;

                $count[$jogo->id] = $i;
                $count2[$jogo->id] = $j;
            }
        }
    }

    $modalidades = [];
    foreach($jogos as $jogo ){
        $modalidades[$jogo->id] = Modalidade::getModalidade($jogo->id_modalidade);
    }

    if(!empty($jogos)){
        foreach($jogos as $jogo){
            if($jogo->time1 != null){
                $time1 = $times1[$jogo->id]->nome;
            } else {
                $time1 = '<p class="proximo_jogo">Vencedor do jogo '.$count[$jogo->id].'</p>';
            }

            if($jogo->time2 != null){
                $time2 = $times2[$jogo->id]->nome;
            } else {
                $time2 = '<p class="proximo_jogo">Vencedor do jogo '.$count2[$jogo->id].'</p>';
            }

            if(!empty($vencedor[$jogo->id])){
                $vencer = $vencedor[$jogo->id]->nome;
            } else {
                $vencer = 'Não tem';
            }   

            if($jogo->status != 'concluido'){
                $button = '<button type="button" class="btn enviar-formulario ml-2 editar_jogos" data-toggle="modal" data-target="#exampleEdit" data-whatever="@mdo" id="'.$jogo->id.'" name="editar">Editar Jogo</button>';
            } else {
                $button = null;
            }
            
            $saida .= '
                <tr class="infos">
                    <td>'.$countJogos++.'</td>
                    <td>'.$jogo->nome.'</td>
                    <td>'.$jogo->local.'</td>
                    <td>'.$modalidades[$jogo->id]->nome.'</td>
                    <td>'.$data[$jogo->id].'</td>
                    <td>'.$jogo->horario.'</td>
                    <td>'.$time1.'</td>
                    <td>'.$time2.'</td>
                    <td>'.$vencer.'</td>
                    <td>'.$etapas[$jogo->id]->Nome.'</td>
                    <td>'.$jogo->status.'</td>
                    <td>
                        '.$button.'
                    </td>
                </tr>
            ';
        }
    } else {
        $saida = ['menssagem' => '<p class="text-center mt-5"><strong>Não há nenhum jogo cadastrado!</strong></p>', 'erro' => true];
    }

    header('Content-Type: aplication/json');
    echo json_encode($saida);
?>