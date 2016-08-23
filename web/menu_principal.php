<?php 
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres")or die ('Error al conectar a la base de datos');
    //$consulta= pg_exec($conectate,"select sum(reg_cant)as cantidad,sum(reg_aprob) as aprobados,sum(reg_reprob)
    //as reprobados,sum(reg_claus)as clausurados from registros where reg_fecha < now()");
    //$cantidad=pg_result($consulta,0,'cantidad');
    //$aprobados=pg_result($consulta,0,'aprobados');
    //$reprobados=pg_result($consulta,0,'reprobados');
    //$clausurados=pg_result($consulta,0,'clausurados');
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
                <img src="http://localhost/SGR/web/img/head.png" width=500 height=80 alt="Obra de K. Haring"> 
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
                    <a class="dropdown-toggle" data-toggle="dropdown" href="http://localhost/SGR/web/logout.php">
                        <i class="fa fa-user fa-fw"  href="http://localhost/SGR/web/logout.php"></i> <?php echo "USUARIO"//$_SESSION['usernom']." ".$_SESSION['userape']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Cambiar Contraseña</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="http://localhost/SGR/web/logout.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesion</a>
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
                            <a href="http://localhost/SGR/web/menu_principal.php" value="Load new document" onclick="location.reload();"><i class="fa  fa-tasks"></i> Menu Principal</a>
                        </li>
			<li>
                            <a href="#"><i class="fa fa-user"></i> USUARIOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/usuarios/ABMusuario.php">Registros de Usuarios</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
			<li>
                            <a href="#"><i class="fa  fa-users"></i> CATEGORÍAS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/categorias/ABMcategoria.php"> Registros de Categorias</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-home "></i> DEPARTAMENTOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/departamentos_unidades/ABMdepartamento_unidad.php">Registros de Departamentos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-minus"></i> DEPENDENCIAS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/dependencia/ABMdependencia.php">Registros de Dependencias</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa  fa-flickr "></i> ENCARGADOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/encargados/ABMencargado.php">Registros de Encargados</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa   fa-pencil"></i> ORGANISMOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/organismos/ABMorganismo.php">Registros de Organismos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa  fa-cubes"></i> PRESENTACIÓN<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/presentacion/ABMpresentacion.php">Registros de Presentación</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-magic"></i> MARCAS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/marcas/ABMmarca.php">Registros de Marcas</a>
                                </li>
                                
                            </ul> 
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-bank"></i> PRODUCTOS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/productos/ABMproducto.php">Registros de Productos</a>
                                </li>
                                
                            </ul> 
                        </li>

                        <li>
                            <a href="#"><i class="fa  fa-hand-o-right "></i>  STOCK<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/stock/registrar_stock.php">Gestión de Stock</a>
                                    <a href="http://localhost/SGR/web/stock/gestion_almacen.php">Gestión de Almacenes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-database"></i>  REGISTRAR RETIROS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                       <a href="http://localhost/SGR/web/retiros/registrar_retiros.php">Retiro de Reactivos</a>
                                </li>
                            </ul>
                            <ul class="nav nav-second-level">
                                <li>
                                 
                                    <a href="http://localhost/SGR/web/retiros/detalle_retiros.php">Detalle Retiro de Reactivos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-exclamation-circle "></i>  REGISTRAR MIGRACION<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                 
                                    <a href="http://localhost/SGR/web/registrar_migracion/registrar_migracion.php">Migración de Reactivos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                      
                        
                        <li>
                            <a href="#"><i class="fa  fa-file-text "></i> INFORMES<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://localhost/SGR/web/informes/Imp_registro_impresion.php">Imprimir Registro</a>
                                    <a href="http://localhost/SGR/web/informes/Frm_Busqueda_Precinto.php">Impresión/Búsqueda por Stock</a>
                                    <a href="http://localhost/SGR/web/informes/Frm_Resumen_Emblemas.php">Resumen por Productos</a> 
                                    <a href="http://localhost/SGR/web/informes/Frm_Resumen_Puestos.php">Movimiento Producto</a> 
                                    <a href="http://localhost/SGR/web/informes/Frm_Resumen_Puestos.php">Productos Migrados</a> 
                                    <a href="http://localhost/SGR/web/informes/Frm_Resumen_Puestos.php">Localizar Producto</a> 
                                    <a href="http://localhost/SGR/web/informes/Frm_Resumen_Camion.php">Stock Mínimo</a> 
                                    <a href="http://localhost/SGR/web/informes/Frm_Resumen_Puestos_Emblemas.php">Resumen por Unidad/Departamentos</a>
                                     <a href="http://localhost/SGR/web/informes/Frm_Resumen_Puestos_Emblemas.php">Resumen por Encargados</a>
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

     <div id="wrapper">
         <div id="page-wrapper">

        
            <div class="row">
                
				
                <div class="col-lg-5">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <center> <i class="fa fa-bar-chart-o fa-fw"></i><b> Stock Minimo</b></center>
                        </div>
                        <div class="panel-body">
							<div id="donut"></div>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                 <div class="col-lg-5">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <center> <i class="fa fa-bar-chart-o fa-fw"></i><b> Stock Minimo</b></center>
                        </div>
                        <div class="panel-body">
							<div id="donut2"></div>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->
            </div>

        
             
    <!-- /#wrapper -->
    </div>  
    </div>
       <?php
        $query = pg_query("select COALESCE(min(pro_cod),0) from stock_detalle where stockdet_actual<stockdet_minimo");
        $row1 = pg_fetch_array($query);
        $precintos_disponibles=$row1[0];
        $query = pg_query("select COALESCE(min(pro_cod),0) from stock_detalle where stockdet_actual<stockdet_minimo");
        $row1 = pg_fetch_array($query);
        $precintos_usados=$row1[0];
        echo "
	<script type='text/javascript'>
        $( document ).ready(function() {
	Morris.Donut({
            element: 'donut',
            data: [
              {value: ".$precintos_disponibles.", label: 'Stock Actual'},
              {value: ".$precintos_usados.", label: 'Stock Minimo'},
            ],
            formatter: function (x) { return x + ''}
          }).on('click', function(i, row){
            console.log(i, row);
          });
         });        
        </script>";
        
        echo "
	<script type='text/javascript'>
        $( document ).ready(function() {
	Morris.Donut({
            element: 'donut2',
            data: [
              {value: ".$precintos_disponibles.", label: 'Stock Actual'},
              {value: ".$precintos_usados.", label: 'Stock Minimo'},
            ],
            formatter: function (x) { return x + ''}
          }).on('click', function(i, row){
            console.log(i, row);
          });
         });        
        </script>";
        
        
        ?>       


    <!-- Bootstrap Core JavaScript -->
    <script language="JavaScript" type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <!-- Morris Charts JavaScript -->
    <script language="JavaScript" type="text/javascript" src="bower_components/raphael/raphael.js"></script>
    <script language="JavaScript" type="text/javascript" src="bower_components/morrisjs/morris.js"></script>
    <link rel="stylesheet" href="bower_components/morrisjs/morris.css">  
    <script language="JavaScript" type="text/javascript" src="js/morris-data.js"></script>
</body>

</html>
