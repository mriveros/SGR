
<!--
/*
 * Autor: Marcos A. Riveros.
 * Año: 2015
 * Sistema de Estaciones ONM INTN
 */
-->
        <?php
        function conexionlocal()
        {
            return $dbconn = pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres "
                    . "")or die ('no se pudo conectar a la base de datos');
        } 
        //funcion que selecciona a la base de Datos
       function selectConexion($database){
   
                return $conexion = conexionlocal();

        }
        //funcion para comprobar si existe el mismo dato en la tabla
       function func_existeDato1($dato, $tabla, $columna){
            selectConexion('HansaII');
            $query = "select * from $tabla where $columna = '$dato' ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return true;
            } else {
               return false;
            }
        }
        function obtenerUltimo($tabla,$columna){
            $query = pg_query("select max($columna) from $tabla");
            $row1 = pg_fetch_array($query);
            return $row1[0];
        }
        function obtener($tabla,$columna,$campo,$condicion){
            $query = pg_query("select $columna from $tabla where $campo=$condicion");
            $row1 = pg_fetch_array($query);
            return $row1[0];
        }
         function obtener_codigo_precinto($tabla,$columna,$campo,$condicion,$codigo_precintado){
            $query = pg_query("select $columna from $tabla where $campo=$condicion and pre_activo='t' and pre_estado='Disponible'");
            $row1 = pg_fetch_array($query);
            if ($row1[0]==''){
                $query = pg_query("delete from precintado where prec_cod=$codigo_precintado");
                echo '<script type="text/javascript">
		alert("El Precinto ya ha sido usado o no existe. Vuelva a Generar el Registro");
                window.location="http://localhost/SGR/web/registrar_precintos/registrar_precintos.php";
		</script>';
            }
            return $row1[0];
        }
        function dar_baja_precinto($codigo_precinto){
             $query = pg_query("update precinto set pre_activo='f',pre_estado='Usado' where pre_cod=$codigo_precinto");
            
        }
       function func_existeDatoDetalle1($dato1,$dato2 ,$tabla, $columna1,$columna2, $database){
            selectConexion($database);
            $query = "select * from $tabla where $columna1 = '$dato1' and $columna2 = '$dato2' ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return true;
            } else {
               return false;
            }
        }
       //Funcion para obtener el mes en Letras
       function genMonth_Text($m) { 
        switch ($m) { 
         case '01': $month_text = "Enero"; break; 
         case '02': $month_text = "Febrero"; break; 
         case '03': $month_text = "Marzo"; break; 
         case '04': $month_text = "Abril"; break; 
         case '05': $month_text = "Mayo"; break; 
         case '06': $month_text = "Junio"; break; 
         case '07': $month_text = "Julio"; break; 
         case '08': $month_text = "Agosto"; break; 
         case '09': $month_text = "Septiembre"; break; 
         case '10': $month_text = "Octubre"; break; 
         case '11': $month_text = "Noviembre"; break; 
         case '12': $month_text = "Diciembre"; break; 
        } 
        return ($month_text); 
       }
       function func_existeColor($inicio,$fin,$database){
            selectConexion($database);
            $query = "select * from precinto p,color c,entrega e,stock s  
            where p.pre_nro >= '$inicio' 
            and p.pre_nro <= '$fin' 
            and c.col_cod= s.col_cod 
            and s.st_cod=e.st_cod 
            and p.en_cod=e.en_cod ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>1)
            {
               return true;
            } else {
               return false;
            }
        }
        
                //compara si ya existe el dato del tipo numerico
        function func_existeDato($dato, $tabla, $columna, $database){
            selectConexion($database);
            $query = "select * from $tabla where $columna = '$dato' ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return true;
            } else {
               return false;
            }
        }
         function func_existeDatoDetalle($dato1,$dato2 ,$tabla, $columna1,$columna2, $database){
            selectConexion($database);
            $query = "select * from $tabla where $columna1 = '$dato1' and $columna2 = '$dato2' ;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return true;
            } else {
               return false;
            }
        }
       
        function get_CantidadLetras($m) { 
        switch ($m) { 
         case '1': $cant_text = "Uno"; break; 
         case '2': $cant_text = "Dos"; break; 
         case '3': $cant_text = "Tres"; break; 
         case '4': $cant_text = "Cuatro"; break; 
         case '5': $cant_text = "Cinco"; break; 
         case '6': $cant_text = "Seis"; break; 
         case '7': $cant_text = "Siete"; break; 
         case '8': $cant_text = "Ocho"; break; 
         case '9': $cant_text = "Nueve"; break; 
         case '10': $cant_text = "Diez"; break; 
         case '11': $cant_text = "Once"; break; 
         case '12': $cant_text = "Doce"; break;
         case '13': $cant_text = "Trece"; break; 
         case '14': $cant_text = "Catorce"; break; 
         case '15': $cant_text = "Quince"; break; 
         case '16': $cant_text = "Dieciseis"; break; 
         case '17': $cant_text = "Diecisiete"; break; 
         case '18': $cant_text = "Dieciocho"; break; 
         case '19': $cant_text = "Diecinueve"; break; 
         case '20': $cant_text = "Veinte"; break; 
         case '21': $cant_text = "Veintiuno"; break; 
        } 
        return ($cant_text); 
       } 
       
       function cantidad_Stock($codstock){
            selectConexion('precintos');
            $query = "select rem_stock_actual from remisiones where rem_cod=$codstock;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row = pg_fetch_row($result);
            if ($row[0]>0)
            {
               return $row[0];
            } else {
                return 0;
            }
        }
        
       function cantidad_Stock_Entrega($codentrega){
            selectConexion('PRECINTOS');
            $query = "select s.st_stock_actual from stock s,entrega e where s.st_cod=e.st_cod and e.en_cod=$codentrega;";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row = pg_fetch_row($result);
            if ($row[0]>0)
            {
               
               return $row[0];
            } else {
                return 0;
            }
        }
        
        function func_existePrecinto($dato){
             if($dato==0)
            {
                return " ";
            }
            selectConexion('PRECINTOS');
            $query = "select * from precinto where pre_nro = '$dato' and pre_activo='t';";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            if (pg_num_rows($result)>0)
            {
               return 1;//existe
            } else {
               return 2;//no existe
            }
        }
        function func_existeEmblema($dato){
           
            selectConexion('PRECINTOS');
            $query = "select em_des from emblema where em_cod = '$dato' and em_activo='t';";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row=pg_fetch_row($result);
            if (pg_num_rows($result)>0)
            {
               return $row[0];
            } else {
               return "El codigo de Emblema no Existe..!";
            }
        }
       function func_existeEncargado($dato){
            selectConexion('PRECINTOS');
            $query = "select en_nom || ' '|| en_ape from encargado where en_cod = '$dato' and en_activo='t';";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row=pg_fetch_row($result);
            if (pg_num_rows($result)>0)
            {
               return $row[0];
            } else {
               return "El codigo de Encargado no Existe..!";
            }
        }
       function func_existePrecintador($dato){
            selectConexion('PRECINTOS');
            $query = "select pre_nom || ' '|| pre_ape from precintador where pre_cod = '$dato' and pre_activo='t';";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row=pg_fetch_row($result);
            if (pg_num_rows($result)>0)
            {
               return $row[0];
            } else {
               return "El codigo de Precintador no Existe..!";
            }
        }
        
         function func_ObtenerCodLugar($codusuario){
            selectConexion('PRECINTOS');
            $query = "select pues_cod from puesto_usuario where usu_cod = '$codusuario' and pues_activo='t';";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row=pg_fetch_row($result);
            if (pg_num_rows($result)>0)
            {
               return $row[0];
            } else {
               return "El codigo de Precintador no Existe..!";
            }
        }
        function func_ObtenerDesLugar($codpuesto){
            selectConexion('PRECINTOS');
            $query = "select pues_des from puesto where pues_cod = $codpuesto and pues_activo='t';";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row=pg_fetch_row($result);
            if (pg_num_rows($result)>0)
            {
               return $row[0];
            } else {
               return "El codigo de Precintador no Existe..!";
            }
        }
        function generarCodigo($longitud) {
        $key = '';
        $pattern = '1234567';
        $max = strlen($pattern)+1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
               return $key;
               
        }
        function consultardetalle(){
            $query = "Select max(stock_cod) from stock;";
            $resultado=pg_query($query);
            $row=  pg_fetch_array($resultado);
            $codcabecera=$row[0];
            
            $query = pg_query("select count(stock_cod) from stock_detalle where stock_cod=$codcabecera");
            $row1 = pg_fetch_array($query);
            return $row1[0];
        }
        function validar_stock($stockdetcod){
            selectConexion('SGR');
            $query = "select COALESCE(stockdet_actual,0) AS stockactual from stock_detalle where stockdet_cod=$stockdetcod";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row = pg_fetch_row($result);
              return $row[0];
        }
        function stockcoddet($retirodetcod){
            selectConexion('SGR');
            $query = "select retiro_detalle.stockdet_cod from stock_detalle,retiro_detalle where retiro_detalle.stockdet_cod=stock_detalle.stockdet_cod and retiro_detalle.retidet_cod=$retirodetcod";
            $result = pg_query($query) or die ($query);
            $row = pg_fetch_row($result);
              return $row[0];
        }
        function sumar_stock($retidetcod){
            selectConexion('SGR');
            $query = "select retiro_detalle.retidet_cantidad from retiro_detalle where retidet_cod=$retidetcod";
            $result = pg_query($query) or die ($query);
            $row = pg_fetch_row($result);
              return $row[0];
        }
        function stockdetcod($retirocod){
            selectConexion('SGR');
            $query = "select retiro_detalle.stockdet_cod from stock_detalle,retiro_detalle,retiro where retiro_detalle.stockdet_cod=stock_detalle.stockdet_cod and retiro.reti_cod=retiro_detalle.reti_cod and retiro_detalle.reti_cod=$retirocod";
            $result = pg_query($query) or die ($query);
            $row = pg_fetch_row($result);
              return $row[0];
        }
        function sumando_stock($codigo_detalle){
            selectConexion('SGR');
            $query = "select retiro_detalle.retidet_cantidad from retiro_detalle where stockdet_cod=$codigo_detalle";
            $result = pg_query($query) or die ($query);
            $row = pg_fetch_row($result);
                return $row[0];
        }
          function validar_cantidad($retidetcod){
            selectConexion('SGR');
            $query = "select COALESCE(retidet_cantidad_actual,0) AS canactual from retiro_detalle where retidet_cod=$retidetcod";
            $result = pg_query($query) or die ("Error al realizar la consulta");
            $row = pg_fetch_row($result);
                return $row[0];
        }
        function retirocoddet($migcod){
            selectConexion('SGR');
            $query = "select migracion_producto.retidet_cod from
            migracion_producto,retiro_detalle where 
            retiro_detalle.retidet_cod=migracion_producto.retidet_cod and migracion_producto.mig_cod=$migcod";
            $result = pg_query($query) or die ($query);
            $row = pg_fetch_row($result);
                return $row[0];
        }
        function sumar_cantidad($migracod){
            selectConexion('SGR');
            $query = "select migracion_producto.mig_cantidad from migracion_producto where mig_cod=$migracod";
            $result = pg_query($query) or die ($query);
            $row = pg_fetch_row($result);
                return $row[0];
        }
       

