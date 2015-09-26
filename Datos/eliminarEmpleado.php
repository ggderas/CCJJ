<?php

require_once('funciones.php');


$enlace = mysql_connect('mysqlv115', 'ddvderecho', 'DDVD3recho');
mysql_select_db("ccjj", $enlace);


if (isset($_POST['codigoE'])) {
    $id=$_POST['codigoE'];
     $fecha=date("Y-m-d");
    
     $query=mysql_query("DELETE from  empleado WHERE No_Empleado='".$id."'");
   

     
    if($query){
    
    echo mensajes('empleado con codigo"'.$id .'" ha sido dado de alta con Exito', 'verde');
    }
    else
        {
        echo mensajes(mysql_error(), 'rojo');
    echo mensajes('NO se puede dar de alta al empleado con codigo"'.$id . '"', 'rojo');
        
    }
}


?>