<?php  
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Alta Gestor - Digital Library";
	$disenio = "estilos.css";
	$class = "cabecera";
	$check = false;
	$confirmaciones = 0;
	$usuario = NULL;
	$user_repetido = false;

	session_start();

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);

	if ($db) {
		// Comprobamos si se han recibido los parámetros
		if (isset($_POST['nombre'])) {
			$confirmaciones+=1;
			$nombre = $_POST['nombre']; 
		}
		if (isset($_POST['apellidos'])) {
			$confirmaciones+=1;
			$apellidos = $_POST['apellidos']; 
		}
		if (isset($_POST['user'])) {
			$confirmaciones+=1;
			$usuario = $_POST['user'];
			$_SESSION["user"] = $_POST["user"];
		}
		if (isset($_POST['password'])) {
			$confirmaciones+=1;
			$contrasenia = $_POST['password'];
		}
		if (isset($_POST['seccion'])) {
			$confirmaciones+=1;
			$seccion = $_POST['seccion']; 
		}
		if (isset($_POST['fecha'])) {
			$confirmaciones+=1;
			$fecha = $_POST['fecha']; 
		}
		if (isset($_POST['correo'])) {
			$confirmaciones+=1;
			$correo = $_POST['correo']; 
		}
		if (isset($_POST['descripcion'])) {
			$confirmaciones+=1;
			$descripcion = $_POST['descripcion']; 
		}

		if ($confirmaciones == 8) {	// Todos los campos están rellenos
			// Comprobamos que no hay otro usuario con el mismo alias
			$consulta = mysqli_query($db, "SELECT COUNT(*) FROM USUARIOS WHERE ALIAS='".$_POST["user"]."'");
			
			$num = mysqli_fetch_row($consulta)[0];
			mysqli_free_result($consulta);

			if ($num > 0) { // Ya existe otro usuario con ese alias
				$user_repetido = true;
			}
			else{

				$consulta = mysqli_query($db, "INSERT INTO USUARIOS (NOMBRE, APELLIDOS,PASSWORD,ALIAS,SECCION,FECHA,EMAIL,DESCRIPCION) 
				VALUES ('".$_POST["nombre"]."','".$_POST["apellidos"]."',
				'".$_POST["password"]."','".$_POST["user"]."',
				'".$_POST["seccion"]."','".$_POST["fecha"]."','".$_POST["correo"]."',
				'".$_POST["descripcion"]."')");

				if($consulta){ 	// Nuevo usuario añadido. Consulta realizada con éxito
					$check = true;
				}
			}
		}
		
		HTMLHeader($titulo,$disenio);
		headerMenu($usuario, "false");

		if (isset($_SESSION["user"])) { # Si la sesión está establecida			
			//echo "Se ha añadido un nuevo usuario", PHP_EOL;
			bodyRegistro($_SESSION['user'], $check, $user_repetido);
		}
		else {	# Sesión no establecida			
			bodyRegistro("", $check, $user_repetido);
		}
	}
	else{
		return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
		// Se establece la codificación de los datos almacenados
		mysqli_set_charset($db, "utf8");
		return $db;
	}

	HTMLFooter();
	htmlEnd();
	mysqli_close($db);
	// endSession();

	function bodyRegistro($usuario="", $confirmacion, $usuario_repetido){
		if ($confirmacion == true) {
			echo<<<HTML
			<main class="recursos">
			<form action="index.php" method="post" class="formulario">
			<p> El usuario <strong>$usuario</strong> ha quedado registrado, pulse para iniciar sesión.</p>
			<input type="submit" value="Inicio" name="inicio">
			</form>
			</main>
			HTML;
		}
		else{
			echo<<<HTML
			<!-- Validacion de formulario de registro-->
			<main class="recursos"> 	<!-- Aquellas páginas cuyo main tenga una sola sección -->
			<h2><u>Por favor, introduzca sus datos. Todos los campos son obligatorios.</u></h2>
			<form class="formulario3" action="registro.php" method="post" onsubmit="return validacion()">
			<h3><label for="nombre">Nombre: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" class="nombre" name="nombre" id="nom"></label>
			</h3>
			<h3>
			<label for="apellidos">Apellidos: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" class="author" name="apellidos" id="ape"></label>
			</h3>
			<h3>
			HTML;
			if ($usuario_repetido==true) {
				echo<<<HTML
				<strong style="color:#FF0000">Ya existe otro usuario con ese alias. Pruebe de nuevo.  </strong>
				<br>
				HTML;
			}
			echo<<<HTML
			<label for="user"> Usuario: </label>
			<input type="text" name="user" id="user">
			<label for="password">  Contraseña: </label>
			<input type="text" name="password" id="password"><br><br><br>
			<label for="section">Sección: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<select class="section" name="seccion" id="sect">
			<option value="1">Libros</option>
			<option value="2">Revistas</option>
			<option value="3">Música</option>
			</select>
			</h3>
			<h3>
			<label for="date">Fecha Nacimiento: &nbsp <input type="date" class="date" name="fecha" id="date"></label>
			</h3>
			<h3>
			<label for="email">Email: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" class="email" name="correo" id="correo"></label>
			</h3>
			<br><br>
			<h2 class="clear">&nbsp&nbspDescripción</h2>
			<textarea rows="12" placeholder="Escriba una descripción personal" name="descripcion" id="descrip"></textarea> 
			<br>
			<p class="botones_separados">
			<!-- Se ha quitado el punto y coma detras de validacion() -->
			<input type="submit" class="enviar" value="Enviar" name="enviar"><!--onclick="validacion(event)">-->
			</p>
			</form>	
			</main>
			<br>
			<!-- Anotación sobre el uso de un campo-->
			<p> <em>En el campo <strong>sección</strong> se debe indicar qué tipo de biblioteca se va a gestionar.</em></p>
			HTML;
		}
		
	}
?>