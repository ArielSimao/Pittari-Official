<?php
require_once("class.phpmailer.php"); 
$nome = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$mensagem = $_POST['message'];
if (array_key_exists('arquivo', $_FILES)) {
$uploadNome = $_FILES['arquivo']['name'];
$upload = tempnam(sys_get_temp_dir(), hash('sha256', $uploadNome));
move_uploaded_file($_FILES['arquivo']['tmp_name'], $upload);
}
$conteudo ='Nome: ' .$nome;
$conteudo .='<br/>'.'Email: ' .$email;
$conteudo .='<br/>'.'Assunto: ' .$subject;
$conteudo .='<br/>'.'Mensagem: ' .$mensagem;
try {
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->IsSMTP();		
$mail->SMTPDebug = 0;		
$mail->SMTPAuth = true;		
$mail->SMTPSecure = 'ssl';	
$mail->Host = 'email-ssl.com.br';	
$mail->Port = '465';  		
$mail->Username = "contato@pittari.com.br"; 
$mail->Password = "Pittari@2019"; 
$mail->From = "contato@pittari.com.br";
$mail->FromName = "Contato do site Pittari";
$mail->AddAddress("contato@pittari.com.br");
$mail->IsHTML(true); 
$mail->Subject = "Mensagem do formulário de Contato";
$mail->Body = $conteudo;
if(isset($upload)){
$mail->AddAttachment($upload, $uploadNome);	
} 
$mail->Send(); 
    echo "<script>
	alert('Mensagem enviada com sucesso! Em breve responderemos.');
	window.location.href = 'index.html#three';
	</script>";
} catch (Exception $e) {
  	echo "<script>
		alert('Mensagem n\u00e3o enviada! Tente novamente mais tarde.');
		window.location.href = 'index.html#three';
	</script>";
}
?>
