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
                                            'senha' => $this->senha
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

        // Metodo responsavel por retornar os usuarios com base no status nulo e tipo comum
        public static function getUsuariosStatus($tipo1, $tipo2){
            return (new DataBase('usuario'))->select("tipo = '$tipo1' or tipo = '$tipo2'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

         // Metodo responsavel por retornar os usuarios com base no id    
        public static function getUsuariosId($id){
            return (new DataBase('usuario'))->select("id= '$id'", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        public static function getGestores(){
            return (new DataBase('usuario'))->select("tipo = 'gestor' and id not in (select id_gestor from time)", null, null, '*')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar todos os getores
        public static function getUsuarioGestor($id){
            return (new DataBase('usuario'))->select("id in (select id_gestor from time where id_gestor = '$id')", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por retornar um id pelo seu email
        public static function getUsuarioEmail($email){
            return (new DataBase('usuario'))->select("email = '$email'", null, null, 'id')->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        // Metodo responsavel por editar um usuario
        public function editarUsuario(){
            return (new Database('usuario'))->update('id = '.$this->id, [
                                                'nome' => $this->nome,
                                                'senha' => $this->senha
            ]);
        }

        // Metodo responsavel por excluir um usuario
        public function deleteGestor(){
            return (new Database('usuario'))->update('id = '.$this->id, [
                                                'tipo' => $this->tipo
            ]);
        }
    }