<?php  
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Alta Gestor - Digital Library";
	$disenio = "estilos.css";
	$class = "cabecera";
	$check = false;
	$confirmaciones = 0;
	$usuario = NULL;
	$nombre_repetido = false;
	$nombre = $consulta = $id = NULL;
	$nombre_inicial = NULL;
	$imagen_subida = false;
	$existe = false;
	$cambio = false;


	session_start();

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);

	if ($db) {
		// Comprobamos si se han recibido los parámetros
		
		if (isset($_POST['user'])) {
			$usuario = $_POST['user']; 
		}
		
		if (isset($_POST['autor'])) {
			$confirmaciones+=1;
			$autor = $_POST['autor']; 
		}
		
		if (isset($_POST['descripcion'])) {
			$confirmaciones+=1;
			$descripcion = $_POST['descripcion']; 
		}
		
		if (isset($_POST['id'])) {
			$id = $_POST['id']; 
		}
		
		if (isset($_POST['imagen'])) {
			$imagen = $_POST['imagen']; 
		}
		
		if (isset($_POST['registro'])) {
			$registro = $_POST['registro']; 

			if ($registro == 2 or $registro == "2") {
				$cambio = true;
			}
		}
		
		if (isset($_POST['nombre'])) {
			$confirmaciones+=1;

			if ($nombre == NULL) {
				$nombre = $nombre_inicial = $_POST['nombre'];
			}

			if ($_POST['nombre'] != $nombre_inicial) {
				echo "El usuario quiere cambiar el nombre de la biblioteca", PHP_EOL;
				//$usuario = $_POST['user'];
				$nombre_cambiado = true;
			}
			$nombre = $_POST['nombre']; 


			$consulta = mysqli_query($db, "SELECT * FROM BIBLIOTECAS WHERE NOMBRE='$nombre'");
			if ($consulta) {
				# code...
				$existe = true;
			}
			else{
				$existe = false;
			}
		}		

		HTMLHeader($titulo,$disenio);
		headerMenu($usuario, "false");
		
		$iter = mysqli_fetch_assoc($consulta);
		
		// Existe biblioteca con el nombre obtenido
		if($existe == true){
			// Se ha pulsado el botón Editar biblioteca al menos una vez
			if ($cambio == true) { // Se realiza la modificación
				bodyModificacion($usuario, $cambio, false, $iter);				
				$consulta = mysqli_query($db, "UPDATE BIBLIOTECAS SET NOMBRE='$nombre', AUTOR='$autor', 
					DESCRIPCION='$descripcion' WHERE IDBIBLIOTECA='$id'");

				if ($consulta) {
					$check = true;
				}
				else{
					$check = false;
				}
			}
			else{
				bodyModificacion($usuario, $cambio, false, $iter);
			}
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

	function bodyModificacion($usuario="", $confirmacion, $nombre_repetido, $fila){
		$nombre = $fila['NOMBRE'];
		$autor = $fila['AUTOR'];
		$descripcion = $fila['DESCRIPCION'];
		$id = $fila['IDBIBLIOTECA'];
		
		if ($confirmacion == true) {
			echo<<<HTML
			<main class="recursos">
			<form action="gestorbd.php" method="post" class="formulario">
			<p> La biblioteca ha sido modificada.</p>
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="submit" value="Inicio" name="inicio">
			</form>
			</main>
			HTML;
		}
		else{
			echo<<<HTML
			<main class="recursos"> 	<!-- Aquellas páginas cuyo main tenga una sola sección -->
			<h2><u>Por favor, introduzca los datos. Todos los campos son obligatorios.</u></h2>
			<form class="formulario3" action="editarBiblioteca.php" method="post" enctype="multipart/form-data" target="blank" onsubmit="return validarBiblioteca()">
			HTML;
			if ($nombre_repetido==true) {
				echo<<<HTML
				<strong style="color:#FF0000">Ya existe otra biblioteca con ese nombre. Pruebe de nuevo.  </strong>
				<br>
				HTML;
			}
			echo<<<HTML
			<h2><label for="nombre">Nombre 	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<input type="text" class="nombre" name="nombre" id="nombre" value="$nombre">
			</h2>
			<h2>
			<label for="autor">Autor &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<input type="text" class="autor" name="autor" id="autor" value="$autor">
			</h2>
			<br>
			<h2>
			<label for="texto">Texto descriptivo &nbsp</label>
			<br>		
			<textarea rows="12" cols="50" name="descripcion" id="descripcion" value="$descripcion">$descripcion</textarea>
			</h2>
			<br>
			<hr>
			<h2>
			Sube ficheros a la biblioteca digital. Podrás colgar imágenes en formato 
			<br>PNG, JPEG, JPG, GIF así como PDF o .doc, incluso audio. <strong>¡Pruébalo!</strong>
			</h2>
			<h2>
			<label for="recurso">Ficheros a subir</label>
			<input type="file" class="recurso" name="imagen" multiple="" accept="image/png, .jpeg, .jpg, image/gif, application/pdf, .doc, .docx, .odf" id="imagen">
			</h2>
			<br>
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="text" name="id" value="$id" hidden="true">
			<input type="number" name="registro" value="2" hidden="true">
			<input type="submit" class="b4" value="Editar biblioteca digital" name="crear">
			</form>
			HTML;
		}
		
	}
?>