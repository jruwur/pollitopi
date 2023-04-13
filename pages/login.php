
<!doctype html>
<html lang="es">
	<head>
	<title>Iniciar Sesión</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="../img/Iconopio.ico">
	<link rel="stylesheet" href="../css/footer.css">
	<link rel="stylesheet" href="../css/cabeza.css">
	<link rel="stylesheet" href="../css/login.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https:/fonts.googleapis.com/css2?family=Josfin+Sans:ital,wght@0,.100;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Montserrat:wght@700;800;900&display=swap">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/094144b100.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
	</head>
	<body>
  <div class="hero">
    <nav>
        <img class="logotipo" src="../img/logo-removebg-preview.png" alt="logos">
        <ul>
            <li><a href="../index.php">inicio</a></li>
            <li><a href="menu.php">menu</a></li>
            <li><a href="productos.php">productos</a></li>
            <li><a href="ubication.php">ubicacion</a></li>
            <script async src="https://cse.google.com/cse.js?cx=83e16dab7ae3d4ed5">
            </script>
            <div class="gcse-searchbox-only"></div>
        </ul>
    </nav>
</div>


  <?php
	  
  if(isset($_GET['datitos'])){

	  $verificacion =$_GET['datitos'];
	  if($verificacion == 891){
		  echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
		  <div>
		   TU INTENTASTE COSAS PROHIBIDAS
		  </div>
		</div>';
	  }
  }
