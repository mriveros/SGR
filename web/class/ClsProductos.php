<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Gestion de Reactivos SGR-INTN
 */
session_start();
$codusuario=  $_SESSION["codigo_usuario"];

    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtNombreA'])){$nombreA='';}else{ $nombreA = $_POST['txtNombreA'];}
    if  (empty($_POST['txtMarcaA'])){$marcaA='';}else{ $marcaA = $_POST['txtMarcaA'];}
    if  (empty($_POST['txtFechaVenceA'])){$FechaVenceA='';}else{ $FechaVenceA= $_POST['txtFechaVenceA'];}
    if  (empty($_POST['txtPresentacionA'])){$presentacionA='';}else{ $presentacionA= $_POST['txtPresentacionA'];}
    
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombreM'])){$nombreM='';}else{ $nombreM = $_POST['txtNombreM'];}
    if  (empty($_POST['txtMarcaM'])){$marcaM='';}else{ $marcaM= $_POST['txtMarcaM'];}
    if  (empty($_POST['txtFechaVenceM'])){$fecha_venceM='';}else{ $fecha_venceM= $_POST['txtFechaVenceM'];}
     if  (empty($_POST['txtPresentacionM'])){$presentacionM='';}else{ $presentacionM= $_POST['txtPresentacionM'];}
    if  (empty($_POST['txtEstadoM'])){$estadoM='f';}else{ $estadoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($nombreA, 'producto', 'pro_nombre')==true){
                echo '<script type="text/javascript">
		alert("El Producto ya existe. Ingrese otro Producto.");
                window.location="http://192.168.0.99/SGR/web/productos/ABMproducto.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO producto(pro_nombre,mar_cod,pro_fecha_ven,pro_fecha,presen_cod,pro_estado)"
                    . "VALUES ('$nombreA',$marcaA,'$FechaVenceA','now()',$presentacionA,'t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al inserta el Producto. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/productos/ABMproducto.php";
		</script>');
               
                header("Refresh:0; url=http://192.168.0.99/SGR/web/productos/ABMproducto.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
             $query = "update producto set pro_nombre='$nombreM',"
                    . "mar_cod= $marcaM,"
                    . "pro_fecha_ven= '$fecha_venceM',"
                    . "presen_cod= $presentacionM,"
                    . "pro_estado='$estadoM'"
                    . "WHERE pro_cod=$codigoModif";
            $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al inserta el Producto. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/productos/ABMproducto.php";
		</script>');
            header("Refresh:0; url=http://192.168.0.99/SGR/web/productos/ABMproducto.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update producto set pro_estado='f' WHERE pro_cod=$codigoElim");
            header("Refresh:0; url=http://192.168.0.99/SGR/web/productos/ABMproducto.php");
            
	}
        