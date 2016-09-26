<?php
session_start();
if (!isset($_SESSION['codigo_usuario']))
    header("Location:http://localhost/SGR/login/acceso.html");
    $catego = $_SESSION["categoria_usuario"];
    $codigo_usuario = $_SESSION['codigo_usuario'];
?>
<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SGR INTN- Consumos</title>
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
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
        <script type="text/javascript">
            function consumirProducto(codigo) {
                document.getElementById("txtCodigo").value = codigo;
                
            }
            ;
            
        </script>

    </head>

    <body>

        <div id="wrapper">

            <?php
            include("../funciones.php");
            if ($catego == 1) {
                include("../menu.php");
            } elseif ($catego == 2) {
                include("../menu_usuario.php");
            } elseif ($catego == 3) {
                include("../menu_supervisor.php");
            }
            conexionlocal();
            ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Consumo de Reactivos Retiro- <small>SGR INTN</small></h1>
                    </div>	
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Listado de Reactivos
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr class="success">
                                                <th style='display:none'>Codigo</th>
                                                <th>Departamento</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Encargado</th>
                                                <th>Cantidad</th>
                                                <th>Cantidad Actual del Producto</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "select retidet_cod,reti_fecha,en_nom,en_ape,depar_desc,retidet_cantidad,
                                            retidet_cantidad_actual,pro_nombre
                                            from retiro,retiro_detalle,encargado,departamentos_unidad,producto,stock,stock_detalle 
                                            where retiro.reti_cod=retiro_detalle.reti_cod 
                                            and retiro.en_cod=encargado.en_cod
                                            and retiro.depar_cod=departamentos_unidad.depar_cod 
                                            and stock.stock_cod=stock_detalle.stock_cod 
                                            and producto.pro_cod=stock_detalle.pro_cod 
                                            and retiro_detalle.stockdet_cod=stock_detalle.stockdet_cod";
                                            $result = pg_query($query) or die("Error al realizar la consulta");
                                            while ($row1 = pg_fetch_array($result)) {
                                                echo "<tr><td style='display:none'>".$row1["retidet_cod"]."</td>";
                                                   echo "<td>".$row1["depar_desc"]."</td>";
                                                   echo "<td>".$row1["pro_nombre"]."</td>";
                                                   echo "<td>".$row1["reti_fecha"]."</td>";
                                                   echo "<td>".$row1["en_nom"]." ".$row1["en_ape"]."</td>";
                                                   echo "<td>".$row1["retidet_cantidad"]."</td>";
                                                   echo "<td>".$row1["retidet_cantidad_actual"]."</td>";
                                                    echo "<td>";
                                                ?>
                                            <a  class="btn btn-info" onclick="consumirProducto(<?php echo $row1["retidet_cod"]; ?>)" data-toggle="modal" data-target="#modalagr" role="button">Consumir Reactivo</a>
                                                <?php
                                            echo "</td></tr>";
                                        }
                                        pg_free_result($result);
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            
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
       <!-- /#MODAL AGREGACIONES -->
	<div class="modal fade" id="modalagr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Body -->
	<!-- /#MODAL AGREGACIONES -->
           <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b><center>DATOS SOBRE CONSUMO RETIRO</b></center>
                            </div>
                            <div class="modal-body">
                                <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/ClsConsumos_Retiro.php" method="post" role="form">
                                     <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="hidden" name="txtCodigo" class="form-control" id="txtCodigo"  />
                                </div>
                            </div>
                                <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Cantidad</label>
                                            <div class="col-sm-10">
                                            <input type="number" name="txtCantidad" class="form-control" id="txtCantidad" placeholder="ingrese cantidad" required />
                                            </div>
                                </div>
                                        <div class="modal-footer">
                                        <button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="agregar" class="btn btn-primary">Agregar</button>
                                        </div>
				</div>
			</div>
</html>
