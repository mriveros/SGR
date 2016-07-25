<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Control ONM-INTN
 */

    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtDescripcionA'])){$descripcionA=0;}else{ $descripcionA = $_POST['txtDescripcionA'];}
    if  (empty($_POST['txtOpcionA'])){$activoA='f';}else{ $activoA= 't';}
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtDescripcionM'])){$descripcionM=0;}else{ $descripcionM = $_POST['txtDescripcionM'];}
    if  (empty($_POST['txtOpcion'])){$activoM='f';}else{ $activoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($descripcionA, 'presentacion', 'presen_desc')==true){
                echo '<script type="text/javascript">
		alert("La presentación ya existe. Intente ingresar otra presentación");
                window.location="http://localhost/SGR/web/presentacion/ABMpresentacion.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO presentacion(presen_desc,presen_estado)
                VALUES ('$descripcionA','t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar la presentacion. Err(108):'.$query.'");
                window.location="http://localhost/SGR/web/presentacion/ABMpresentacion.php";
		</script>');
                $query = '';
                header("Refresh:0; url=http://localhost/SGR/web/presentacion/ABMpresentacion.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            $query = "update presentacion set presen_desc='$descripcionM',presen_estado='$activoM' WHERE presen_cod=$codigoModif";
            $ejecucion = pg_query($query) or die('<script type="text/javascript">
            alert("Error al modificar la presentacion. Err(108):'.$query.$codigoModif.'");
            window.location="http://localhost/SGR/web/presentacion/ABMpresentacion.php";
            </script>');
           
            header("Refresh:0; url=http://localhost/SGR/web/presentacion/ABMpresentacion.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update presentacion set presen_estado='f' WHERE presen_cod=$codigoElim");
            header("Refresh:0; url=http://localhost/SGR/web/presentacion/ABMpresentacion.php");
	}
