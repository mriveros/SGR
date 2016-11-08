<?php 
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres")or die ('Error al conectar a la base de datos');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <title>SGR INTN</title>
</head>

<body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           
            <div class="navbar-header">
                 
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    
                    <span class="sr-only">Toggle navigation</span>
                    
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="http://192.168.0.99/SGR/web/img/head.png" width=500 height=80 alt="Obra de K. Haring"> 
            </div>
            <center><a class="navbar-brand" href="#"><h2>Sistema de Gestion de Reactivos - SGR INTN</h2></a></center>
            <!-- /.navbar-header -->
            <br><br>
            <ul class="nav navbar-top-links navbar-right">
                <br> 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Stock Minimo</strong>
                                        <span class="pull-right text-muted"><?php echo $aprobados;?> Cantidad Actual</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $aprobados;?>" aria-valuemin="0" aria-valuemax="<?php echo $cantidad;?>" style="width: <?php echo $aprobados;?>%">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Stock Minimo</strong>
                                        <span class="pull-right text-muted"><?php echo $reprobados;?> Cantidad Actual</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $aprobados;?>" aria-valuemin="0" aria-valuemax="<?php echo $cantidad;?>" style="width: <?php echo $reprobados;?>%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Stock Minimo</strong>
                                        <span class="pull-right text-muted"><?php echo $clausurados;?> Cantidad Actual</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $aprobados;?>" aria-valuemin="0" aria-valuemax="<?php echo $cantidad;?>" style="width: <?php echo $clausurados;?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Cerrar</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="http://192.168.0.99/SGR/web/logout.php">
                        <i class="fa fa-user fa-fw"  href="http://192.168.0.99/SGR/web/logout.php"></i> <?php echo "USUARIO"//$_SESSION['usernom']." ".$_SESSION['userape']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a data-toggle="modal" data-target="#modalpassword"><i class="fa fa-user fa-fw"></i> Cambiar Contraseña</a>
                        </li>
                        <li><a><i class="fa fa-gear fa-fw"></i> Configuración</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="http://192.168.0.99/SGR/web/logout.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
          

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="http://192.168.0.99/SGR/web/menu_supervisor.php" value="Load new document" onclick="location.reload();"><i class="fa  fa-tasks"></i> Menu Principal</a>
                        </li>
			
                        <li>
                            <a href="#"><i class="fa  fa-exclamation-circle "></i>  REGISTRAR MIGRACION<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://192.168.0.99/SGR/web/migraciones/registrar_migracion.php">Migración de Reactivos</a>
                                    <a href="http://192.168.0.99/SGR/web/migraciones/reactivos_migrados.php">Reactivos Migrados</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-bookmark"></i>  REGISTRAR CONSUMOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                   <a href="http://192.168.0.99/SGR/web/consumos/registrar_consumos_retiro.php">Registrar Consumos Retiro</a>
                                   <a href="http://192.168.0.99/SGR/web/consumos/registrar_consumos_migracion.php">Registrar Consumos Migración</a>
                                   <a href="http://192.168.0.99/SGR/web/consumos/detalle_consumos.php">Productos Consumidos</a>
                                </li>
                            </ul>
                             
                            <!-- /.nav-second-level -->
                        </li>
                       
                      
                        
                        <li>
                            <a href="#"><i class="fa  fa-file-text "></i> INFORMES<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                     <a href="http://192.168.0.99/SGR/web/informes/Frm_Reactivos_Encargados.php">Resumen por Encargados</a>
                                    <a href="http://192.168.0.99/SGR/web/informes/Frm_Reactivos_Departamentos.php">Resumen por Departamentos/Unidad</a> 
                                    <a href="http://192.168.0.99/SGR/web/informes/Frm_Reactivos_Migrados.php">Resumen Migración</a> 
                                    <a href="http://192.168.0.99/SGR/web/informes/Frm_Retiros_Consumidos.php">Resumen Consumo de Retiro</a>
                                    <a href="http://192.168.0.99/SGR/web/informes/Frm_Migraciones_Consumidos.php">Resumen Consumo de Migración</a>
                                </li>
                               
                                    
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class=""></i> Help <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                    <a href="">Contacte con el Programador: mriveros@intn.gov.py</a>
                              
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="modal fade" id="modalpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-floppy-disk"></i> Cambiar Contraseña</h3>
				</div>
            
				<!-- Modal Body -->
				<div class="modal-body">
                                    <form  autocomplete="off" class="form-horizontal" name="agregarform" action="../class/Clsmarca.php" method="post" role="form">
					    <div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Password Actual</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="txtPasswordActual" class="form-control" id="txtPasswordActual" placeholder="ingrese password" required="true"/>
                                            </div>
                                            </div>
					<div class="form-group">
                                            <label  class="col-sm-2 control-label" for="input01">Password Nuevo</label>
                                            <div class="col-sm-10">
                                             <input type="password" name="txtPasswordNuevo" class="form-control" id="txtPasswordNuevo" placeholder="ingrese password" required="true"/>
                                            </div>
                                            </div>	
				</div>
				
				<!-- Modal Footer -->
				<div class="modal-footer">
					<button type="reset" onclick="location.reload();" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					<button type="submit" name="agregar" class="btn btn-primary">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>