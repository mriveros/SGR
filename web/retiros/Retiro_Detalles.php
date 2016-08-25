<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SGR-Retiro Detalles</title>
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
    
    </script>
	<script type="text/javascript">
		/*function Redirigir(){
			window.location="http://localhost/SGR/web/stock/registrar_stock.php";
		};
                */
                function eliminar(codigo){
//              alert(codigo);
        document.getElementById("txtCodigoE").value = codigo;
		};      
	</script>
</head>

<body>
        <?php 
        include("../funciones.php");
        conexionlocal();
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                      <h1 class="page-header">Retiro Detalle</h1>
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
                                            <th>Cantidad</th>
                                            <th>Producto</th>
                                            <th>Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php   
                    
                    $query = "Select COALESCE (max(reti_cod),0)from retiro";
                    $resultado=pg_query($query);
                    $row=  pg_fetch_array($resultado);
                    $codcabecera=$row[0];
                    
                    $query = "select retdet.retidet_cod,retdet.retidet_cantidad,pro.pro_nombre
                    from retiro ret,retiro_detalle retdet,stock_detalle stkdet, producto pro
                    where ret.reti_cod=retdet.reti_cod 
                    and stkdet.stockdet_cod=retdet.stockdet_cod
                    and stkdet.pro_cod=pro.pro_cod
                    and ret.reti_cod=$codcabecera";
                    $result = pg_query($query) or die ("Error al realizar la consulta");
                    while($row1 = pg_fetch_array($result))
                    {
                        echo "<tr><td style='display:none'>".$row1["retidet_cod"]."</td>";
                         echo "<td>".$row1["retidet_cantidad"]."</td>";
                        echo "<td>".$row1["pro_nombre"]."</td>";
                        echo "<td>";?>
                        <a onclick='eliminar(<?php echo $row1["retidet_cod"];?>)' class="btn btn-danger btn-xs active" data-toggle="modal" data-target="#modalbor" role="button">Borrar</a>
                        <?php
                        echo "</td></tr>";
                    }
                    pg_free_result($result);
                    ?>
                                    </tbody>
                                </table>
                                 <a class="btn btn-primary" data-toggle="modal" data-target="#modalagr" role="button">Nuevo Detalle</a>
                                 
                                 <button type="submit" onclick="location.reload();" name="registar" class="btn btn-info">Guardar detalle</button>
                                
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
    <!-- /#wrapper -->
	<!-- /#MODAL AGREGACIONES -->
	<div class="modal fade" id="modalagr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-floppy-disk"></i> Agregar Registro</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/ClsRetiroDetalle.php" method="post" role="form">
						
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label" for="input01">Cantidad</label>
                                            <div class="col-sm-9">
                                            <input type="number" name="txtCantidadA" class="form-control" id="txtCantidadA" placeholder="ingrese cantidad" required />
                                            </div>
					</div>
                                        
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label" for="input01">Stock Detalle</label>
                                            <div class="col-sm-9">
                                                <select name="txtStockDetalleA" class="form-control" id="txtStockDetalleA" required>
                                                    <?php
                                                    //esto es para mostrar un select que trae datos de la BDD
                                                    conexionlocal();
                                                    $query = "select stock_detalle.stockdet_cod,stock_desc || '  ' || stockdet_actual || '  ' || pro_nombre as stock from stock,stock_detalle,producto where stock_detalle.stock_cod=stock.stock_cod and stock_detalle.pro_cod=producto.pro_cod";
                                                    $resultadoSelect = pg_query($query);
                                                    while ($row = pg_fetch_row($resultadoSelect)) {
                                                        echo "<option value=" . $row[0] . ">";
                                                        echo $row[1];
                                                        echo "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
					</div>
                                        <div class="modal-footer">
					<button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="agregar" class="btn btn-primary">Agregar</button>
					
                                        </div>
                                    </form>
				</div>
				
				<!-- Modal Footer -->  
			</div>
		</div>
	</div>
	
	<!-- /#MODAL ELIMINACIONES -->
	<div class="modal fade" id="modalbor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-trash"></i> Borrar Registro</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form class="form-horizontal" name="borrarform" action="../class/ClsRetiroDetalle.php" onsubmit="return submitForm();" method="post" role="form">
						<div class="form-group">
							<input type="numeric" name="txtCodigoE" class="hide" id="txtCodigoE" />
							<div class="alert alert-danger alert-dismissable col-sm-10 col-sm-offset-1">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								¡¡¡ATENCION!!! ...Se borrara el siguiente registro..
							</div>
						</div>
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="borrar" class="btn btn-danger">Borrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    
</html>