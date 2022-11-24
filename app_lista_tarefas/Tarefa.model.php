<?php

class Tarefa {
    //Atributos privados
    private int $id;
    private int $id_status;
    private string $tarefa;
    private string $data_cadastro;

    //metodos getters and setters
    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}

?>

