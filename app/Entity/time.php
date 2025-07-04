<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Time {
        
        public $id;
        public $nome;
        public $gestor;

        public function cadastrar(){

            $obDatabase = new DataBase('Time');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                            'id_gestor' => $this->gestor,
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todos os times pelo id
        public static function getTimesId($id){
            return (new DataBase('Time'))->select("id_gestor = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os times pelo nomes
        public static function getTimeNome($nome){
            return (new DataBase('Time'))->select("nome = '$nome'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }
    }
