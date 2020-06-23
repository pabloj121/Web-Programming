<?php  
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Alta Gestor - Digital Library";
	$disenio = "estilos.css";
	$class = "cabecera";
	$usuario = NULL;
	
	if (isset($_GET['recurso'])) {
		$recurso = $_GET['recurso'];
	}
	if (isset($_GET['user'])) {
		$usuario = $_GET['user'];
	}


	HTMLHeader($titulo,$disenio);
	headerMenu($usuario, "false");

	Recurso1($usuario);

	HTMLFooter();
	htmlEnd();


	function Recurso1($usuario){
		echo<<<HTML
		<main class="contenidos2">	
		<article class="izquierda2">	<!-- Left side -->
		<img class="imagen" src="./imagenes/peloponeso.png">
		</article>
		<article class="formulario4"> 	<!-- Right side -->
		<h3><label for="nombre">Título: 	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<input type="text" class="nombre" name=""value="Guerra del Peloponeso">
		</h3>
		<h3>
		<label for="author">Autor: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<input type="text" class="author" name="autor" value="Pablo Jiménez">
		</h3>
		<h3>
		<label for="section">Sección: &nbsp&nbsp&nbsp</label>
		<input type="text" class="section" name="seccion" value="Historia">
		</h3>
		<h3>
		<label for="type">Tipo: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<input type="text" class="type" name="tipo" value="Artículo">
		</h3>
		<h3>
		<label for="date">Fecha: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<input type="text" class="date" name="fecha" value="1 Mayo 2020">
		</h3>
		</article>
		<section class="texto_recurso2">
		<h2>Descripción</h2>
		<textarea class="area2" rows="10">Fue el enfrentamiento definitivo entre Atenas y su Liga de Delos contra Esparta y sus aliados. Dio lugar a una de las guerras más importantes de la Historia Antigua de Grecia, suponiendo un enfrentamiento que dio lugar a la desaparición de la democracía radical ateniense y triunfando la tiranía de Esparta sobre Atenas.
		</textarea>
		<br>
		<p class="botones_separados">
		<a href="recurso_anterior.php?user=$usuario">Anterior</a>
		<a href="siguiente_recurso.php?user=$usuario">Siguiente</a>
		</p>
		</section>
		</main>
		HTML;
	}
?>