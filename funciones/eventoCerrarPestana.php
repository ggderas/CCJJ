<?php  
	session_start();
	$user_ID = $_SESSION['user_id'];
	include "../conexion/conn.php";
	$query = "UPDATE usuario SET Logeado = 0 where usuario_ID = '".$user_ID."' ;";
	$result = mysql_query($query, $conexion) or die("error en la consulta");
	$_SESSION = array();
	session_destroy();
?>