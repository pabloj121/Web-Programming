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
		if (isset($_GET['user'])) {
			$usuario = $_GET['user']; 
		}
		if (isset($_POST['user'])) {
			$usuario = $_POST['user']; 
		}
		if (isset($_GET['id'])) {
			$nombre = $_GET['id']; 
		}


		HTMLHeader($titulo,$disenio);
		headerMenu($usuario, "false");

		bd1Content($usuario);

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


	function bd1Content($usuario){
		echo<<<HTML
		<main class="contenidos">
		<section class="seccion_destacados">
		<h2 class="texto_descriptivo">
		Artículos relacionados con la aparición y progreso de las primeras civilizaciones de las que se tiene constancia que tuvieron escritura: la República y el Imperio romano, Mesopotamia, el antiguo Egipto, Grecia, los pueblos prerromanos de la Península Ibérica… ¡Y mucho más!
		</h2>
		<br>
		<h2 class="texto_descriptivo">Recursos destacados</h2>
		<article class="destacados">
		<aside class="bib_resumen">
		<img class="photo_bib" src="./imagenes/babel2.jpg"  alt="Logo"> 
		<h3 class="bib_title">
		<a href="recursosSeccion1.php?user=$usuario">Mesopotamia </a> 
		<p>
		Primeros Reinos de la Antigüedad
		</p>
		</h3>
		</aside>
		<aside class="bib_resumen">
		<img class="photo_bib" src="./imagenes/egipto.jpg"  alt="Logo"> 
		<h3 class="bib_title">
		<a href="recursosSeccion1.php?user=$usuario">Egipto</a> 
		<!--<a href="recursosSeccion1.php">Egipto</a> -->
		<p>Dinastías faraónicas</p>
		</h3>
		</aside>
		<aside class="bib_resumen">
		<img class="photo_bib" src="./imagenes/peloponeso.svg"  alt="Logo"> 
		<h3 class="bib_title">
		<a href="recursosSeccion1.php?user=$usuario">Guerra del Peloponeso</a>
		<!--<a href="recursosSeccion1.php">Guerra del Peloponeso</a> -->
		<p>Enfrentamiento Atenas-Esparta</p>
		</h3>
		</aside>
		</article>
		</section>
		<section class="info_general"> <!-- Cambiar ID. falta ??  -->
		<article class="texto_descriptivo">		
		<h2>Información general de la colección</h2> 
		<br>
		<p>Número de recursos: 3</p>
		<br>
		<p>Fuentes: 
		<br> <strong>Historia Antigua. II, El mundo clásico </strong>. Historia de Roma.
		Cabrero Piquero, Javier., Fernández Uriel, Pilar.
		Madrid : UNED - Universidad Nacional de Educación a Distancia, 2015 </p>
		<br>
		<p>Autor: Pablo Jesús Jiménez Ortiz</p>
		<br>
		<p>Información adicional: En esta biblioteca usted podrá encontrar información como mapas, textos con uniformes, dibujos, tablas jeroglíficas e imágenes representativas de la época.</p>
		</article>
		<h3 class="subrayado">Secciones</h3>
		<article class="botones">
		<form action="altaseccion.php" method="get">
		<input type="text" name="user" value="$usuario" hidden="true">
		<input type="submit" class="b1" value="Alta" name="">
		</form>
		<form action="editarseccion.php" method="get">
		<input type="text" name="user" value="$usuario" hidden="true">
		<input type="submit" class="b3" value="Edición" name="">
		</form>
		<form action="borrarseccion.php" method="get">
		<input type="text" name="user" value="$usuario" hidden="true">
		<input type="submit" class="b2" value="Baja" name="">
		</form>
		</article>
		<h3 class="subrayado">Recursos</h3>
		<article class="botones">
		<form action="altarecurso.php" method="get">
		<input type="text" name="user" value="$usuario" hidden="true">
		<input type="submit" class="b1" value="Alta" name="">
		</form>
		<form action="editarrecurso.php" method="get">
		<input type="text" name="user" value="$usuario" hidden="true">
		<input type="submit" class="b3" value="Edición" name="">
		</form>
		<form action="borrarrecurso.php" method="get">
		<input type="text" name="user" value="$usuario" hidden="true">
		<input type="submit" class="b2" value="Baja" name="">
		</form>
		</article>
		</section>
		</main>
		HTML;
	}


?>