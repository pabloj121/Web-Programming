<?php 
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Digital Library";
	$disenio = "estilos.css";
	$usuario = NULL;
	HTMLHeader($titulo,$disenio);

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
	
	session_start();

	
	if ($db) {
		if (isset($_POST['user'])) {
			$usuario = $_POST['user'];
			$_SESSION["user"] = $_POST["user"]; 
		}
		if (isset($_GET['user'])) {
			$usuario = $_GET['user'];
			$_SESSION["user"] = $_GET["user"]; 
		}
	}
	else{	// No se ha establecido la conexion con la BD
		return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
		// Se establece la codificación de los datos almacenados
		mysqli_set_charset($db, "utf8");
		return $db;
	}

	bodyGestor($usuario, $db);
	HTMLFooter($usuario);
	HTMLEnd();
	//endSession();
	mysqli_close($db);

	function bodyGestor($usuario, $db){
		echo<<<HTML
		<header class="cabecera">
		<img src="./imagenes/logo.png"  alt="Logo">  
		<h1 class="brand_name"> Digital library  </h1>
		<section class="formulario">
		Bienvenido 
		<input class="username" type="text" name="password" value="$usuario">
		<br>
		<article class="botones">
		<form action="modificarGestor.php" method="post">
		<input type="submit" class="b6" value="Edición" name="editar">
		<input class="username" type="text" name="user" value="$usuario" hidden="true">
		</form>
		<form action="borrargestor.php" method="post">
		<input type="submit" class="b6" value="Baja" name="eliminar">
		<input type="text" name="user" value="$usuario" hidden="true">
		</form>
		<form action="index.php" method="post">
		<input type="submit" class="b6" value="Logout" name="logout">
		</form>
		</article>	
		</section>
		</header>
		<main class="contenidos">
		<section class="contenido_izquierda"> 	<!-- Left side -->
		<form action="crearBiblioteca.php" method="post">
		<input type="submit" class="b4" value="Crear biblioteca digital" name="crear">
		<input type="text" name="user" value="$usuario" hidden="true">
		</form>
		</section>
		<section class="bib_alta">	<!-- Left side -->
		<h2>Bibliotecas dadas de alta</h2>
		HTML;

		imprimeBibliotecas($usuario, $db);
		echo<<<HTML
		</main>
		HTML;
	}

	function imprimeBibliotecas($usuario, $db){
		// Consulta todas las bibliotecas disponibles y las muestra en el menu lateral
		$sql = "SELECT * FROM BIBLIOTECAS";

		$resultado = mysqli_query($db, $sql);
		// Recorremos cada biblioteca e imprimimos imagen - titulo
		while ($iter = mysqli_fetch_assoc($resultado)) {
			$id = $iter['IDBIBLIOTECA'];
			$nombre = $iter['NOMBRE'];
			$autor = $iter['AUTOR'];
			$descripcion = $iter['DESCRIPCION'];
			$imagen = $iter['RUTAIMAGEN'];
			echo<<<HTML
			<article class="bib_resumen">
			<img class="photo_bib" src="./imagenes/index2.jpeg"  alt="Logo"> 
			HTML;
			echo<<<HTML
			<h3 class="bib_title">
			<a href="bd1.php?user=$usuario&id=$id">
			HTML;
			echo $iter['NOMBRE'];
			echo<<<HTML
			</a>
			<br>
			<form action="editarBiblioteca.php" method="post">
			<input type="text" name="id" value="$id" hidden="true">
			<input type="text" name="nombre" value="$nombre" hidden="true">
			<input type="text" name="autor" value="$autor" hidden="true">
			<input type="text" name="descripcion" value="$descripcion" hidden="true">
			<input type="text" name="imagen" value="$imagen" hidden="true">
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="number" name="registro" value="1" hidden="true">
			<input type="submit" class="b6" value="Editar biblioteca digital" name="Editar">			
			</form>
			<form action="borrarBiblioteca.php" method="post">
			<input type="text" name="id" value="$id" hidden="true">
			<input type="text" name="user" value="$usuario" hidden="true">
			<input type="text" name="nombre" value="$nombre" hidden="true">
			<input type="submit" class="b5" value="Borrar biblioteca digital" name="Borrar">
			</form>
			</h3>
			</article>
			HTML;
 		}
	}
?>