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
    if  (empty($_POST['txtCantidadA'])){$cantidad='';}else{ $cantidad = $_POST['txtCantidadA'];}
    if  (empty($_POST['txtDepartamentoA'])){$departamento='';}else{ $departamento= $_POST['txtDepartamentoA'];}
    if  (empty($_POST['txtEncargadoA'])){$encargado='';}else{$encargado=$_POST['txtEncargadoA'];}
    if  (empty($_POST['txtCodigo'])){$codigo='';}else{$codigo=$_POST['txtCodigo'];}
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
        //Si es agregar
        if(isset($_POST['agregar'])){
                $cantidadactual=validar_cantidad($codigo);
                if($cantidadactual<$cantidad){
                        echo '<script type="text/javascript">
			alert("La Cantidad ingresada supera el Stock actual del Producto que desea migrar. Debe ser menor a '.$cantidadactual.'");
                            window.location="http://aplicaciones.intn.gov.py/SGR/web/migraciones/registrar_migracion.php";
			 </script>';
                }  else {   
                $query = "INSERT INTO migracion_producto(mig_cantidad,mig_cantidad_actual,mig_fecha,depar_cod,en_cod,retidet_cod,usu_cod)"
                . "VALUES ($cantidad,$cantidad,now(),$departamento,$encargado,$codigo,$codusuario);";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al Migrar Producto. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/migraciones/registrar_migracion.php";
		</script>');
                $actualizar= "update retiro_detalle set retidet_cantidad_actual=(retidet_cantidad_actual-$cantidad) where retidet_cod=$codigo";
                $eje = pg_query($actualizar)or die('Error al actualizar Cantidad Actual'.$actualizar);
                $actualizar= '';
                header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/migraciones/registrar_migracion.php");
                }
            }
             if(isset($_POST['borrar'])){
                $coddetalleretiro= retirocoddet($codigoElim);
                $cantidad= sumar_cantidad($codigoElim);
                $query=("delete from migracion_producto WHERE mig_cod=$codigoElim");
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al BORRAR el Producto Migrado. Err(108):'.$query.'");
                window.location="http://aplicaciones.intn.gov.py/SGR/web/migraciones/reactivos_migrados.php";
		</script>');
                $actualizar= "update retiro_detalle set retidet_cantidad_actual=(retidet_cantidad_actual+$cantidad) where retidet_cod=$coddetalleretiro";
                $eje = pg_query($actualizar)or die('Error al actualizar Cantidad Actual'.$actualizar);
                $actualizar= '';
                header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/migraciones/reactivos_migrados.php");
	}
       
    ?>    