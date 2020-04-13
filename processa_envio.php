<?php

   // print_r($_POST);

   require "./libs/PHPMailer/Exception.php";
   require "./libs/PHPMailer/OAuth.php";
   require "./libs/PHPMailer/PHPMailer.php";
   require "./libs/PHPMailer/POP3.php";
   require "./libs/PHPMailer/SMTP.php";

    //Instanciando os sNamespaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

   


    class Mensagem{

        private $para = null;
        private $assunto = null;
        private $mensagem = null;


        public function __get($attr){

            return $this->$attr;

         }

         public function __set($attr, $value){

             $this->$attr = $value;

         }

         public function mensagemValida(){

                if( empty($this->para) || empty($this->assunto) || empty($this->mensagem)){

                    return false;

                }

                else return true;
         } 


    }

    $mensagem = new Mensagem();
    $mensagem->__set('para' , $_POST['para']);
    $mensagem->__set('assunto' , $_POST['assunto']);
    $mensagem->__set('mensagem' , $_POST['mensagem']);


   // print_r($mensagem);
    

    //criar objeto PHPMAILER
   if(!$mensagem->mensagemValida()){
       echo "Mensagem não é válida";
       die();
   }

   $mail = new PHPMailer(true);

   try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'joaogomes.emails@gmail.com';                     // SMTP username
    $mail->Password   = 'joao_gomes!2020';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('joaogomes.emails@gmail.com', 'João Gomes Remetente');
    $mail->addAddress('joaogomes.emails@gmail.com', 'João Gomes destinatário');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com'); //copia
    // $mail->addBCC('bcc@example.com'); //copia oculta

    // Attachments - Anexo
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Olá eu sou o assunto';
    $mail->Body    = '<strong>Olá eu sou o conteudo do email!</strong>';
    $mail->AltBody = 'Olá eu sou o conteudo do email!';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Não foi possivel enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do Erro                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               : {$mail->ErrorInfo}";
}


?>