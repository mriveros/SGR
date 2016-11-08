<?php 
	session_start(); 
	session_destroy(); 
	header("Location:http://aplicaciones.intn.gov.py/SGR/login/acceso.html");  
?>