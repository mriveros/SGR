<?php
 include '../funciones.php';
 conexionlocal();
 if  (empty($_GET['descripcion'])){$descripcion=0;}else{$descripcion=$_GET['descripcion'];}
 if  (empty($_GET['licitacion'])){$licitacion=0;}else{$licitacion=$_GET['licitacion'];}
 if  (empty($_GET['lote'])){$lote=0;}else{$lote=$_GET['lote'];}
 
 $query = "INSERT INTO stock(stock_fecha,stock_licitacion,stock_desc,stock_lote)"
                    . "VALUES ('now()','$licitacion','$descripcion','$lote');";
                //ejecucion del query
$ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al inserta la Cabecera Stock. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/stock/registrar_stock.php";
		</script>');
 ?>