<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Usuario_and_time {
        
        public $id;
        public $atleta;
        public $time;
        public $status;

        public function cadastrar(){

            $obDatabase = new DataBase('Usuario_and_time');
            $this->id = $obDatabase->insert([
                                            'id_atleta' => $this->atleta,
                                            'id_time' => $this->time,
                                            'status' => $this->status,
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todos os quantiadade de atletas pelo id
        public static function getAtletas($id){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar os time com base no status
        public static function getTimes($id, $status){
            return (new DataBase('Usuario_and_time'))->select("id_atleta = '$id' and status = '$status'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar o usuario com no status
        public static function getUsuarioStatus($time, $status){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$time' and status = '$status'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os atletas de cada time
        public static function getAtletasTime($id){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os atletas de cada time de acordo com o status
        public static function getAtletasStatus($id, $status){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id' and status = '$status'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os atletas de cada time de acordo com o status e a modalidade
        public static function getAtletasStatusModalidade($id, $status, $modalidade){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id' and status = '$status' and '$modalidade' in (select id_modalidade from time where id = '$id')", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os atletas de cada time
        public static function verificarTime($atleta, $time){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$time' and id_atleta = $atleta", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar os usuarios com base no status
        public static function getUsuariosStatus($id, $status){
            return (new DataBase('Usuario_and_time'))->select("id_atleta = '$id' and status = $status", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar os usuarios com base no time
        public static function getUsuarios($id){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel alterar o status do usuario
        public function alterarStatus(){
            return (new Database('Usuario_and_time'))->update('id_time = '.$this->time.' and id_atleta = '.$this->atleta.'', [
                                                'status' => $this->status
            ]);
        }

        // Metodo responsavel por excluir um usuario
        public static function excluirAtleta($id, $time){
            return (new DataBase('Usuario_and_time'))->delete("id_atleta = '$id' and id_time = '$time'");
        }
    }
