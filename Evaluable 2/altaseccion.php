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
	<section class="recursos">
	<form class="formulario3" action="bd1.php" method="post" enctype="multipart/form-data" target="blank">
	<h2 class="subrayado">Introduzca los siguientes datos de la sección a crear</h2>
	<h2>
	<label for="nombre">Título 	&nbsp&nbsp&nbsp</label>
	<input type="text" class="nombre" name="">
	</h2>
	<h2>
	<label for="texto">Tipo &nbsp&nbsp&nbsp&nbsp&nbsp</label>
	<input type="text" class="texto" name="">
	</h2>
	<h2>
	<label for="autor">Autor    	 	&nbsp&nbsp&nbsp</label>
	<input type="text" class="autor" name="">
	</h2>
	<h2>
	<label for="texto">Fecha &nbsp&nbsp</label>
	<input type="date" class="texto" name="">
	</h2>
	<br>
	<h2 class="texto">
	Sube ficheros a la biblioteca digital. Podrás colgar imágenes en formato 
	PNG, JPEG, JPG, GIF así como PDF o .doc, incluso audio. <strong>¡Pruébalo!</strong>
	</h2>
	<br>
	<h2>
	<label for="recurso">Ficheros a subir</label>
	<input type="file" class="recurso" name="archivos_subidos[]" multiple="" accept="image/png, .jpeg, .jpg, image/gif, application/pdf, .doc, .docx, .odf">
	</h2>
	<br>
	<input type="text" name="user" value="$usuario" hidden="true">
	<input type="submit" class="b4" value="Dar de alta" name="crear">	
	</form>
	</section>
	HTML;


	HTMLFooter($usuario);
	htmlEnd();
 ?>