<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Etapa {
        
        public $id;
        public $nome;

        public function cadastrar(){

            $obDatabase = new DataBase('Etapa');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todas as etapas
        public static function getEtapas(){
            return (new DataBase('Etapa'))->select(null, null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todas as etapas pelo id
        public static function getEtapasId($id){
            return (new DataBase('Etapa'))->select("id = '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar uma etapa
        public static function getEtapa($id){
            return (new DataBase('Etapa'))->select("id = '$id'", null, null, '*')->fetchObject(self::class);
        }

        // Metodo responsavel por retornar etapas especificas
        public static function getEtapasEspecificas($id){
            return (new DataBase('Etapa'))->select("id > $id", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar uma etapa pelo nome
        public static function getEtapaNome($nome){
            return (new DataBase('Etapa'))->select("nome = '$nome'", null, null, '*')->fetchObject(self::class);
        }
    }