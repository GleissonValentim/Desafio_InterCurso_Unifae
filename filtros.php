<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obModalidade = new Modalidade;
    $saida = '';

    $getModalidades = Modalidade::getModalidades();

    // if(empty($getModalidades)){
    //     $selecione = '<option value="">Selecione</option>';
    // } else {
    //     $filtro = '<option value="">'. $filtro .'</option>';
    // }

    foreach($getModalidades as $getModalidade){
        $saida .= '<option class="filtrar" id="'. $getModalidade->id .'">'. $getModalidade->nome .'</option>';
    }

header('Content-Type: aplication/json');
echo json_encode($saida);