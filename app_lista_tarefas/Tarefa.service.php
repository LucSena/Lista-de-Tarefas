<?php
    class TarefaService {
        //atributos para receber o objeto e a conexao do banco
        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa)
        {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        //create
        public function inserir() {
            $query = 'INSERT INTO tb_tarefa (tarefa) VALUES (:tarefa)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        } 
        //read
        public function recuperar() {
            $query = 'SELECT t.id, s.status, t.tarefa FROM tb_tarefa as t LEFT
                JOIN tb_status as s ON (t.id_status = s.id)';

            //$query = 'SELECT id, id_status, tarefa FROM tb_tarefa';


            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            //retorna um array de objetos
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        //update
        public function atualizar() {
            // echo '<pre>';
            // print_r($this->tarefa);
            // echo '</pre>';
            $query = 'UPDATE tb_tarefa SET tarefa = :tarefa WHERE id = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();
        
        }
        //delete
        public function remover() {
            $query = 'delete from tb_tarefa where id = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->execute();
        }

        //update
        public function marcarRealizada() {
            // echo '<pre>';
            // print_r($this->tarefa);
            // echo '</pre>';
            $query = 'UPDATE tb_tarefa SET id_status = :id_status WHERE id = :id';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();
        
        }

        public function recuperarTarefasPendentes() {
            $query = '
                select 
                    t.id, s.status, t.tarefa 
                from 
                    tb_tarefa as t
                    left join tb_status as s on (t.id_status = s.id)
                where
                    t.id_status = :id_status
            ';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
