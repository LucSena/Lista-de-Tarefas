<?php
class LoginService
{
    //atributos para receber o objeto e a conexao do banco
    private $conexao;
    private $login;

    public function __construct(Conexao $conexao, Login $login)
    {
        $this->conexao = $conexao->conectar();
        $this->login = $login;
    }

    public function verificarLogin()
    {
        $query = 'SELECT * FROM tb_usuario WHERE email = :email AND senha = :senha';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $this->login->__get('email'));
        $stmt->bindValue(':senha', $this->login->__get('senha'));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criarSessaoUsuario($usuario){
        

        $_SESSION['usuarioId'] = $usuario['id'];
        $_SESSION['usuarioNome'] = $usuario['nome'];
        $_SESSION['usuarioEmail'] = $usuario['email'];
        $_SESSION['usuarioNivel'] = $usuario['nivel'];

        //dd($_SESSION['usuarioNivel']);      

        redirect('index.php'); 
    }

    public function deslogar(){
        unset($_SESSION['usuarioId']);
        unset($_SESSION['usuarioNome']);
        unset($_SESSION['usuarioEmail']);
        unset($_SESSION['usuarioNivel']);
        session_destroy();       

        redirect('index.php');
    }



    
}
