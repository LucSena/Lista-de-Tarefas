<?php

class Login {
    //Atributos privados
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private int $nivel;

    //metodos getters and setters
    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
}

?>

