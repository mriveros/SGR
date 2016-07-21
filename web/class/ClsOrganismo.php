<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Compras y Pagos SGR INTN
 */
session_start();
$codusuario=  $_SESSION["codigo_usuario"];

include '../funciones.php';
conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtDescripcionA'])){$descripcionA='';}else{ $descripcionA= $_POST['txtDescripcionA'];}
    
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtDescripcionM'])){$descripcionM='';}else{ $descripcionM= $_POST['txtDescripcionM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($descripcionA, 'organismo', 'org_desc')==true){
                echo '<script type="text/javascript">
		alert("El Organismo ya existe. Ingrese otro Organismo.");
                window.location="http://localhost/SGR/web/organismos/ABMorganismo.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO organismo(org_desc,org_estado) VALUES ('$descripcionA','t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el Organismo. Err(108):'.$query.'");
                window.location="http://localhost/SGR/web/usuarios/ABMorganismo.php";
		</script>');
                $query = '';
                header("Refresh:0; url=http://localhost/SGR/web/organismos/ABMorganismo.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            $query = "update organismo set org_desc='$descripcionM',org_estado='$estadoM' WHERE org_cod=$codigoModif";
            $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el Organismo. Err(108):'.$query.'");
                window.location="http://localhost/SGR/web/usuarios/ABMorganismo.php";
		</script>');
            header("Refresh:0; url=http://localhost/SGR/web/organismos/ABMorganismo.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update organismo set org_estado='f' WHERE org_cod=$codigoElim");
            header("Refresh:0; url=http://localhost/SGR/web/organismos/ABMorganismo.php");
	}
       