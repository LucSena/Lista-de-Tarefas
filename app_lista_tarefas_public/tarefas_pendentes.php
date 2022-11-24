<?php
if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION["usuarioNome"]) || !isset($_SESSION["usuarioId"])) {
	// Usuário não logado! Redireciona para a página de login
	header("Location: index.php");
	exit;
}
$acao = 'recuperarTarefasPendentes';
require 'tarefa_controller.php';



// echo '<pre>';
// print_r($tarefas);
// echo '</pre>';


?>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


	<script>
		function editar(id, txt_tarefa) {
			//criando o formulario
			let form = document.createElement('form')
			form.action = 'index.php?pag=index&acao=atualizar'
			form.method = 'post'
			form.className = 'row'

			//criando o input para entrada do texto
			let inputTarefa = document.createElement('input')
			inputTarefa.type = 'text'
			inputTarefa.name = 'tarefa'
			inputTarefa.className = 'col-9 form-control'
			inputTarefa.value = txt_tarefa

			//criando um input hidden para guardar o id da tarefa
			let inputId = document.createElement('input')
			inputId.type = 'hidden'
			inputId.name = 'id'
			inputId.value = id

			//criando o botao para envio do formulario
			let button = document.createElement('button')
			button.type = 'submit'
			button.className = 'col-3 btn btn-success'
			button.innerHTML = 'Atualizar'



			//adicionando os elementos no form
			form.appendChild(inputTarefa)
			form.appendChild(inputId)
			form.appendChild(button)

			//vamos testar

			// console.log(form)

			// alert(id)


			let tarefa = document.getElementById('tarefa_' + id);

			tarefa.innerHTML = ''

			tarefa.insertBefore(form, tarefa[0])

		}

		function remover(id) {
			location.href = 'index.php?pag=index&acao=remover&id=' + id;

		}

		function marcarRealizada(id, status) {
			if (status == 'Pendente') {

				location.href = 'todas_tarefas.php?acao=marcarRealizada&pag=index&status=2&id=' + id
			} else {
				location.href = 'todas_tarefas.php?acao=marcarRealizada&status=1&id=' + id
			}



		}
	</script>

</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
				App Lista Tarefas
			</a>
			<div>
				<a href="Login_Controller.php?acao=deslogar">Sair</a>
			</div>
		</div>
	</nav>

	<div class="container app">
		<div class="row">
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class="list-group-item active"><a href="tarefas_pendentes.php">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
					<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Tarefas pendentes</h4>
							<hr />

							<?php
							if (count($tarefas) == 0) {
							?>
								<span class="text-secondary">Parabéns! Você não possui tarefas pendentes.</span>
							<?php
							}

							foreach ($tarefas as $indice => $tarefa) {
							?>
								<div class="row mb-3 d-flex align-self-center tarefa">
									<div class="col-sm-9" id="tarefa_<?php echo $tarefa->id; ?>"><?php echo $tarefa->tarefa; ?></div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?php echo $tarefa->id; ?>)"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?php echo $tarefa->id; ?>, '<?php echo $tarefa->tarefa; ?>')"></i>
										<!-- <i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?php //echo $tarefa->id; 
																														?>)"></i> -->
										<i class="<?php if ($tarefa->status == 'Pendente') {
														echo 'fas fa-square fa-lg text-success';
													} else {
														echo 'fas fa-check-square fa-lg text-success';
													} ?>" onclick="marcarRealizada(<?php echo $tarefa->id; ?>, '<?php echo $tarefa->status ?>')">
										</i>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>