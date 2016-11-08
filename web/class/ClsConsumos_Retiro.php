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
    $consul= pg_query("select en_cod from usuarios usu,encargado enc where usu.usu_cod=enc.usu_cod and usu.usu_cod=$codusuario");
       $vector=  pg_fetch_array($consul);
       $codencargado= $vector["en_cod"];
       
//       echo 'Codigo ENCARGADO='.$codencargado;
    //Datos del Form Agregar
    if  (empty($_POST['txtCantidad'])){$cantidad='';}else{ $cantidad = $_POST['txtCantidad'];}
    if  (empty($_POST['txtCodigo'])){$codigo='';}else{$codigo=$_POST['txtCodigo'];}
   
        //Si es agregar
        if(isset($_POST['agregar'])){
                $cantidadactual=  validar_cantidad_consumo_retiro($codigo);
                if($cantidadactual<$cantidad){
                        echo '<script type="text/javascript">
			alert("La Cantidad Ingresada supera el Stock actual del Producto que desea Consumir. Debe ser menor a '.$cantidadactual.'");
                            window.location="http://aplicaciones.intn.gov.py/SGR/web/consumos/registrar_consumos_retiro.php";
			 </script>';
                }  else {   
                $query = "INSERT INTO consumos(retidet_cod,en_cod,con_cantidad,con_fecha,con_estado)"
                . "VALUES ($codigo,$codencargado,$cantidad,now(),'t');";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al Consumir Producto. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/consumos/registrar_consumos_retiro.php";
		</script>');
                $actualizar= "update retiro_detalle set retidet_cantidad_actual=(retidet_cantidad_actual-$cantidad) where retidet_cod=$codigo";
                $eje = pg_query($actualizar)or die('Error al actualizar Cantidad Actual'.$actualizar);
                $actualizar= '';
                header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/consumos/registrar_consumos_retiro.php");
                }
            }
//             if(isset($_POST['borrar'])){
//                $coddetalleretiro= retirocoddet($codigoElim);
//                $cantidad= sumar_cantidad($codigoElim);
//                $query=("delete from migracion_producto WHERE mig_cod=$codigoElim");
//                $ejecucion = pg_query($query)or die('<script type="text/javascript">
//		alert("Error al BORRAR el Producto Migrado. Err(108):'.$query.'");
//                window.location="http://aplicaciones.intn.gov.py/SGR/web/migraciones/reactivos_migrados.php";
//		</script>');
//                $actualizar= "update retiro_detalle set retidet_cantidad_actual=(retidet_cantidad_actual+$cantidad) where retidet_cod=$coddetalleretiro";
//                $eje = pg_query($actualizar)or die('Error al actualizar Cantidad Actual'.$actualizar);
//                $actualizar= '';
//                header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/migraciones/reactivos_migrados.php");
//	}
       
    ?>    