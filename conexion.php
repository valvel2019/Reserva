<?php
	session_start();
	$conex = mysqli_connect("localhost", "root", "", "travelweb")  or die ("No se ha podido establecer la conexión ");
	$email = $_POST['correo'];
	$pass = $_POST['password'];

	$consulta = "SELECT ced_usuario, nom_usuario,tel_usuario,cont_usuario, cod_t_usuario,  from USUARIO WHERE correo_usuario ='$email'";
	$res_consulta = mysqli_query($conex,$consulta);

	$login = mysqli_fetch_array($res_consulta);

	if ($login[0] == $pass) {

		$_SESSION["usuario"] = $login[1];
        $_SESSION["codusuario"] = $login[2];
        $_SESSION["contraseña"] = $login[0];
		
		if($login[2] == 1) {

			
			?>
			    <meta http-equiv="refresh" content="0; url=Cliente/indexCliente.php" />
      			
      		<?php
		} else if ($login[2] == 2) {

			?>
			    <meta http-equiv="refresh" content="0; url=Aerolinea/indexAerolinea.php" />
      			
      		<?php
		} else {

			?>
      			<meta http-equiv="refresh" content="0; url=Administrador/indexAdmin.php" />
      		<?php
		}
	} else {

		?>
      		<meta http-equiv="refresh" content="0; url=errorlogin.php" />
     	<?php
	}


?>