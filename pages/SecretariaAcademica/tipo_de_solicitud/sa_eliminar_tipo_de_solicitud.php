<?php

$maindir = "../../../";
include($maindir."conexion/config.inc.php");  

require_once($maindir."funciones/check_session.php");

require_once($maindir."funciones/timeout.php");
  
if(!isset( $_SESSION['user_id'] ))
{
  header('Location: '.$maindir.'login/logout.php?code=100');
  exit();
}

  try
  {
    $codigo = $_POST['codSolicitud'];
    $stmt = $db->prepare("CALL SP_ELIMINAR_TIPOS_DE_SOLICITUD(?,@mensajeError)");
	     //Introduccion de parametros
    $stmt->bindParam(1, $codigo, PDO::PARAM_STR);

    //echo $codigo . $nombre;
       
     $stmt->execute();
     $output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
     //var_dump($output);
     $mensaje = $output['@mensajeError'];
      
    if (empty($mensaje)){
      $codMensaje=2;
     }
     else {$codMensaje = 1;}   

    }catch(PDOExecption $e){
      $mensaje = 'Error al ingresar el registro o registro actualmente existente.';
      $codMensaje = 0;
    }
    //Se envia resultado
    if($codMensaje == 2){
      echo '<div class="alert alert-danger alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> El registro ha sido eliminado con éxito..!</strong></div>';
    }elseif ($codMensaje == 1) {
      echo '<div class="alert alert-warning alert-succes">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>'.$mensaje.'</strong></div>';
    }
    else{
      echo '<div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Error! </strong>'.$mensaje.'</div>';
  }
?>