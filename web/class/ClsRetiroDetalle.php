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
    if  (empty($_POST['txtStockDetalleA'])){$stockdetA='';}else{ $stockdetA= $_POST['txtStockDetalleA'];}
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
        //Si es agregar
        if(isset($_POST['agregar'])){
            $query = "Select max(reti_cod) from retiro;";
                $resultado=pg_query($query);
                $row=  pg_fetch_array($resultado);
                $codcabecera=$row[0];
                $cantidadactual=validar_stock($stockdetA);
                    if($cantidadactual<$cantidadA){
                        echo '<script type="text/javascript">
			alert("la Cantidad ingresada supera el Stock actual del Retiro a realizar. Debe ser menor a '.$cantidadactual.'");
                            window.location="http://192.168.0.99/SGR/web/retiros/Retiro_Detalles.php";
			 </script>';
                    }  else {   
                $query = "INSERT INTO retiro_detalle(reti_cod,retidet_cantidad,retidet_cantidad_actual,stockdet_cod)"
                    . "VALUES ($codcabecera,$cantidadA,$cantidadA,$stockdetA);";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el Retiro Detalle. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/retiros/Retiro_Detalles.php";
		</script>');
                $actualizar= "update stock_detalle set stockdet_actual=(stockdet_actual-$cantidadA) where stockdet_cod=$stockdetA";
                $eje = pg_query($actualizar)or die('Error al actualizar Stock Actual');
                $actualizar= '';
                header("Refresh:0; url=http://192.168.0.99/SGR/web/retiros/Retiro_Detalles.php");
                }
            }
        if(isset($_POST['borrar'])){
            $coddetallestock= stockcoddet($codigoElim);
            $cantidad= sumar_stock($codigoElim);
//            echo "'DETALLE'$coddetallestock". "'CANTIDAD'$cantidad";
            $query=("delete from retiro_detalle WHERE retidet_cod=$codigoElim");
            $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al BORRAR el Retiro Detalle. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/retiros/Retiro_Detalles.php";
		</script>');
            $actualizar= "update stock_detalle set stockdet_actual=(stockdet_actual+$cantidad) where stockdet_cod=$coddetallestock";
                $eje = pg_query($actualizar)or die('Error al actualizar Stock Actual'.$actualizar);
                $actualizar= '';
            header("Refresh:0; url=http://192.168.0.99/SGR/web/retiros/Retiro_Detalles.php");
	}
        