<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Etapa {
        
        public $id;
        public $nome;

        public function cadastrar(){

            $obDatabase = new DataBase('Jogo');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todas as etapas
        public static function getEtapas(){
            return (new DataBase('Jogo'))->select(null, null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar uma etapa
        public static function getEtapa($id){
            return (new DataBase('Jogo'))->select("id = '$id", null, null, '*')->fetchObject(self::class);
        }

        // Metodo responsavel por retornar uma etapa pelo
        public static function getEtapaNome($nome){
            return (new DataBase('Jogo'))->select("nome = '$nome", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }
    }