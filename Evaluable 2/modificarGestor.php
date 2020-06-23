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
	$row = NULL;
	$alias_cambiado = false;
	$usuario_inicial = NULL;

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
			
			if ($usuario == NULL) {
				$usuario = $usuario_inicial = $_POST['user'];
			}

			if ($_POST['user'] != $usuario_inicial) {
				echo "El usuario quiere cambiar su alias", PHP_EOL;
				$alias_cambiado = true;
			}
			
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

		$consulta = mysqli_query($db, "SELECT * FROM USUARIOS WHERE ALIAS='".$_POST["user"]."'");

		if ($consulta) {
			$row = $consulta->fetch_assoc();
			$nombre = $row['NOMBRE'];
		}
		else{
			echo "fallo en la consulta", PHP_EOL;
		}

		if ($confirmaciones==8) {	// Todos los campos se han rellenado

			$consulta = mysqli_query($db, "SELECT COUNT(*) FROM USUARIOS WHERE ALIAS='".$_POST["user"]."'");
			
			$num = mysqli_fetch_row($consulta)[0];
			mysqli_free_result($consulta);

			if ($num > 0 and $alias_cambiado) {
				$user_repetido = true;
			}
			else{	// El usuario puede modificar el alias
				// Una vez que tenemos todos los datos, hacemos el update
				$consulta = mysqli_query($db, "UPDATE USUARIOS SET NOMBRE='".$_POST["nombre"]."', APELLIDOS='".$_POST["apellidos"]."', ALIAS='".$_POST["user"]."', PASSWORD='".$_POST["password"]."', SECCION='".$_POST["seccion"]."', FECHA='".$_POST["fecha"]."', EMAIL='".$_POST["correo"]."', DESCRIPCION='".$_POST["descripcion"]."'
					WHERE ALIAS='".$_POST["user"]."'");

				if ($consulta) {
					$check = true;
				}
				else{
					$check = false;
				}
			}
		}
		
		// Se validan los datos con JavaScript y con la BD
		HTMLHeader($titulo,$disenio);
		headerMenu($usuario, "false");

		if (isset($_SESSION["user"])) { # Sesión establecida
			//echo "Se ha añadido un nuevo usuario", PHP_EOL;
			bodyRegistro($_SESSION['user'], $check, $user_repetido, $row);
		}
		else {	# Sesión no establecida
			bodyRegistro("", $check, $user_repetido, $row);
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
	//endSession();

	function bodyRegistro($usuario="", $confirmacion, $usuario_repetido, $fila){
		$nombre = $fila['NOMBRE'];
		$apellidos = $fila['APELLIDOS'];
		$user = $fila['ALIAS'];
		$password = $fila['PASSWORD'];
		$seccion = $fila['SECCION'];	
		$fecha = $fila['FECHA'];
		$email = $fila['EMAIL'];
		$descripcion = $fila['DESCRIPCION'];

		if ($confirmacion == true) {
			echo<<<HTML
			<main class="recursos">
			<form action="gestorbd.php" method="post" class="formulario">
			<p> El usuario <strong>$usuario</strong> se ha modificado con éxito.</p>
			<input type="submit" value="Entrar a la Web" name="inicio">
			<input type="text" name="user" value="$usuario" hidden="true">
			</form>
			</main>
			HTML;
		}
		else{
			echo<<<HTML
			<!-- Validacion de formulario de registro-->
			<main class="recursos"> 	<!-- Aquellas páginas cuyo main tenga una sola sección -->
			<h2><u>Por favor, introduzca sus datos. Todos los campos son obligatorios.</u></h2>
			<form class="formulario3" action="modificarGestor.php" method="post" onsubmit="return validacion()">
			<h3><label for="nombre">Nombre: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" class="nombre" name="nombre" id="nom" value="$nombre"></label>
			</h3>
			<h3>
			<label for="apellidos">Apellidos: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" class="author" name="apellidos" id="ape" value="$apellidos"></label>
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
			<input type="text" name="user" id="user" value="$user">
			<label for="password">  Contraseña: </label>
			<input type="text" name="password" id="password" value="$password"><br><br><br>
			<label for="section">Sección: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<select class="section" name="seccion" id="sect">
			<option value="1">Libros</option>
			<option value="2">Revistas</option>
			<option value="3">Música</option>
			</select>
			</h3>
			<h3>
			<label for="date">Fecha Nacimiento: &nbsp <input type="date" class="date" name="fecha" id="date" value="$fecha"></label>
			</h3>
			<h3>
			<label for="email">Email: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" class="email" name="correo" value="$email" id="correo"></label>
			</h3>
			<br><br>
			<h2 class="clear">&nbsp&nbspDescripción</h2>
			<textarea rows="12" placeholder="$descripcion" name="descripcion" value="$descripcion" id="descrip">$descripcion</textarea> 
			<br>
			<p class="botones_separados">
			<input type="submit" class="enviar" value="Enviar" name="enviar" onclick="validacion();">	
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