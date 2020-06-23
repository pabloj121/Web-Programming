<?php 
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Alta Gestor - Digital Library";
	$disenio = "estilos.css";
	$class = "cabecera";
	$usuario = NULL;

	if (isset($_GET['user'])) {
		$usuario = $_GET['user']; 
	}

	HTMLHeader($titulo,$disenio);
	headerMenu($usuario, "false");

	echo<<<HTML
	<main class="recursos">
	<p> <strong>¿Estás seguro de que deseas borrar este recurso de la Biblioteca Digital "<em>Historia Antigua</em>"?</strong> </p>
	<form action="bd1.php">
	<p><input type="radio" name="respuesta" value="Sí">	Sí</p>
	<p><input type="radio" name="respuesta" value="No" checked="">	No</p>
	<input type="text" name="user" value="$usuario" hidden="true">
	<input type="submit" class="button1" value="Confirmar" name="">
	</form>
	</main>	
	HTML;

	HTMLFooter($usuario);
	htmlEnd();
 ?>
	