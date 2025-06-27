<?php

    namespace app\Entity;

    use App\Db\DataBase;
    use PDO;

    class Usuario {
        
        public $id;
        public $nome;
        public $tipo;
        public $email;
        public $senha;

        public function cadastrar(){

            $obDatabase = new DataBase('usuario');
            $this->id = $obDatabase->insert([
                                            'nome' => $this->nome,
                                            'tipo' => $this->tipo,
                                            'email' => $this->email,
                                            'senha' => $this->senha,
                                        ]);
            return true;
        }

        // Metodo responsavel por buscar uma vaga pelo seu email
        public static function getUsuario($email){
            return (new DataBase('usuario'))->select('email = '.$email, null, null, 'senha')->fetchObject(self::class);
        }
    }