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
	<!-- Imagen representativa del recurso. falta?  -->
	<!--<img  class= "img_recurso" src="logo.png"  alt="Logo">-->
	<h2 class="texto_descriptivo">A continuación, introduzca los datos del recurso</h2>
	<article class="formulario3">
	<form action="bd1.php" method="post">
	<h3>
	<label for="img_recurso">Ficheros a subir</label>
	<input type="file" class="recurso" name="archivos_subidos[]" multiple="" accept="image/png, .jpeg, .jpg, image/gif, application/pdf, .doc, .docx, .odf">
	</h3>
	<h3>
	<label for="nombre">Título: 	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
	<input type="text" class="nombre" name="">
	</h3>
	<h3>
	<label for="author">Autor: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
	<input type="text" class="author" name="autor">
	</h3>
	<h3>
	<label for="section">Sección: &nbsp&nbsp&nbsp</label>
	<select class="section">
	<option value="1">Libros</option>
	<option value="2">Revistas</option>
	<option value="3">Música</option>
	</select>
	<!--<input type="text" class="section" name="seccion">  -->
	</h3>
	<h3>
	<label for="type">Tipo: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
	<select class="type">
	<option value="1">Documento</option>
	<option value="2">Imagen</option>
	<option value="3">Audio</option>
	</select>
	<!-- <input type="text" class="type" name="tipo"> -->
	</h3>
	<h3>
	<label for="meta1">Metadato 1: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
	<input type="text" class="meta1" name="metadato1">
	</h3>
	<h3>
	<label for="son">Metadato 2: &nbsp&nbsp&nbsp&nbsp</label>
	<input type="text" class="son" name="hijo">
	</h3>
	<h3><label for="fecha">Fecha: 	&nbsp&nbsp</label>
	<input type="date" class="fecha" name="fechaa">
	</h3>
	<br><br>
	<h2 class="clear">&nbsp&nbspDescripción</h2>
	<textarea class="area"  rows="12" placeholder="Escribe una descripción para el recurso"></textarea> 
	<br>
	<p class="botones_separados">
	<input type="text" name="user" value="$usuario" hidden="true">
	<input type="submit" class="enviar" value="Enviar" name="enviar">	
	</p>
	</form>
	</article>
	</main>	
	HTML;

	HTMLFooter($usuario);
	htmlEnd();
 ?>
	