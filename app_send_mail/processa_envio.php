<?php
	'<meta charset="utf-8" />';

	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer/PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php";
	require "./bibliotecas/PHPMailer/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	//print_r($_POST);

	class Mensagem {
		private $nome = null;
		private $email = null;
		private $telefone = null;
		private $assunto = null;
		private $mensagem = null;
		private $layout = null;
		public $status = array('codigo_status'=>null,'descricao_status'=>'');
	
		public function __get($atributo) {
			return $this->$atributo;
		}
	
		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}
	
		public function mensagemValida() {
			if(empty($this->nome) || empty($this->email) || empty($this->telefone) || empty($this->assunto) || empty($this->mensagem) || empty($this->layout)) {
				return false;
			}
	
			return true;
		}
	}
	
	$mensagem = new Mensagem();
	
	$mensagem->__set('nome', $_POST['nome']);
	$mensagem->__set('email', $_POST['email']);
	$mensagem->__set('telefone', $_POST['telefone']);
	$mensagem->__set('assunto', $_POST['assunto']);
	$mensagem->__set('mensagem', $_POST['mensagem']);
	$mensagem->__set('layout', $_POST['layout']);
	
	if(!$mensagem->mensagemValida()) {
		echo 'Mensagem não é válida';
		header('Location: index.php');
	}


	$mail = new PHPMailer(true);
	try {
			//Server settings
			$mail->CharSet = 'UTF-8';

			$mail->SMTPDebug = false;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'sendm836@gmail.com';                     //SMTP username
			$mail->Password   = 'lcsiknsnwxvbczqm';                               //SMTP password
			$mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setFrom('sendm836@gmail.com','Atendimento Cinemas | Ingresso.com');
			$mail->addAddress('ouvidoria@ingresso.com', 'Destinatario');     //Add a recipient
			$mail->addAddress($mensagem->__get('email'), 'Atendimento Cinemas | Ingresso.com');     //Add a recipient
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content

			$body = 'Nome: ' . $mensagem->__get('nome') . '<br>';
			$body .= 'Layout: ' . $mensagem->__get('layout') . '<br>';
			$body .= 'Telefone: ' . $mensagem->__get('telefone') . '<br>';
			$body .= 'Email para contato: ' . $mensagem->__get('email') . '<br>';
			$body .= '<br>Mensagem:<br>';
			$body .= $mensagem->__get('mensagem');
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $mensagem->__get('assunto');
			$mail->Body = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.$body;
			$mail->AltBody = $mensagem->__get('layout');

			$mail->send();
			$mensagem->status['codigo_status'] = 1;
			$mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';

	} catch (Exception $e) {

			$mensagem->status['codigo_status'] = 2;
			$mensagem->status['descricao_status'] = 'Não foi possivel enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro:'.$mail->ErrorInfo;
	}


?>	

<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="shortcut icon" href="logo.png" type="image/x-icon">
	</head>

<body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="text-center" style="margin-top: 2%;">
            <img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
            <h2>Send Mail Suport ingresso.com</h2>
            <p class="lead"> Bem-vindo a Atendimento Cinemas | Ingresso.com</p>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-center" style="margin-top: 50%;"> <!-- Adicionei d-flex e justify-content-center para centralizar a coluna -->
                    <?php if($mensagem->status['codigo_status'] == 1) { ?>
                        <div class="container">
                            <h1 class="display-4 text-success">Sucesso</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p>
                            <a href="index.php" class="btn btn-success btn-lg mt-4 text-white">Voltar</a>
                        </div>
                    <?php } elseif($mensagem->status['codigo_status'] == 2) { ?>
                        <div class="container">
                            <h1 class="display-4 text-danger">Ops!</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p>
                            <a href="index.php" class="btn btn-danger btn-lg mt-4 text-white">Voltar</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>


</html>