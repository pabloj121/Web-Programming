<?php 
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Alta Gestor - Digital Library";
	$disenio = "estilos.css";
	$class = "cabecera";
	$usuario = NULL;

	if (isset($_GET['user'])) {
		# code...
		$usuario = $_GET['user']; 
	}

	HTMLHeader($titulo,$disenio);
	headerMenu($usuario, "false");

	echo<<<HTML
	<main class="contenidos">
	<section class="imagen"> 	<!-- Left side -->
	<img src="./imagenes/index2.jpg" alt="Logo2">
	</section>
	<section class="data_contact"> <!-- Right side -->
	<h1 class="datacontact">Datos de contacto</h1>
	<h3>Correo electrónico: <a class="link" href = "mailto: pabloj121@correo.ugr.es">pabloj121@correo.ugr.es</a></h3>
	</section>
	</main>
	HTML;

	HTMLFooter();
	htmlEnd();
 ?>