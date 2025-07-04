<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Usuario_and_time {
        
        public $atleta;
        public $time;

        public function cadastrar(){

            $obDatabase = new DataBase('Usuario_and_time');
            $this->id = $obDatabase->insert([
                                            'id_atleta' => $this->atleta,
                                            'id_time' => $this->time,
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todos os quantiadade de atletas pelo id
        public static function getAtletas($id){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }
    }
