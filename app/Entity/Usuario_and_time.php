<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Usuario_and_time {
        
        public $atleta;
        public $time;
        public $status;

        public function cadastrar(){

            $obDatabase = new DataBase('Usuario_and_time');
            $this->atleta = $obDatabase->insert([
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

        // Metodo responsavel por retornar o usuario com status
        public static function getUsuarioStatus($id){
            return (new DataBase('Usuario_and_time'))->select("id_atleta = '$id' and status is not null", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os atletas de cada time
        public static function getAtletasTime($id){
            return (new DataBase('Usuario_and_time'))->select("id_time = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar os usuarios com base no status
        public static function getUsuariosStatus($id, $status){
            return (new DataBase('Usuario_and_time'))->select("id_atleta = '$id' and status = $status", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel alterar o status do usuario
        public function alterarStatus(){
            return (new Database('Usuario_and_time'))->update('id_atleta = '.$this->atleta, [
                                                'status' => $this->status
            ]);
        }

        // Metodo responsavel por excluir um usuario
        public static function excluirAtleta($id){
            return (new DataBase('Usuario_and_time'))->delete("id_atleta = '$id'");
        }
    }
