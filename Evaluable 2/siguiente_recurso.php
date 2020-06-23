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

	Recurso3($usuario);

	HTMLFooter();
	htmlEnd();

	
	function Recurso3($usuario){
		echo<<<HTML
		<main class="contenidos2">	
		<article class="izquierda2">	<!-- Left side -->
		<img class="imagen" src="./imagenes/osiris.jpg">
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
		<textarea class="area2" rows="15">En estas culturas la divinidad es muy importante y se encuentra representada por difentes dioses. Muchos de ellos tienen origen animal, y en muchos casos se le asignan dioses al faraón de cada época. 
		Durante el desarrollo de estas dinastías, se construyeron gran cantidad de pirámides, tumbas y sarcófagos de gran valor que 5000 años después siguen asombrando al mundo entero. 
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