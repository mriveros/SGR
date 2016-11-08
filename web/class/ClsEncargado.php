<?php
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Control ONM-INTN
 */

    include '../funciones.php';
    conexionlocal();
    
    //Datos del Form Agregar
    if  (empty($_POST['txtNombreA'])){$nombreA=0;}else{ $nombreA = $_POST['txtNombreA'];}
    if  (empty($_POST['txtApellidoA'])){$apellidoA='';}else{ $apellidoA= $_POST['txtApellidoA'];}
    if  (empty($_POST['txtOrganismoA'])){$organismoA='';}else{ $organismoA= $_POST['txtOrganismoA'];}
    if  (empty($_POST['txtDepartamentoA'])){$departamentoA='';}else{ $departamentoA= $_POST['txtDepartamentoA'];}
    if  (empty($_POST['txtUsuarioA'])){$UsuarioA='';}else{ $UsuarioA= $_POST['txtUsuarioA'];}
   
    
    //Datos del Form Modificar
    if  (empty($_POST['txtCodigo'])){$codigoModif=0;}else{$codigoModif=$_POST['txtCodigo'];}
    if  (empty($_POST['txtNombreM'])){$nombreM=0;}else{ $nombreM= $_POST['txtNombreM'];}
    if  (empty($_POST['txtApellidoM'])){$apellidoM='';}else{ $apellidoM= $_POST['txtApellidoM'];}
    if  (empty($_POST['txtOrganismoM'])){$organismoM='';}else{ $organismoM= $_POST['txtOrganismoM'];}
    if  (empty($_POST['txtDepartamentoM'])){$departamentoM='';}else{ $departamentoM= $_POST['txtDepartamentoM'];}
    if  (empty($_POST['txtUsuarioM'])){$UsuarioM='';}else{ $UsuarioM= $_POST['txtUsuarioM'];}
    if  (empty($_POST['txtOpcion'])){$activoM='f';}else{ $activoM= 't';}
    
    //DAtos para el Eliminado Logico
    if  (empty($_POST['txtCodigoE'])){$codigoElim=0;}else{$codigoElim=$_POST['txtCodigoE'];}
    
    
        //Si es agregar
        if(isset($_POST['agregar'])){
            if(func_existeDato($nombreA, 'encargado', 'en_nom')==true){
                echo '<script type="text/javascript">
		alert("El Encargado ya existe. Intente ingresar otro Encargado");
                window.location="http://192.168.0.99/SGR/web/encargados/ABMencargado.php";
		</script>';
                }else{              
                //se define el Query   
                $query = "INSERT INTO encargado(en_nom,en_ape,en_estado,org_cod,depar_cod,usu_cod)
                VALUES ('$nombreA','$apellidoA','t',$organismoA,$departamentoA,$UsuarioA);";
                //ejecucion del query
                $ejecucion = pg_query($query)or die('<script type="text/javascript">
		alert("Error al insertar el encargado. Err(108):'.$query.'");
                window.location="http://192.168.0.99/SGR/web/encargados/ABMencargado.php";
		</script>');
                $query = '';
                header("Refresh:0; url=http://192.168.0.99/SGR/web/encargados/ABMencargado.php");
                }
            }
        //si es Modificar    
        if(isset($_POST['modificar'])){
            $query = "update encargado set  en_nom='$nombreM',en_ape= '$apellidoM',en_estado='$activoM',org_cod=$organismoM,depar_cod=$departamentoM,usu_cod=$UsuarioM WHERE en_cod=$codigoModif";
            $ejecucion = pg_query($query) or die('<script type="text/javascript">
            alert("Error al modificar el encargado. Err(108):'.$query.$codigoModif.'");
            window.location="http://192.168.0.99/SGR/web/encargados/ABMencargado.php";
            </script>');
           
            header("Refresh:0; url=http://192.168.0.99/SGR/web/encargados/ABMencargado.php");
        }
        //Si es Eliminar
        if(isset($_POST['borrar'])){
            pg_query("update encargado set en_estado='f' WHERE en_cod=$codigoElim");
            header("Refresh:0; url=http://192.168.0.99/SGR/web/encargados/ABMencargado.php");
	}
