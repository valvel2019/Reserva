
<?php
    session_start();

    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "travelweb";

    $conexion = new mysqli($server, $user, $pass,$bd) or die(mysqli_error($conexion));

   
    $cedclie=$_POST['cedcli'] ;
    $nomclie =$_POST['nomcli'];
    $correo=$_POST['corcli'];
    $tel=$_POST['telcli'];
    $paw =  utf8_decode($_POST['password']);
    //$tipo=utf8_decode($_POST['tipo']);

    $asunto="Bienvenido";
    $carta="Gracias por registrarte ";
    $cabeceras  = "MIME-Version: 1.0\n";
    $cabeceras .= "Content-type: text/html; charset=UTF-8\n";

    

   


    $resultado=mysqli_query( $conexion,"SELECT * FROM USUARIO WHERE correo_usuario = '$correo' AND contrasena ='$paw'");
 
    if (mysqli_num_rows($resultado)>0)
    {
      ?>
      <meta http-equiv="refresh" content="0; url=index.php" />

      <?php
 
    } else {

      $insert_value = 'INSERT INTO USUARIO  VALUES ("' . $cedclie.'","' . $nomclie.'","' . $correo.'","' . $tel.'","' . $paw.'",1)';
       mysqli_select_db( $conexion,$bd);
       $retry_value = mysqli_query( $conexion,$insert_value);
       require("archivos\mailer\class.phpmailer.php");
        //require('archivos/mailer/class.php');

       // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
        $mail = new PHPMailer();

        $mail->From     = "travelwebviajes@gmail.com";
        $mail->FromName = "travel web";
        $mail->AddAddress($correo); // Dirección a la que llegaran los mensajes.

// Aquí van los datos que apareceran en el correo que reciba

  
   
   $mail->WordWrap = 50;
   $mail->IsHTML(true);    
   $mail->Subject  =  "Bienvenid@"; // Asunto del mensaje.
   $mail->Body     =  "Gracias por registrarte";

// Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...
   $mail->SMTPDebug = 2;
   $mail->IsSMTP();
   $mail->Host ="ssl://smtp.gmail.com:465";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP
  
   $mail->SMTPAuth = true;
   $mail->Username = 'travelwebviajes@gmail.com';  // Correo Electrónico
   $mail->Password = 'Travelweb19'; // Contraseña del correo

   if ($mail->Send()){
           echo "<script>alert('Formulario enviado exitosamente');</script>";
   }else{
           echo "<script>alert('Error al enviar el formulario');</script>";
   }
    
     if (!$retry_value) {
       die('Error: ' . mysqli_error($conexion));
       
    }
 
    ?>
       <meta http-equiv="refresh" content="0; url=index.php" />

    <?php
}
 
mysqli_close($conexion);

 
?>




    
  







  