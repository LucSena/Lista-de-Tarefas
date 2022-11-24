<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

//passo 1: Temos que importar as classes e arquivos necessários
require('../../app_lista_tarefas/Tarefa.model.php');
require('../../app_lista_tarefas/Tarefa.service.php');
require('../../app_lista_tarefas/Conexao.php');

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// echo $acao;

if ($acao == 'inserir') {
    //passo 2: Criar um objeto da classe Tarefa e inserir o 
    //valor vindo do post
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    //passo 3: Criar um objeto da classe Conexao (banco de dados)
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();
    header('Location: nova_tarefa.php?inclusao=1');
} else if ($acao == 'recuperar') {
    $tarefa = new Tarefa();
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperar();
} else if ($acao == 'atualizar') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);

    if ($tarefaService->atualizar()) {
        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('location: index.php');
        } else {
            header('location: todas_tarefas.php');
        }
    }
} else if ($acao == 'remover') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();
    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('location: index.php');
    } else {
        header('location: todas_tarefas.php');
    }
} else if ($acao == 'marcarRealizada') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', $_GET['status']);

    // echo '<pre>';
    // print_r($tarefa);
    // echo '</pre>';
    // exit();

    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);

    //vamos executar um método que ainda vamos criar
    $tarefaService->marcarRealizada();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('location: index.php');
    } else {
        header('location: todas_tarefas.php');
    }
} else if ($acao == 'recuperarTarefasPendentes') {
    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperarTarefasPendentes();
}



// echo '<pre>';
// print_r($tarefaService);
// echo '</pre>';
