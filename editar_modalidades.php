<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\jogo;
    use \App\Entity\Modalidade;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obModalidade = new Modalidade;
    $saida = '';
    
    $excluir = $_POST['del'] ?? null;
    $editar = $_POST['edit'] ?? null;

    if($editar){
        $modalidade = Modalidade::getModalidade($editar);
        $saida .= '
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="" id="atualizar_modalidade">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalidade">Editar modalidade</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="hidden" name="id" id="id" class="form-control" value="'.$modalidade->id.'">
                            <input type="text" class="form-control" name="nome" value="'.$modalidade->nome.'">
                        </div>
                        <div class="form-group">
                            <label for="regras">Atletas: </label>
                            <input type="number" class="form-control" name="atletas" value="'.$modalidade->numero_atletas.'">
                        </div>
                        <div class="form-group">
                            <label for="regras">Regras: </label>
                            <textarea class="form-control" name="regras" rows="6">'.$modalidade->regras.'</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="enviar" id="btn-show-sweetalert" class="btn enviar mt-2 pr-4 pl-4 mr-2">Enviar</button>
                        <button type="button" class="btn cancelar mt-2 pr-4 pl-4" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
                </div>
            </div>
        ';
    } 

    if($excluir){
        $id = $_POST['del'];

        $verificaModalidade = Jogo::verificaModalidade($id);

        if(count($verificaModalidade) < 1){
            $deleteModalidade = Modalidade::deleteModalidade($id);
            $saida = ["menssagem" => "modalidade excluida com sucesso!", "erro" => false];
        } else {
            $saida = ["menssagem" => "Não foi possível excluir esta modalidade, pois ela está vinculada a um ou mais jogos.", "erro" => true];
        }
    } 

    header('Content-Type: aplication/json');
    echo json_encode($saida);
?>