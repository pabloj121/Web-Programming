<?php  
	require 'main_functions.inc';
	require 'credencialesBD.php';
	
	$titulo = "Borrar Gestor - Digital Library";
	$disenio = "estilos.css";
	$usuario = NULL;
	$id = NULL;
	$nombre = NULL;
	$confirmacion = NULL;
	
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
	
	if ($db) {
		if (isset($_POST['id'])){	// ID de la biblioteca a borrar
			$id = $_POST['id'];
		}
		if (isset($_POST['nombre'])){	// ID de la biblioteca a borrar
			$nombre = $_POST['nombre'];
		}
		if (isset($_POST['user'])){	// Usuario que borrar la biblioteca
			$usuario = $_POST['user'];
			$_SESSION["user"] = $_POST["user"];

			if(isset($_POST['confirm'])){
				$confirmacion = $_POST['confirm'];
			}
		}
		else if (isset($_POST["logout"])) {
			endSesion();
		}

		HTMLHeader($titulo, $disenio);
		headerMenu($usuario);

		// Se comprueba si el usuario ha dado respuesta y que se ha podido borrar realmente del servidor
		if(isset($_POST['confirm']) and $_POST['confirm']=="Sí"){ // Confirmación de borrado
			// Realizar consulta
			$consulta = mysqli_query($db, "DELETE FROM BIBLIOTECAS WHERE NOMBRE ='$nombre'");

			if ($consulta) { // La orden SQL ha ido bien
				$check = true;
				bodyBorrar("Sí", $usuario, $nombre, $id);
			}
			else{
				echo "Error en la consulta", PHP_EOL;
			}
		}
		else{
			bodyBorrar("No", $usuario, $nombre, $id);
		}
	} 
	else{ // No se ha establecido la conexion con la BD
		return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
		// Se establece la codificación de los datos almacenados
		mysqli_set_charset($db, "utf8");
		return $db;
	}

	// showBody
	function bodyBorrar($confirmacion, $usuario, $nombre, $id){
		if ($confirmacion=="Sí") {
			echo<<<HTML
			<main class="recursos">
			<p> La biblioteca de nombre <strong>$nombre</strong> ha sido eliminada del sistema.</p>
			<form action="gestorbd.php" method="post" class="formulario">
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="text" name="nombre" value="$nombre" hidden="true">
			<input type="text" name="id" value="$id" hidden="true">
			<input type="submit" name="index" value="Continuar">
			</form>
			</main>
			HTML;
		}
		else if($confirmacion=="No"){
			echo<<<HTML
			<main class="recursos">
			<p> <strong>¿Está seguro que desea borrar la biblioteca?</strong> </p>
			<form action="borrarBiblioteca.php" method="post">
			<input type="radio" name="confirm" value="Sí" checked="">	Sí
			<br><br>
			<input type="radio" name="confirm" value="No">	No
			<br><br>
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="text" name="nombre" value="$nombre" hidden="true">
			<input type="text" name="id" value="$id" hidden="true">
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