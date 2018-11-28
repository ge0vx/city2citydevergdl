<?php
    date_default_timezone_set('America/Mexico_City');
    require 'PHPMailer/PHPMailerAutoload.php';

    if(     empty($_POST['name']) && strlen($_POST['name']) == 0 || 
            empty($_POST['email']) && strlen($_POST['email']) == 0 || 
            empty($_POST['message']) && strlen($_POST['message']) == 0)
	{
		return false;
	}

    if (is_ajax()){
        
        $nameCostumer = $_POST["name"];
        $mailCostumer = $_POST["email"];
        $dato_mensaje = $_POST["message"];
        return domail($mailCostumer, $nameCostumer, $dato_mensaje);
    }

    //Function to check if the request is an AJAX request
    function is_ajax() {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    function domail($mailC, $nameC, $msj){
        $mail = new PHPMailer;
        $mail->isSMTP();
        
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.zoho.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = "services@ubicuotech.mx";
        $mail->Password = "T3CHubicu0+.am";
        
        $mail->setFrom('services@ubicuotech.mx', 'City2City (no-reply)');
        
        //$mail->addAddress('geovapb@gmail.com', 'Diego Orozco');
        $mail->addAddress('diego@ubicuotech.mx', 'Diego Orozco');
        $mail->addAddress('eorozco@ubicuotech.com', 'Efrain Orozco');
        
        $mail->Subject = 'Eparki Contacto (no-reply)';
        $mail->Body    = 'Cyty2cyty Name: '.$nameC.' <br/>E-mail: '.$mailC."<br/><br/>Message: ".$msj;
        $mail->AltBody = $nameC.' |Correo: '.$mailC." |".$msj;
        if (!$mail->send()) {
            return false;
        } else {
            return true;	
        }
    }
?>