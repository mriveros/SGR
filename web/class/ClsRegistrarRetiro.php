<?php
session_start();
if (!isset($_SESSION['codigo_usuario']))
    header("Location:http://aplicaciones.intn.gov.py/SGR/login/acceso.html");
    $catego = $_SESSION["categoria_usuario"];
    $codigo_usuario = $_SESSION['codigo_usuario'];

 include '../funciones.php';
 conexionlocal();
 if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
 
 
if(isset($_POST['borrar'])){
            //Creamos la rutina para recuperar todos los detalles, devolver al stock que pertenece y borrar.
            
            //obtenemos los codigos de detalles del stock
            $query = " select stockdet_cod from retiro_detalle where reti_cod=$codigoElim";
            $consulta=pg_exec($query) or die ($query);
            $numregs=pg_numrows($consulta);
            $i=0;
            while($i<$numregs)
            {
                $codigo_detalle_stock=pg_result($consulta,$i,'stockdet_cod');
                $cantidad= sumando_stock($codigo_detalle_stock);
                //obtenermos la cantidad del detalle
                $actualizar= "update stock_detalle set stockdet_actual=(stockdet_actual+$cantidad) where stockdet_cod=$codigo_detalle_stock";
                $eje = pg_query($actualizar)or die('Error al actualizar Stock Actual'.$actualizar);
                 $i++;
                
            }
           
            $query=("delete from retiro WHERE reti_cod=$codigoElim");
            $ejecucion = pg_query($query)or die('<script type="text/javascript">
            alert("Error al borrar Stock. Err(108):'.$query.'");
            window.location="http://aplicaciones.intn.gov.py/SGR/web/retiros/registrar_retiros.php";
            </script>');
            header("Refresh:0; url=http://aplicaciones.intn.gov.py/SGR/web/retiros/registrar_retiros.php");  
       }
 ?>