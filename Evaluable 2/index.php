<?php
	require 'main_functions.inc';
	$titulo = "Digital Library";
	$disenio = "biblioteca.css";
	HTMLHeader($titulo,$disenio);
	// HTMLHeader($titulo,"biblioteca");

	HTMLBodyIndex($user="");
	HTMLFooter();
	HTMLEnd();
?>