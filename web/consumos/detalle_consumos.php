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

        <title>SGR INTN- Productos Consumidos</title>
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
//            function eliminar(codigo){
//			document.getElementById("txtCodigoE").value = codigo;
//		};
        </script>
        <script type="text/javascript">
            
            
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
                        <h1 class="page-header">Productos Consumidos - <small>SGR INTN</small></h1>
                    </div>	
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Listado de Reactivos Consumidos
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
                                                <!--<th>Acción</th>-->
                                            </tr>
                                        </thead>
                                        <tbody></tr>
                                            <?php
                                            $query = "select depar_desc,en_nom ||' '|| en_ape as encargado,pro_nombre,con_fecha,con_cantidad
                                             from retiro ret,retiro_detalle retdet,stock_detalle stdet,encargado enc,consumos con,departamentos_unidad dep,producto pro where 
                                             ret.reti_cod=retdet.reti_cod
                                             and stdet.stockdet_cod=retdet.stockdet_cod
                                             and retdet.retidet_cod=con.retidet_cod
                                             and enc.en_cod=con.en_cod
                                             and ret.depar_cod=dep.depar_cod
                                             and stdet.pro_cod=pro.pro_cod";
                                            $result = pg_query($query) or die("Error al realizar la consulta");
                                            while ($row1 = pg_fetch_array($result)) {
                                                echo "<tr><td style='display:none'>".$row1["mig_cod"]."</td>";
                                                   echo "<td>".$row1["depar_desc"]."</td>";
                                                   echo "<td>".$row1["pro_nombre"]."</td>";
                                                   echo "<td>".$row1["con_fecha"]."</td>";
                                                   echo "<td>".$row1["encargado"]." ".$row1["en_ape"]."</td>";
                                                   echo "<td>".$row1["con_cantidad"]."</td>";
                                                    echo "<td>";
                                                ?>
                                            <!--<a onclick='eliminar(<?php echo $row1["con_cod"];?>)' class="btn btn-danger btn-xs active" data-toggle="modal" data-target="#modalbor" role="button">Borrar</a>-->
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
<!-- /#MODAL ELIMINACIONES -->
<!--	<div class="modal fade" id="modalbor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				 Modal Header 
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-trash"></i> Borrar Registro</h3>
				</div>
            
				 Modal Body 
				<div class="modal-body">
                                    <form class="form-horizontal" name="borrarform" action="../class/ClsMigracion_Producto.php" onsubmit="return submitForm();" method="post" role="form">
						<div class="form-group">
							<input type="numeric" name="txtCodigoE" class="hide" id="txtCodigoE" />
							<div class="alert alert-danger alert-dismissable col-sm-10 col-sm-offset-1">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								¡¡¡ATENCION!!! ...Se borrara el siguiente registro..
							</div>
						</div>
				</div>
				
				 Modal Footer 
				<div class="modal-footer">
					<button type="" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="borrar" class="btn btn-danger">Borrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>-->
        </div>
</html>