?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php 
include("../database.php");
$correoLogin= $contraseñaLogin ="";
$datosLogin =[];
$nombre = $correo = $contraseña1 = $contraseña2 = $captcha ="";//variables para datos posteados(register)
$nameErr = $correoLErr= $correoErr = $contraLErr= $contraErr = $contra2Err = $captchaErr = "";//variables para mensajes de error
$todoslosdatos = [];//arreglo para almacenar todos los datos juntos
if (isset($_POST['loginbtn'])){//Si se presiona el botón login has lo sig
//checkeo de incio de sesión de administrador
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if($_POST["correoLogin"]==="admin@correo.com"){

		$correoLogin = $_POST["correoLogin"];
		$contraseñaLogin = $_POST["contraseñaLogin"];
		$stmt = $conn->prepare("CALL sp_login(?, ?)");
$stmt->bind_param("ss", $correoLogin, $contraseñaLogin);

			//registrar en log--------------------------------------------------------
			$accion = "Inicio de sesión";
			$usuario = $correoLogin;
			$sql = "INSERT into pollito_logs (accion, usuario) values('$accion','$usuario')";
			$result = mysqli_query($conn,$sql);
			//registrar en log--------------------------------------------------------

$stmt->execute();
$result = $stmt->get_result(); //asdasd
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  if ($row['resultado']) {
	//iniciar sesion de adm	in crear consulta para saludar con el nombre del usuario
	//redirigir al admin crud
	header("Location: ../admin/admin.php?datitos=890");
  } else {

	echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
	<div>
	 Correo o contraseña incorrectos
	</div>
  </div>';
  }
} else {
	echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
	<div>
	 Error de inicio de sesión
	</div>
  </div>';
}

$stmt->close();
$conn->close();
	
	}else
	{
		if (empty($_POST["correoLogin"])) {//validar si no esta vacio el campo
		  $correoLErr = "Escribe tu correo";
		}
		elseif($_POST["correoLogin"]=="'OR 1=1 --" ||$_POST["correoLogin"]=="'or 1=1--" ||$_POST["correoLogin"]=="'OR 1=1--" ){
			$correoLErr ="Buen intento pelotudo";
		} else {			
		  $correoLogin = test_input($_POST["correoLogin"]);//mandamos llamar la funcion de testeo
		  if($correoLogin){
			array_push($datosLogin, $correoLogin);//almacenamos el dato a un arreglo		
		  }
		}
	
		if (empty($_POST["contraseñaLogin"])) {//validar si no esta vacio el campo
			$contraLErr = "Escribe tu correo";
		  }
		  elseif($_POST["contraseñaLogin"]=="'OR 1=1 --" ||$_POST["contraseñaLogin"]=="'or 1=1--" ||$_POST["contraseñaLogin"]=="'OR 1=1--" ){
			  $contraLErr ="Buen intento pelotudo";
		  } else {			
			$contraseñaLogin = test_input($_POST["contraseñaLogin"]);//mandamos llamar la funcion de testeo
			if($contraseñaLogin){
			  array_push($datosLogin, $contraseñaLogin);//almacenamos el dato a un arreglo		
			}
		  }
				 //---
	}
}
$count = count($datosLogin);//contar los valores para validarlos
		if($count === 2){
			// Preparar el llamado al procedimiento almacenado
			$stmt = $conn->prepare("CALL sp_validarusuario(?, ?, @valido)");
			$stmt->bind_param("ss", $correoLogin, $contraseñaLogin);
			//registrar en log--------------------------------------------------------
			$accion = "Inicio de sesión";
			$usuario = $correoLogin;
			$sql = "INSERT into pollito_logs (accion, usuario) values('$accion','$usuario')";
			//registrar en log--------------------------------------------------------
			$result = mysqli_query($conn,$sql);
			// Establecer los valores de las variables de entrada
			$correoLogin = $_POST['correoLogin'];
			$contraseñaLogin = $_POST['contraseñaLogin'];
			
			// Ejecutar el procedimiento almacenado
			$stmt->execute();
			
			// Obtener el valor de la variable de salida
			$resultado = $conn->query("SELECT @valido")->fetch_assoc()["@valido"];
			
			// Verificar si el usuario es válido
			if ($resultado == 1) {
				header("Location: ../index.php?correoUsuario=$correoLogin");	
			} else {
				echo "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
				<div>
				usuario invalido!
				</div>
			  </div>";
			}
			
			// Cerrar la conexión y liberar los recursos
			$stmt->close();
			$conn->close();
			
		}
		else{
			//error por no completar todos los datos
			echo "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
			<div>
			Datos incompletos o algo salio mal!
			</div>
		  </div>";
		}


} elseif(isset($_POST['registerbtn'])){//si se preciona el botón register has lo sig
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["nombre"])) {//validar si no esta vacio el campo
		  $nameErr = "Escribe tu nombre";
		}
		elseif($_POST["nombre"]=="'OR 1=1 --" ||$_POST["nombre"]=="'or 1=1--" ||$_POST["nombre"]=="'OR 1=1--" ){
			$nameErr ="Buen intento pelotudo";
		} else {			
		  $nombre = test_input($_POST["nombre"]);//mandamos llamar la funcion de testeo
		  if($nombre){
			array_push($todoslosdatos, $nombre);//almacenamos el dato a un arreglo
		  }
		}
		if (empty($_POST["correoelectronico"])) {
		  $correoErr = "Escribe tu correo";
		}
		elseif($_POST["nombre"]=="'OR 1=1 --" ||$_POST["nombre"]=="'or 1=1--" ||$_POST["nombre"]=="'OR 1=1--" ){
			$correoErr ="Buen intento pelotudo";
		} else {
		  $correo = test_input($_POST["correoelectronico"]);
		  if($correo){
			array_push($todoslosdatos, $correo);
		  }
		}
		if (empty($_POST["contraseña1"])) {
			$contraErr = "Escrine tu Contraseña";
		  }
		  elseif($_POST["nombre"]=="'OR 1=1 --" ||$_POST["nombre"]=="'or 1=1--" ||$_POST["nombre"]=="'OR 1=1--" ){
			$contra2Err ="Buen intento pelotudo";
		} else {
			$contraseña1 = test_input($_POST["contraseña1"]);
			if($contraseña1){
				array_push($todoslosdatos, $contraseña1);
			  }
		  }
		  if (empty($_POST["contraseña2"])) {
			$contra2Err = "Reafirma contraseña";
		  } elseif($_POST["contraseña2"] != $_POST["contraseña1"]){
			$contra2Err = "Las contraseñas deben coincidir";
		  }
		   else {
			$contraseña2 = test_input($_POST["contraseña2"]);
			if($contraseña2){
				array_push($todoslosdatos, $contraseña2);
			  }
		  }

		}

		$count = count($todoslosdatos);//contar los valores para validarlos
		if($count === 4){
			//Asignamos valores del arreglo a nueva variable para realizar el query con ellas 
			$NombreValido = $todoslosdatos[0];
			$CorreoValido = $todoslosdatos[1];
			$Contraseña1Valida= $todoslosdatos[2];
			$Contraseña2Valida = $todoslosdatos[3];
			
			//registro en el log-----------------------------------------
			$accion = "Registro de usuario";
			$usuario = $CorreoValido;
			$sql = "INSERT into pollito_logs (accion, usuario) values('$accion','$usuario')";
			$result = mysqli_query($conn,$sql);
			//registro en el log-----------------------------------------
			// Prepare the statement
			$stmt = $conn->prepare("CALL sp_insertarusuario(?,?,?,?)");
			// Bind the parameters
			$stmt->bind_param("ssss", $nombre, $correo, $contraseña1,$contraseña2);
			// Execute and end the statement
            $stmt->execute();
			// Verificar si el correo ya existe
			$row =$stmt-> affected_rows;
			
				echo "<div class='alert alert-success text-center d-flex align-items-center' role='alert'>
				<div>
				Registro completado ya puedes loggearte!
				</div>
			  </div>";

            if ($row==0) {
	         // Enviar la alerta
			 echo "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
			 <div>
			 El correo ya existe!
			 </div>
		   </div>";
                }
			}
			else{
				//error por no completar todos los datos
				echo "<div class='alert alert-danger text-center d-flex align-items-center' role='alert'>
				<div>
				Completa los datos correctamente!
				</div>
				</div>";
				
			}
		
	}
	function test_input($data) {
		$data = trim($data); //evitar caracteres inesesarios(extra space, tab, newline)
		$data = stripslashes($data);//evitar backslashes (\)
		$data = htmlspecialchars($data);//evitar caracteres especiales
		return $data;
	  }

