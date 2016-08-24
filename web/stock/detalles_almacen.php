<?php
session_start();
if(!isset($_SESSION['codigo_usuario']))
header("Location:http://localhost/SGR/login/acceso.html"); 
$catego=  $_SESSION["categoria_usuario"];

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SGR INTN-Organismos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	<!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
	
    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	    
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
			responsive: true
        });
    });
    function redireccionar(){
         window.location="http://localhost/SGR/web/stock/gestion_almacen.php";
    }
    </script>
	
</head>

<body>

    <div id="wrapper">

        <?php 
        include("../funciones.php");
        if ($catego==1){
             include("../menu.php");
        }elseif($catego==2){
             include("../menu_usuario.php");
        }elseif($catego==3){
             include("../menu_supervisor.php");
        }
       
        conexionlocal();
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                      <h1 class="page-header">Stock Detalles - <small>SGR INTN</small></h1>
                </div>	
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista Detalle
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr class="success">
                                            <th style='display:none'>Codigo</th>
                                            <th>Producto</th>
                                             <th>Cantidad</th>
                                            <th>Stock Minimo</th>
                                            <th>Stock Actual</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    if  (empty($_POST['codigo_cabecera'])){$codigo_cabecera=0;}else{ $codigo_cabecera = $_POST['codigo_cabecera'];}
                    
                    conexionlocal();
                    $query = "select stockdet_cod,pro_nombre,stockdet_minimo,stockdet_actual,stockdet_cantidad from producto,stock,stock_detalle where 
                    stock.stock_cod=stock_detalle.stock_cod and producto.pro_cod=stock_detalle.pro_cod and stock.stock_cod=$codigo_cabecera";
                    $result = pg_query($query) or die ("Error al realizar la consulta");
                    while($row1 = pg_fetch_array($result))
                    {
                        echo "<tr><td style='display:none'>".$row1["stockdet_cod"]."</td>";
                        echo "<td>".$row1["pro_nombre"]."</td>";
                        echo "<td>".$row1["stockdet_cantidad"]."</td>";
                        echo "<td>".$row1["stockdet_minimo"]."</td>";
                        echo "<td>".$row1["stockdet_actual"]."</td>";
                       
                        echo"</tr>";
                    }
                    pg_free_result($result);
                    ?>
                                    </tbody>
                                </table>
                               
                                       
                            </div>
                            <a  onclick="redireccionar()" class="btn btn-primary" data-toggle="modal" data-target="#modalagr" role="button">Volver</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
    
</html>