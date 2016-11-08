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
    if  (empty($_POST['txtDependenciaA'])){$dependenciaA='';}else{ $dependenciaA= $_POST['txtDependenciaA'];}
    
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtDescripcionM'])){$descripcionM='';}else{ $descripcionM= $_POST['txtDescripcionM'];}
    if  (empty($_POST['txtDependenciaM'])){$dependenciaM='';}else{ $dependenciaM= $_POST['txtDependenciaM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($descripcionA, 'departamentos_unidad', 'depar_desc')==true){
                echo '<script type="text/javascript">
		alert("El Departamento/UNidad ya existe. Ingrese otro Departamento/Unidad.");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO departamentos_unidad(depar_desc,depen_cod,depar_estado) VALUES ('$descripcionA',$dependenciaA,'t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el Departamento/Unidad. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php";
		</script>');
                $query = '';
                header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            $query = "update departamentos_unidad set depar_desc='$descripcionM',depen_cod=$dependenciaM,depar_estado='$estadoM' WHERE depar_cod=$codigoModif";
            $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el Departamento/Unidad. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php";
		</script>');
            header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update departamentos_unidad set depar_estado='f' WHERE depar_cod=$codigoElim");
            header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php");
	}
       