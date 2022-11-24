<?php
if (!isset($_SESSION)) {
    session_start();
}

//passo 1: Temos que importar as classes e arquivos necessários
require('../../app_lista_tarefas/login/Login.model.php');
require('../../app_lista_tarefas/login/Login.service.php');
require('../../app_lista_tarefas/Conexao.php');
require('../../app_lista_tarefas/funcoes/functions.php');

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// echo $acao;

if ($acao == 'login') {

    $login = new Login();

    $login->__set('email', $_POST['usuario_email']);
    $login->__set('senha', md5($_POST['usuario_senha']));

    $conexao = new Conexao();
    $loginService = new LoginService($conexao, $login);


    $user_logado = $loginService->verificarLogin();

    if ($user_logado) {
        $loginService->criarSessaoUsuario($user_logado);
    } else {
        redirect('index.php?error=1');
    }
} else if ($acao == 'deslogar') {
    unset($_SESSION['usuarioId']);
    unset($_SESSION['usuarioNome']);
    unset($_SESSION['usuarioEmail']);
    unset($_SESSION['usuarioNivel']);
    session_destroy();

    redirect('index.php');
}
