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
    if  (empty($_POST['txtCantidadA'])){$cantidadA='';}else{ $cantidadA = $_POST['txtCantidadA'];}
    if  (empty($_POST['txtProductoA'])){$productoA='';}else{ $productoA = $_POST['txtProductoA'];}
    
    if  (empty($_POST['txtStockminimoA'])){$minimoA='';}else{ $minimoA= $_POST['txtStockminimoA'];}
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
        //Si es agregar
        if(isset($_POST['agregar'])){
                $query = "Select max(stock_cod) from stock;";
                $resultado=pg_query($query);
                $row=  pg_fetch_array($resultado);
                $codcabecera=$row[0];
                //se define el Query   
                $query = "INSERT INTO stock_detalle(stockdet_cantidad,stockdet_actual,stockdet_minimo,pro_cod,stock_cod)"
                . "VALUES ($cantidadA,$cantidadA,$minimoA,$productoA,$codcabecera);";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el Stock Detalle. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/stock/StockDetalle.php";
		</script>');
                header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/stock/StockDetalle.php");
            }
        if(isset($_POST['borrar'])){
            $query=("delete from stock_detalle WHERE stockdet_cod=$codigoElim");
            $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al BORRAR el Stock Detalle. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/stock/StockDetalle.php";
		</script>');
            header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/stock/StockDetalle.php");
	}
        