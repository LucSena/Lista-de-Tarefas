<?php
    class Conexao {
        private $host = 'localhost';
        private $dbname = 'app_tarefas_m32';
        private $user = 'root';
        private $pass = '';

        public function conectar(){
            try {
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    "$this->user",
                    "$this->pass"
                );
                
                return $conexao;
            } catch(PDOException $erro){
                echo '<p>Erro: ' . $erro->getMessage() . '</p>';
            }
        }
    }
?>