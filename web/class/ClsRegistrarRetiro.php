<?php
session_start();
if (!isset($_SESSION['codigo_usuario']))
    header("Location:http://localhost/SGR/login/acceso.html");
    $catego = $_SESSION["categoria_usuario"];
    $codigo_usuario = $_SESSION['codigo_usuario'];

 include '../funciones.php';
 conexionlocal();
 
 if  (empty($_GET['observacion'])){$observacion=0;}else{$observacion=$_GET['observacion'];}
 if  (empty($_GET['encargado'])){$encargado=0;}else{$encargado=$_GET['encargado'];}
 if  (empty($_GET['departamento'])){$departamento=0;}else{$departamento=$_GET['departamento'];}
 
 $query = "INSERT INTO retiro(reti_fecha,reti_obser,usu_cod,en_cod,depar_cod)"
                    . "VALUES ('now()','$observacion',$codigo_usuario,$encargado,$departamento);";
                //ejecucion del query
$ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al inserta la Cabecera Stock. Err(108):'.$query.'");
                window.location="http://localhost/SGR/web/stock/registrar_stock.php";
		</script>');
 ?>