<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="shortcut icon" href="logo.png" type="image/x-icon">
	</head>

	<body>

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail Suport ingresso.com</h2>
				<p class="lead"> Bem-vindo a Atendimento Cinemas | Ingresso.com</p>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<label for="layout" class="form-label">Layout</label>
								<div class="input-group">
									<select class="form-select" aria-label="Default select example" name="layout" id="layout" style="text-align:center;" required>
										<option value="none">--Selecione--</option>
										<option value="duvida">Esclarecer uma dúvida</option>
										<option value="reclamacao">Fazer uma reclamação</option>
										<option value="cancelamento">Solicitar Cancelamento e Reembolso</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="nome">Nome do Contato</label>
								<input name="nome" type="text" class="form-control" id="assunto" placeholder="" required>
							</div>

							<div class="form-group">
								<label for="email">Seu E-mail</label>
								<input name="email" type="email" class="form-control" id="para" placeholder="joao@dominio.com.br" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
							</div>

							<div class="form-group">
								<label for="telefone">Seu telefone</label>
								<input name="telefone" type="text" class="form-control" id="para" placeholder="(XX)XXXXX-XXXX" title="(XX)XXXXX-XXXX" pattern="^\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required>
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assunto do e-mail" required>
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea name="mensagem" class="form-control" id="mensagem" required></textarea>
							</div>

							<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
						</form>

					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>