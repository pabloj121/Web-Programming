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
	$imagen_subida = false;

	session_start();

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);

	if ($db) {
		// Comprobamos si se han recibido los parámetros
		if (isset($_POST['user'])) {
			$usuario = $_POST['user']; 
		}
		if (isset($_POST['nombre'])) {
			$confirmaciones+=1;
			$nombre = $_POST['nombre']; 
		}
		if (isset($_POST['autor'])) {
			$confirmaciones+=1;
			$fecha = $_POST['autor']; 
		}
		if (isset($_POST['descripcion'])) {
			$confirmaciones+=1;
			$descripcion = $_POST['descripcion']; 
		}

		if ($confirmaciones == 3) {	// Los campos obligatorios están rellenos
			
			// Comprobamos que no hay otro usuario con el mismo alias
			$consulta = mysqli_query($db, "SELECT COUNT(*) FROM BIBLIOTECAS WHERE NOMBRE='".$_POST["nombre"]."'");
			
			$num = mysqli_fetch_row($consulta)[0];
			mysqli_free_result($consulta);

			if ($num > 0) { // Ya existe otra biblioteca con ese nombre
				$nombre_repetido = true;
			}
			else{

				// Control subida de imagen
				$nombre_img = $_FILES['imagen']['name'];
				$tipo = $_FILES['imagen']['type'];
				$tamano = $_FILES['imagen']['size'];
			
				if ($nombre_img != NULL) {
					// Se indican los formatos permitidos
					if ((	$_FILES["imagen"]["type"] == "image/gif")
					   || 	($_FILES["imagen"]["type"] == "image/jpeg")
					   || 	($_FILES["imagen"]["type"] == "image/jpg")
					   || 	($_FILES["imagen"]["type"] == "image/png"))
					{
					      // Ruta donde se guardarán las imágenes que subamos
					      $directorio = './imagenes/'; 
					      // Se mueve la imagen desde el directorio temporal a la ruta indicada
					      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
					      $imagen_subida = true;
					}
					else
					{
				        echo "No se puede subir una imagen con ese formato ";
				    }
				}

				if ($imagen_subida== true) {
					$consulta = mysqli_query($db, "INSERT INTO BIBLIOTECAS (NOMBRE, AUTOR, 
						DESCRIPCION, RUTAIMAGEN) 
						VALUES ('".$_POST["nombre"]."','".$_POST["autor"]."',
						'".$_POST["descripcion"]."','$nombre_img')");

					if($consulta){ // Nuevo usuario añadido
						$check = true;
					}
				}
				else{

					$consulta = mysqli_query($db, "INSERT INTO BIBLIOTECAS (NOMBRE, AUTOR, DESCRIPCION) 
					VALUES ('".$_POST["nombre"]."','".$_POST["autor"]."',
					'".$_POST["descripcion"]."') ");

					if($consulta){ // Nuevo usuario añadido
						$check = true;
					}
				}
			}
		}
		
		// Se validan los datos con JavaScript y con la BD
		HTMLHeader($titulo,$disenio);
		headerMenu($usuario, "false");
		bodyCreacion($usuario, $check, $nombre_repetido);
	}
	else{
		return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
		// Se establece la codificación de los datos almacenados
		mysqli_set_charset($db, "utf8");
		return $db;
	}

	HTMLFooter($usuario);
	htmlEnd();

	mysqli_close($db);
	// endSession();

	function bodyCreacion($usuario="", $confirmacion, $nombre_repetido){
		if ($confirmacion == true) {
			echo<<<HTML
			<main class="recursos">
			<form action="gestorbd.php" method="post" class="formulario">
			<p> Nueva biblioteca añadida.</p>
			<input type="text" name="user" value="$usuario" hidden="true">
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
			<form class="formulario3" action="crearBiblioteca.php" method="post" enctype="multipart/form-data" target="blank" onsubmit="return validarBiblioteca()">
			HTML;
			if ($nombre_repetido==true) {
				echo<<<HTML
				<strong style="color:#FF0000">Ya existe otra biblioteca con ese nombre. Pruebe de nuevo.  </strong>
				<br>
				HTML;
			}
			echo<<<HTML
			<h2><label for="nombre">Nombre 	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<input type="text" class="nombre" name="nombre" id="nombre">
			</h2>
			<h2>
			<label for="autor">Autor &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
			<input type="text" class="autor" name="autor" id="autor">
			</h2>
			<br>
			<h2>
			<label for="texto">Texto descriptivo &nbsp</label>
			<br>		
			<textarea rows="12" cols="50" name="descripcion" id="descripcion"></textarea>
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
			<input type="submit" class="b4" value="Crear biblioteca digital" name="crear">
			<input type="text" name="user" value="$usuario" hidden="true">
			</form>
			HTML;
		}
		
	}
?>