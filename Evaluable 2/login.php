<?php
	require 'main_functions.inc';
	require 'credencialesBD.php';

	session_start();

	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
	$check = false;

	if ($db) {
		// Comprobamos estado previo
		if (isset($_POST["user"]) and isset($_POST["password"])) {
			# code...
			$_SESSION["user"] = $_POST["user"];
			$_SESSION["password"] = $_POST["password"];

			$usuarioo = $_POST["user"];
			$contra = $_POST["password"];

			$consulta = mysqli_query($db, "SELECT ALIAS,PASSWORD from USUARIOS WHERE ALIAS='".$_POST["user"]."' and PASSWORD='".$_POST["password"]."'");

			if ($consulta) {
				# code...
				if (mysqli_num_rows($consulta)>0) {
					$check = true; //echo "El usuario existe", PHP_EOL;
				}
			}
			else{
				echo "Error en la consulta", PHP_EOL;
			}

			// Se pregunta a ver si el usuario está registrado. 
			/*
			if ($_POST["user"]=="admin" and $_POST["password"]=="admin") {
				# code...
				//echo "Datos de entrada correctos, ADMIN", PHP_EOL;
				$administrador = true;
			}
			else
				$administrador = false;
			*/
		}
		else if (isset($_POST["logout"])) {
			# code...
			endSesion();
		}

		HTMLHeader("Login - Biblioteca Digital", "biblioteca.css");
		
		if (isset($_SESSION["user"]) and $check==true){ # Si la sesión está establecida
			htmlUserLogueado($_SESSION["user"]);
			//$_SESSION["user"] = $_POST["user"];
		}
		else { # Sesión no establecida
			login();
		}

	}
	else{	// No se ha establecido la conexion con la BD
		return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();
		// Se establece la codificación de los datos almacenados
		mysqli_set_charset($db, "utf8");
		return $db;
	}
	
	mysqli_close($db);
	HTMLFooter();
	htmlEnd();
?>