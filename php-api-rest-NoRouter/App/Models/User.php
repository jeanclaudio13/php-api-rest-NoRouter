<?php
//Regras de Negócio

    namespace App\Models;

    class User
    {
        private static $table = 'nome_da_tabela';

        public static function select(int $id) {
            //PDO é um objeto global já incluso
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, \DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';//.self para static, senão .this
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0){ //Encontrou pelo menos 1 linha
                var_dump(http_response_code(200));
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                var_dump(http_response_code(500));
                throw new \Exception("Nenhum usuário encontrado!");
            }
        }


        public static function selectAll() {
            //PDO é um objeto global já incluso
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, \DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table;//.self para static, senão .this
            $stmt = $connPdo->prepare($sql);
           
            $stmt->execute();

            if ($stmt->rowCount() > 0){ //Encontrou pelo menos 1 linha
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);

            } else {                
                throw new \Exception("Nenhum usuário encontrado!");
            }
        }


        public static function insert($data){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, \DBUSER, DBPASS);

            $sql = 'INSERT INTO  '.self::$table.' (email, senha, nome) VALUES(:em, :pss, :no)';
            $stmt = $connPdo->prepare($sql);

            $stmt->bindValue(':em', $data['email']);
            $stmt->bindValue(':pss', $data['senha']);
            $stmt->bindValue(':no', $data['nome']);

            $stmt->execute();

            if ($stmt->rowCount() > 0){ //Encontrou pelo menos 1 linha
                return 'Inserido com sucesso!';

            } else {                
                throw new \Exception("Fala ao inserir");
            }
        }
            
    }