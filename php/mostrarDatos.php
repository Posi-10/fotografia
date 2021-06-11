<?php
  require_once 'conexion.php';
  $conexion = conectar();
  $sql = "SELECT * FROM fotografia (id,cant_f,impre_f,med_f,pagar_f)";
  $query = $conexion->prepare($sql);
  $respuesta = $query->execute();
  $query->close();  

  
?>