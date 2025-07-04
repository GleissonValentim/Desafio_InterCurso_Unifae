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

        // Metodo responsavel por retornar um usuario pelo seu email
        public static function getUsuario($email){
            return (new DataBase('usuario'))->select("email = '$email'", null, null, '*')->fetchObject(self::class);
        }

        public static function getUsuarioId($id){
            return (new DataBase('usuario'))->select("id = '$id'", null, null, '*')->fetchObject(self::class);
        }

        // Metodo responsavel por retornar uma senha pelo seu email
        public static function getUsuarioSenha($email){
            return (new DataBase('usuario'))->select("email = '$email'", null, null, 'senha')->fetchObject(self::class);
        }

        // Mudar o tipo do usuário 
        public function getUsuarioTipo(){
            return (new Database('usuario'))->update('id = '.$this->id, [
                                                'tipo' => $this->tipo
            ]);
        }

        // Metodo responsavel por retornar os usuarios com base no tipo      
        public static function getUsuarios($tipo){
            return (new DataBase('usuario'))->select("tipo= '$tipo'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar um id pelo seu email
        public static function getUsuarioEmail($email){
            return (new DataBase('usuario'))->select("email = '$email'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por excluir um usuario
        public function deleteGestor(){
            return (new Database('usuario'))->update('id = '.$this->id, [
                                                'tipo' => $this->tipo
            ]);
        }
    }