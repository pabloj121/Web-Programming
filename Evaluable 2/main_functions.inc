<?php
/* 	Este archivo contiene las principales funciones que se usaran de 
	manera reiterada en toda la página Web */

	function HTMLHeader($titulo, $disenio, $class=""){
		echo <<< HTML
		<!DOCTYPE html>
		<html lang="es">
		<head>
		<title>Gestor de bibliotecas digitales</title>
		<meta charset="utf-8">
		<!-- ajustar el ancho al tamaño físico de la pantalla -->
		<meta name="viewport" content="width=device-width"> 
		<link rel="stylesheet" type="text/css" href="./disenio/$disenio">
		<meta name="author" content="Pablo Jesus Jimenez Ortiz">
		<meta name="Descripcion" content="Programacion Web - Practica 1">
		<meta name="Application-Name" content="Digital Library">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Last-Modified" content="0">
		<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<script type="text/javascript" src="validarFormularios.js"></script>
		</head>
		<body>
		<!--<header class=".$class.">-->
		HTML;
	}


	function showMenu(){
		echo <<<HTML
		<!--<header>-->	
		<br>
		<nav class="menuCSS3">
		<ul>
		<li><a href="index.php">Inicio</a></li>
		<li><a href="bd1.php">Historia</a>
		<ul>
		<li><a href="recursosSeccion1.php?user=$usuario">Historia Antigua</a></li>
		</ul>
		</li>
		<li><a href="recursosSeccion1.php?user=$usuario">Revistas</a>
		<ul>
		<li><a href="bd1.php">Revista del Motor</a></li>
		<li><a href="bd1.php">Revista Ciencia</a></li>
		</ul>
		</li>
		<li><a href="recursosSeccion1.php?user=$usuario">Musica</a>
		<ul>
		<li><a href="bd1.html">Albúm 1</a></li>
		</ul>
		</li>
		</ul>
		</nav>
		</header>
		HTML;
	}

	function headerMenu($usuario="", $mostrar_formulario="true", $class=""){
		echo <<<HTML
		<!--<header>-->
		<header class="$class">
		<img src="./imagenes/logo.png"  alt="Logo">
		<h1 class="brand_name"> Digital library  </h1>
		HTML;
		if ($mostrar_formulario==true) {
			echo<<<HTML
			<form action="index.php" method="post" class="formulario" onsubmit="return validaLogin()">
			<label>Hola
			<input type="text" name="user" value="$usuario" readonly>
			</label>
			<input type="submit" value="Logout" name="logout">
			</form>
			<br>
			<nav class="menuCSS3">
			<ul>
			<li><a href="gestorbd.php?user=$usuario">Inicio</a></li>
			<li><a href="bd1.php?user=$usuario">Historia</a>
			<ul>
			<li><a href="recursosSeccion1.php?user=$usuario">Historia Antigua</a></li>
			</ul>
			</li>
			<li><a href="recursosSeccion1.php?user=$usuario">Revistas</a>
			<ul>
			<li><a href="bd1.php?user=$usuario">Revista del Motor</a></li>
			<li><a href="bd1.php?user=$usuario">Revista Ciencia</a></li>
			</ul>
			</li>
			<li><a href="recursosSeccion1.php?user=$usuario">Musica</a>
			<ul>
			<li><a href="bd1.php?user=$usuario">Albúm 1</a></li>
			</ul>
			</li>
			</ul>
			</nav>
			</header>
			HTML;
		}
	}


	function HTMLBodyIndex($user){ // $variable va a ser indicativa de la página de la que 
								  // se va a mostrar el body
		echo <<< HTML
		<header>
		<img src="./imagenes/logo.png"  alt="Logo">  
		<h1 class="brand_name"> Digital library  </h1>
		<form action="login.php" method="post" class="formulario" onsubmit="return validaLogin()">
			Usuario 
			<input type="text" name="user" value="$user" id="user">
			Contraseña
			<input type="text" name="password" value="" id="password">	
			<input type="submit" value="Entrar" name="entrar">	
		</form>
		<form action="registro.php" method="post" class="formulario">
			<input type="submit" name="crear cuenta" value="Regístrate">
		</form>
		</header>
		<main class="contenidos">	
		<section class="izquierda">	<!-- Left side -->
			<img class="imagen" src="./imagenes/index2.jpg" alt="Logo2">
		</section>
		<section class="bib_alta"> 	<!-- Right side -->
		<h2>Bibliotecas dadas de alta</h2>
		<article class="bib_resumen">
			<img class="photo_bib" src="./imagenes/parthenon.jpg"  alt="Logo"> 
			<h2 class="bib_title"><br><a href="bd1.html"> Historia Antigua</a></h2>				
		</article>
		<article class="bib_resumen">
			<img class="photo_bib" src="./imagenes/revistacoches.jpg"  alt="Logo">  
			<h2 class="bib_title"><br><a href="bd1.html"> Automovilismo</a></h2>				
		</article>
		<article class="bib_resumen">
			<img class="photo_bib" src="./imagenes/musica80.jpg"  alt="Logo"> 
			<h2 class="bib_title"><br><a href="bd1.html"> 80's Music</a></h2>				
		</article>
		</section>
		</main>
		HTML;
	}


	function login(){
		//echo "Datos erróneos. Vuelva a introducirlos.";
		echo <<<HTML
		<header>
		<img src="./imagenes/logo.png"  alt="Logo">
		<h1 class="brand_name"> Digital library  </h1>
		</header>
		<body>
		<form action="login.php" method="post" class="formulario" onsubmit="return validaLogin()">
		<p>Datos erróneos. Vuelva a introducirlos.</p>
		<label>Usuario 
		<input type="text" name="user" value="" id="user">
		</label>
		<label>Contraseña
		<input type="text" name="password" value="" id="password">	
		</label>
		<br>
		<input type="submit" value="Login" name="login">
		</form>
		<form action="index.php" method="post" class="formulario"><input type="submit" value="Inicio" name="inicio">
		</form>
		HTML;
	}

	function htmlUserLogueado($usuario){
		//<form action="gestorbd.php" method="post" class="formulario">
		echo <<< HTML
		<header>
		<img src="./imagenes/logo.png"  alt="Logo">
		<h1 class="brand_name"> Digital library  </h1>
		<form action="index.php" method="post" class="formulario">
		<label>Hola
		<input type="text" name="user" value="$usuario" readonly>
		</label>
		<input type="submit" value="Logout" name="logout">	
		<!--<a href="gestorbd.php"><input type="submit" value="Entrar" name="entrar"></a>-->
		</form>
		</header>
		<body>
		<br>
		<form action="gestorbd.php" method="post" class="formulario">
			<br>			
			<h2>Bienvenido. ¡Descubra lo último de Digital Library!</h2>
			<input type="submit" value="Entrar" name="login">
			<input type="text" name="user" value="$usuario" hidden="true">	
		</form>
		<br>
		HTML;
	}


	// Funcion que imprime los recursos de una seccion en forma de matriz 3x3
	function bodyMatriz($usuario, $pagina){
		echo<<<HTML
		<main class="recursos">
		<section class="container">
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso1.php?user=$usuario">Guerra Peloponeso</a> 
		<p>Enfrentamiento Atenas-Esparta </p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso2.php?user=$usuario">Mesopotamia</a> 
		<p>Primeros Reinos</p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso3.php?user=$usuario">Egipto</a> 
		<p>Dinastías faraónicas</p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso1.php?user=$usuario">Guerras Médicas</a> 
		<p>Enfrentamiento griegos-persas </p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso2.php?user=$usuario">Guerra de Troya</a> 
		<p>Aqueos contra troyanos</p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso3.php?user=$usuario">Arquitecto Imhotep</a> 
		<p>Biografía del arquitecto</p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso1.php?user=$usuario">Rey Salomón</a> 
		<p>Uno de los primeros Reyes del reino judío</p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso2.php?user=$usuario">Democracía ateniense</a> 
		<p>Democracía radical, inicios</p>
		</h3>
		</aside>
		</article>
		<article class="box">
		<aside class="bib_resumen"> 
		<h3 class="bib_title">
		<a href="recurso3.php?user=$usuario">Tutankamon</a> 
		<p>Mito y realidad</p>
		</h3>
		</aside>
		</article>
		</section>  
		<!-- La clase active la usaremos para dar un
		estilo especial y que el usuario sepa en
		en qué pagina se encuentra-->
		<section class="paginacion">
		<ul>
		HTML;

		if ($pagina == 1) {
			# code...
			echo<<<HTML
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=$pagina" class="active">1</a></li>
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=2">2</a></li>
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=3">3</a></li>
			HTML;
		}
		else if ($pagina == 2) {
			# code...
			echo<<<HTML
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=1">1</a></li>
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=$pagina" class="active">2</a></li>
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=3">3</a></li>
			HTML;
		}
		else if ($pagina == 3) {
			# code...
			echo<<<HTML
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=1">1</a></li>
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=2">2</a></li>
			<li><a href="recursosSeccion1.php?user=$usuario&pagina=$pagina" class="active">3</a></li>
			HTML;
		}
		echo<<<HTML
		</ul>
		</section>
		</main>
		HTML;
	}


	function Recursos($usuario, $recurso){
		echo<<<HTML

		HTML;
	}




	// La función contiene el footer (genérico en toda la página Web y el cierre del documento)
	function HTMLFooter($usuario=""){
		echo<<<HTML
		<footer>
			<h2><a href = "contacto.php?user=$usuario">Contacto</a></h2>
			<h2>&nbsp - &nbsp</h2>
			<h2>
				<a class="link" href = "como_se_hizo.pdf"> Cómo se hizo</a>
			</h2>
		</footer>
		HTML;
	}


	function htmlEnd(){
		echo "</body></html>";
	}

	// GESTION DE LAS SESIONES
	function endSession(){
		// La sesión debe estar iniciada
		if (session_status()==PHP_SESSION_NONE) {
			# code...
			session_start();
		}

		// Borrar variables de sesión
		session_unset();

		// Parametros de cookie de sesión
		$parametros = session_get_cookie_params();

		// Borrar cookie de sesión
		setcookie(session_name(), $_COOKIE[session_name()], time() - 3000000, $parametros['path'], $parametros['domain'], $parametros['secure'], $parametros['httponly']);

		// Destuir sesión
		session_destroy();
	}

?>