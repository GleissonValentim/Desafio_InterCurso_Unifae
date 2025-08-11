<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obModalidade = new Modalidade;
    $saida = '';

    $modalidades = Modalidade::getModalidades(null, 'id asc', null, null) ?? null;

    $countModalidade = 1;
    if(!empty($modalidades)){
        foreach($modalidades as $modalidade){
            $saida .= '
                <tr class="infos">
                    <td> '.$countModalidade++.' </td>
                    <td> '.$modalidade->nome.' </td>
                    <td> '.$modalidade->regras.' </td>
                    <td> '.$modalidade->numero_atletas.' </td>
                    <form action="modalidades.php" method="POST">
                        <td>
                            <button type="hidden" class="btn enviar deletar-formulario ml-2 editar_modalidadade" id="'. $modalidade->id .'" data-toggle="modal" data-target="#editarModalidade" data-whatever="@mdo" name="editar">Editar</button>
                            <button type="hidden" class="btn btn-danger deletar-formulario ml-2 remover_modalidadade" id="'. $modalidade->id .'" name="recusar">Remover</button>
                        </td>
                    </form>
                </tr>   
            ' ;
        }
    } else {
        $saida .= '<p class="text-center mt-5"><strong>Não há nenhuma modalidade cadastrada!</strong></p>';
    }

    header('Content-Type: aplication/json');
    echo json_encode($saida);
?>