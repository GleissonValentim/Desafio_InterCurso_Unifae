<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Modalidade {
        
        public $id;
        public $nome;
        public $regras;
        public $numero_atletas;

        public function cadastrar(){

            $obDatabase = new DataBase('Modalidade');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                            'regras' => $this->regras,
                                            'numero_atletas' => $this->numero_atletas
                                        ]);
            return true;
        }

        // Metodo responsavel por retornar todas as modalidades
        public static function getModalidades($nome){
            return (new DataBase('Modalidade'))->select("nome = '$nome'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar uma modalidade pelo seu nome
        public static function getModalidadeId($nome){
            return (new DataBase('Modalidade'))->select("nome = '$nome'", null, null, 'id')->fetchObject(self::class);
        }

        // Metodo responsavel por retornar uma modalidade
        public static function getModalidade($id){
            return (new DataBase('Modalidade'))->select("id = '$id'", null, null, '*')->fetchObject(self::class);
        }
    }