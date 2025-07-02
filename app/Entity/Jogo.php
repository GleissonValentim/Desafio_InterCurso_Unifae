<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Jogo {
        
        public $id;
        public $local;
        public $modalidade;
        public $data;
        public $time_1;
        public $time_2;
        public $vencedor;

        public function cadastrar(){

            $obDatabase = new DataBase('Jogo');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                            'local' => $this->local,
                                            'id_modalidade' => $this->modalidade,
                                            'data' => $this->data
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar um Jogo pelo seu nome
        public static function getJogoNome($nome){
            return (new DataBase('Jogo'))->select("nome = '$nome'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os jogos
        public static function getJogos(){
            return (new DataBase('Jogo'))->select(null, null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar um jogo pelo id
        public static function getJogo($id){
            return (new DataBase('Jogo'))->select("id = '$id'", null, null, '*')->fetchObject(self::class);
        }

        // Metodo responsavel por excluir um jogo com base na modalidade
        public static function deleteJogoModalidade($id){
            return (new DataBase('Jogo'))->delete("id_modalidade = '$id'");
        } 

        // Metodo responsavel por excluir um jogo
        public static function deleteJogo($id){
            return (new DataBase('Jogo'))->delete("id = '$id'");
        }

        // Metodo responsavel por editar um jogo
        public function editarJogo(){
            return (new Database('Jogo'))->update('id = '.$this->id, [
                                                'nome' => $this->nome,
                                                'local' => $this->local,
                                                'id_modalidade' => $this->modalidade,
                                                'data' => $this->data
            ]);
        }
    }