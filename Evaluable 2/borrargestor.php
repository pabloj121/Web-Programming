<?php  
	require 'main_functions.inc';
	require 'credencialesBD.php';
	
	$titulo = "Borrar Gestor - Digital Library";
	$disenio = "estilos.css";
	$usuario = NULL;

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
	

	if ($db) {
		# code...
		if (isset($_POST['user'])){// and isset($_POST['confirm'])) {
			# code...
			$usuario = $_POST['user'];
			$_SESSION["user"] = $_POST["user"];

			if(isset($_POST['confirm'])){
				$confirmacion = $_POST['confirm'];
			}
		}
		else if (isset($_POST["logout"])) {
			# code...
			endSesion();
		}

		//echo "confirmacion: ", $_POST['confirm'], PHP_EOL;
		HTMLHeader($titulo, $disenio);
		headerMenu($usuario);

		// Se comprueba si el usuario ha dado respuesta y que se ha podido borrar realmente del servidor
		if(isset($_POST['confirm']) and $_POST['confirm']=="Sí"){ 	// Confirmación de borrado
			// Realizar consulta
			$consulta = mysqli_query($db, "DELETE FROM USUARIOS WHERE ALIAS='$usuario'");

			if ($consulta) { // La orden SQL ha ido bien
				$check = true;
			}
			else{
				echo "Error en la consulta", PHP_EOL;
			}
			bodyBorrar("Sí", $usuario);
		}
		else{
			bodyBorrar("No", $usuario);
		}
	} 
	else{ // No se ha establecido la conexion con la BD
		return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
		// Se establece la codificación de los datos almacenados
		mysqli_set_charset($db, "utf8");
		return $db;
	}

	// showBody
	function bodyBorrar($confirmacion, $usuario){
		if ($confirmacion=="Sí") {
			echo<<<HTML
			<main class="recursos">
			<p> El Gestor <strong>$usuario</strong> ha sido eliminado del sistema.</p>
			<form action="index.php" method="post" class="formulario">
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="submit" name="index" value="Página principal">
			</form>
			</main>
			HTML;
		}
		else if($confirmacion=="No"){
			echo<<<HTML
			<main class="recursos">
			<p> <strong>¿Está seguro que desea borrar su perfil como Gestor?</strong> </p>
			<!--<form action="borrargestor.php">-->
			<form action="borrargestor.php" method="post">
			<input type="radio" name="confirm" value="Sí" checked="">	Sí
			<br><br>
			<input type="radio" name="confirm" value="No">	No
			<br><br>
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="submit" class="button1" value="Confirmar" name="">
			</form>
			</main>
			HTML;
		}		
	}

	HTMLFooter();
	htmlEnd();
	mysqli_close($db);
?>