<?php

    namespace App\Db;

    use \PDOException;
    use \PDO;

    class DataBase {

        const HOST = 'localhost';
        const NAME = 'intercurso';
        const USER = 'root';
        const PASS = '1234';

        //Nome da tabela a ser manipulada
        private $table;

        //Instancia a conexao com o banco de dados
        private $connection;

        //Instancia a conexao e define a tabela
        public function __construct($table = null){
            $this->table = $table;
            $this->setConnection();
        }

        // Metodo responsavel por fazer uma conexao com o banco de dados
        public function setConnection(){
            try{
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        // Metodo responsavel por executar querys dentro do banco de dados
        public function execute($query, $params = []){
            try{
                $statment = $this->connection->prepare($query);
                $statment->execute($params);
                return $statment;
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        // Metodo responsavel por inserir dados no banco
        public function insert($values){
            // Dados da query
            $fields = array_keys($values);
            $binds = array_pad([], count($fields), '?'); // Cria um array com a mesma quantidade de elementos que $fields, preenchido com o caractere '?'

            // Monta a query
            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')'; 

            // Executa o insert
            $this->execute($query, array_values($values));

            // Retorna o id inserido
            return $this->connection->lastInsertId();
        }

        // Metodo responsavel por executar uma consunta no banco (Sao nulos pois as vezes nao exite esses valores)
        public function select($where = null, $order = null, $limit = null, $fields = null){

            $where = strlen($where) ? 'WHERE ' . $where : '';
            $order = strlen($order) ? 'ORDER BY ' . $order : '';
            $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

            $query = 'SELECT ' . $fields . ' ' . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

            return $this->execute($query);
        }

        // Metodo responsavel por executar atualizacoes no banco de dados
        public function update($where, $values){
            //dados da query
            $fields = array_keys($values);

            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=?  WHERE '.$where;

            //executar a query
            $this->execute($query, array_values($values));

            //retorna sucesso
            return true;
        }

        // Metodo responsavel por excluir uma vaga do banco
        public function delete($where){
            // monta a query
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

            //executar a query
            $this->execute($query);

            //retorna sucesso
            return true;
        }
    }