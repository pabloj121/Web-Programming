<?php 
	require 'main_functions.inc';
	require 'credencialesBD.php';
	$titulo = "Alta Gestor - Digital Library";
	$disenio = "gestor.css";
	$class = "cabecera";
	$pagina = 1;
	$usuario = NULL;

	if (isset($_GET['user'])) {
		$usuario = $_GET['user']; 
	}
	if (isset($_POST['user'])) {
		$usuario = $_POST['user']; 
	}
	if (isset($_GET['pagina'])) {
		$pagina = $_GET['pagina']; 
	}
	
	HTMLHeader($titulo,$disenio);
	headerMenu($usuario, "false", $class);

	bodyMatriz($usuario, $pagina);

	HTMLFooter($usuario);
	htmlEnd();
?>