<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Jogo {
        
        public $id;
        public $nome;
        public $local;
        public $modalidade;
        public $data;
        public $time_1;
        public $time_2;
        public $vencedor;
        public $status;
        public $horario;
        public $etapa;
        public $id_proximo_jogo;

        public function cadastrar(){

            $obDatabase = new DataBase('Jogo');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                            'local' => $this->local,
                                            'id_modalidade' => $this->modalidade,
                                            'data' => $this->data,
                                            'time1' => $this->time_1,
                                            'time2' => $this->time_2,
                                            'status' => $this->status,
                                            'horario' => $this->horario,
                                            'vencedor' => $this->vencedor,
                                            'etapa' => $this->etapa,
                                            'id_proximo_jogo' => $this->id_proximo_jogo
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

        // Metodo responsavel por retornar todos os jogos pela modalidade
        public static function getJogosModalidade($modalidade){
            return (new DataBase('Jogo'))->select("id_modalidade = '$modalidade'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os jogos que nao sejam nulos
        public static function getJogosFinal(){
            return (new DataBase('Jogo'))->select("nome is not null", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os em que há vencedores
        public static function getJogosVencedor($id){
            return (new DataBase('Jogo'))->select("vencedor is not null and id_modalidade = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar um jogo pelo id
        public static function getJogo($id){
            return (new DataBase('Jogo'))->select("id = '$id'", null, null, '*')->fetchObject(self::class);
        }

        // Metodo responsavel por excluir um jogo com base na modalidade
        public static function verificaModalidade($id){
            return (new DataBase('Jogo'))->select("id_modalidade = '$id'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        } 

        // Metodo responsavel por retornar jogos pela modalidade e a etapa
        public static function verificaModalidadeEtapa($id, $etapa){
            return (new DataBase('Jogo'))->select("id_modalidade = '$id' and etapa = '$etapa'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        } 

        // Metodo responsavel por retornar jogos pela modalidade e a etapa
        public static function verificaDiferencaEtapa($id, $etapa1, $etapa2, $etapa3){
            return (new DataBase('Jogo'))->select("id_modalidade = '$id' and etapa != '$etapa1' and etapa != '$etapa2' and etapa != '$etapa3'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        } 

        // Metodo responsavel por retornar jogos pela etapa
        public static function getEtapa($id, $etapa){
            return (new DataBase('Jogo'))->select("id_modalidade = '$id' and etapa = '$etapa'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        } 

        // Metodo responsavel por retornar um jogo com base na modalidade
        public static function verificaModalidadeNome($id){
            return (new DataBase('Jogo'))->select("id_modalidade = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        } 

        // Metodo responsavel por excluir um jogo
        public static function deleteJogo($id){
            return (new DataBase('Jogo'))->delete("id = '$id'");
        }

        // Metodo responsavel por editar os times de um jogo
        public function editarJogoTime($etapa){
            return (new Database('Jogo'))->update("id = ".$this->id." and etapa = '{$etapa}'", [
                                                'time1' => $this->time_1,
                                                'time2' => $this->time_2,
            ]);
        }

        // Metodo responsavel por editar um jogo
        public function editarJogo(){
            return (new Database('Jogo'))->update('id = '.$this->id, [
                                                'nome' => $this->nome,
                                                'local' => $this->local,
                                                'id_modalidade' => $this->modalidade,
                                                'data' => $this->data,
                                                'status' => $this->status,
                                                'horario' => $this->horario,
                                                'vencedor' => $this->vencedor,
                                                'id_proximo_jogo' => $this->id_proximo_jogo
            ]);
        }
    }