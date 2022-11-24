<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["usuarioNome"]) || isset($_SESSION["usuarioId"])) {
    header("Location: todas_tarefas.php");
    exit;
}

?>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Lista Tarefas</title>

    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                App Lista Tarefas
            </a>
        </div>
    </nav>

    <div class="container app">
        <div class="row">
            <div class="col-md-6 offset-md-3 bg-light border border-secondary rounded">
                <div class="col-md-10 offset-md-1">


                    <h1 class="pt-4 fs-2 fw-bold">Opah! Se indentifique</h1>

                    <hr>

                    <form class="pb-3" method="POST" action="Login_Controller.php?acao=login">
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == 1) {
                        ?>
                            <div class="form-group  alert alert-danger p-3 rounded text-center">
                                <span class="">Usuário ou senha inválidos!!!</span>
                            </div>
                        <?php
                        //echo md5('root');
                        }
                        ?>
                        <div class="form-group mb-3">
                            <label class="mb-2" for="usuario_email">E-mail</label>
                            <input type="email" class="form-control mb-2" id="usuario_email" aria-describedby="usuario_email" placeholder="Insira seu e-mail" name="usuario_email" required>
                            <small id="emailHelp" class="form-text text-muted">Nunca compartilharemos seu e-mail com mais ninguém.</small>
                        </div>
                        <div class="form-group">
                            <label class="mb-2" for="usuario_senha">Senha</label>
                            <input type="password" class="form-control mb-2" id="usuario_senha" placeholder="Insira sua senha" name="usuario_senha" required>
                        </div>

                        <input type="hidden" name="acao" value="login">
                        <button type="submit" class="btn btn-success">Verificar</button>
                    </form>
                    <div class="pb-3 text-end">
                        <p class="m-0 ">Não possui uma conta? <a href="" class="text-info fw-bold text-decoration-none">Crie uma</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>