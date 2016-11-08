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
if  (empty($_POST['txtDescripcionA'])){$descripcionA='';}else{ $descripcionA = $_POST['txtDescripcionA'];}
if  (empty($_POST['txtLicitacionA'])){$licitacionA='';}else{ $licitacionA = $_POST['txtLicitacionA'];}
if  (empty($_POST['txtLoteA'])){$loteA='';}else{ $loteA= $_POST['txtLoteA'];}
//DAtos para el Eliminado Logico
if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
               $cod=generarCodigo(1);
               $lote=$loteA.$cod;
    if(isset($_POST['agregar'])){
            if(func_existeDato($lote, 'stock', 'stock_lote')==true){
                echo '<script type="text/javascript">
		alert("El Lote ya existe. Ingrese otro Lote.");
                window.location="http://192.168.0.99/SGR/web/stock/registrar_stock.php";
		</script>';
                }
                else{
                //se define el Query   
                $query = "INSERT INTO stock(stock_fecha,stock_licitacion,stock_desc,stock_lote)"
                    . "VALUES ('now()','$licitacionA','$descripcionA','$lote');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al inserta la Cabecera Stock. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/stock/registrar_stock.php";
		</script>');
                //header("Refresh:0; url=http://192.168.0.99/SGR/web/stock/registrar_stock.php");
                }
            }
    if(isset($_POST['borrar'])){
            $query=("delete from stock WHERE stock_cod=$codigoElim");
             $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al borrar Stock. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/stock/registrar_stock.php";
		</script>');
            header("Refresh:0; url=http://192.168.0.99/SGR/web/stock/registrar_stock.php");
            
	}
        