?>
<div class="section">
	<form id="myForm"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<div class="container">

		<?php 
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			'.$msg.'
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		   </div> ';
		}
		?>
			<div class="row full-height justify-content-center">
			<div class="col-12 text-center align-self-center py-5">
				<div class="section pb-5 pt-5 pt-sm-2 text-center">
					<!--Alerta-->
					
						<!--Alerta-->
					<h6 class="mb-0 pb-3 my-2"><span>Iniciar sesión </span><span>Registrarse</span></h6>
					  <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
					  <label for="reg-log"></label>
					<div class="card-3d-wrap mx-auto">
						<div class="card-3d-wrapper">
							<div class="card-front">
								<div class="center-wrap">
									<div class="section text-center">
										<h4 class="mb-4 pb-3">Inicia sesión</h4>
										<div class="form-group">
											<input name="correoLogin" type="email" class="form-style" placeholder="Escribe tu correo">
											<i class="input-icon uil uil-at"></i>
										</div>	
										<span class="error"><?php echo $correoLErr;?></span>
										<div class="form-group mt-2">
											<input name="contraseñaLogin" type="password" class="form-style" placeholder="Escribe tu contraseña">
											<i class="input-icon uil uil-lock-alt"></i>
										</div> 				
										<span class="error"><?php echo $contraLErr;?></span>					
										<div class="g-recaptcha" data-sitekey="your_site_key"></div>
										  <br/>
										<button class="btn mt-4" type="submit" name="loginbtn" value="loginbtn">
											   Iniciar Sesión
										  </button>
									  </div>
								  </div>
							  </div>
					
					<div class="card-back">
						<div class="center-wrap">
							<div class="section text-center">
								<h4 class="mb-3 pb-3 mt-4">Registrate!</h4>
								<div class="form-group">
											<input type="text" name="nombre" class="form-style" placeholder="Escribe tu(s) nombre(s)">
											<i class="input-icon uil uil-user"></i>
										</div>	
										<span class="error"><?php echo $nameErr;?></span>
										<div class="form-group mt-2">
											<input type="email" name="correoelectronico" class="form-style" placeholder="Escribe tu correo electrónico">
											<i class="input-icon uil uil-mail"></i>
										</div>	
										<span class="error"><?php echo $correoErr;?></span>
										<div class="form-group mt-2">
											<input type="password" name="contraseña1" class="form-style" placeholder="Escribe tu contraseña">
											<i class="input-icon uil uil-at"></i>
										</div>
										<span class="error"><?php echo $contraErr;?></span>
										<div class="form-group mt-2">
											<input type="password" name="contraseña2" class="form-style" placeholder="Confirma tu   contraseña">
											<i class="input-icon uil uil-lock-alt"></i>
										</div>
										<span class="error"><?php echo $contra2Err;?></span>
										
										<div class="g-recaptcha" data-sitekey="your_site_key"></div>
										  <br/>
										  <button class="btn mt-4" id="submit" type="submit" name="registerbtn" value="registerbtn">
											   Registrarse
										  </button>
									</div>
								</div>
							</div>
						</div>
					
					  </div>
				  </div>
			  </div>
		  </div>
	
		</div>
	</form>


</div>

<button
type="button"
class="btn btn-danger btn-floating btn-lg"
id="btn-back-to-top"
>
<i class="fas fa-arrow-up"></i>
</button>

<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="footer-col">
				<h4>company</h4>
				<ul>
					<li><a href="/pages/inicio.html">Pollitos Pio</a></li>
					
				</ul>
			</div>
			<div class="footer-col">
				<h4>get help</h4>
				<ul>
					<li><a href="/pages/terms&conditions.html">Terminos y condiciones</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Redes sociales</h4>
				<ul>
					<li><a href="https://www.facebook.com/PollitotoPio/">Facebook</a></li>
					<li><a href="https://www.instagram.com/ivan_buhaje/">Instragram</a></li>
					<li><a href="https://twitter.com/pollitopiopoi3">Twitter</a></li>
					<li><a href="https://www.youtube.com/@Natalan">Youtube</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>¡Siguenos!</h4>
				<div class="social-links">
					<a href="https://www.facebook.com/PollitotoPio/"><i class="fab fa-facebook-f"></i></a>
					<a href="https://twitter.com/pollitopiopoi3"><i class="fab fa-twitter"></i></a>
					<a href="https://www.instagram.com/ivan_buhaje/"><i class="fab fa-instagram"></i></a>
					<a href="https://www.youtube.com/@Natalan"><i class="fab fa-youtube"></i></a>
					
				</div>
			</div>
			</div>
		</div>
	</div>
</footer>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/alert.js"></script>
	<script src="../js/index.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>