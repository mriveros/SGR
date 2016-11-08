<?php
session_start();
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Estaciones ONM INTN
 */

 include '../web/funciones.php';
 conexionlocal();
$usr= $_REQUEST['username'];
$pwd=md5($_REQUEST['clave']);
$sql= "SELECT * FROM usuarios usu,encargado en 
    WHERE usu.usu_username = '$usr'
    and usu.usu_pass =('$pwd')
    and usu.usu_estado='t'
    and usu.usu_cod=en.usu_cod" ;
$datosusr = pg_query($sql);
$row = pg_fetch_array($datosusr);
$n=0;
$n = count($row['usu_nom']);
if($n==0)
    {
        echo '<script type="text/javascript">
        alert("Nombre de Usuario o Password no valido..!");
        window.location="http://192.168.0.99/SGR/login/acceso.html";
        </script>';
    }
    else
    {
        $_SESSION["username"] = $row['usu_username'];
        $_SESSION["nombre_usuario"] = $row['usu_nom'];
        $_SESSION["codigo_usuario"] = $row['usu_cod'];
        $_SESSION["codigo_encargado"] = $row['en_cod'];
        $_SESSION["codigo_departamento"] = $row['depar_cod'];
        $_SESSION["categoria_usuario"]=$row['cat_cod'];
        if ($row['cat_cod']==1){
            header("Location:http://192.168.0.99/SGR/web/menu_principal.php");
        }else if($row['cat_cod']==2){
            header("Location:http://192.168.0.99/SGR/web/menu_supervisor.php");
        }else if($row['cat_cod']==3){
            header("Location:http://192.168.0.99/SGR/web/menu_supervisor.php");
        }
    }
