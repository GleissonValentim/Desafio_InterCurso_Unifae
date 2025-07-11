<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Time {
        
        public $id;
        public $nome;
        public $gestor;
        public $modalidade;

        public function cadastrar(){

            $obDatabase = new DataBase('Time');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                            'id_gestor' => $this->gestor,
                                            'id_modalidade' => $this->modalidade
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todos os times pelo id do gestor
        public static function getTimesId($id){
            return (new DataBase('Time'))->select("id_gestor = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar um time pelo id do gestor 
        public static function getTimeId($id){
            return (new DataBase('Time'))->select("id_gestor = '$id'", null, null, '*')->fetchObject(self::class);
        }

        // Metodo responsavel por retornar um time pelo id do time
        public static function getTime($id){
            return (new DataBase('Time'))->select("id = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os times pelo nome e modalidade
        public static function getTimeNome($nome, $modalidade){
            return (new DataBase('Time'))->select("nome = '$nome' and id_modalidade = '$modalidade'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por trocar o gestor
        public function trocarGestor($id, $novo){
            return (new Database('Time'))->update('id_gestor = '.$id, [
                                                'id_gestor' => $novo
            ]);
        }
    }
