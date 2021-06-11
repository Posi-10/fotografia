<?php
  require_once 'conexion.php';
  $conexion = conectar();
  $numero_fotos = $_POST["numero_fotos"];
  $tono_foto = $_POST["tono_foto"];
  $tamanio_foto = $_POST["tamanio_foto"];
  $total_pagar = $_POST["total_pagar"];
  $sql = "INSERT INTO precio (cant_f, impre_f, med_f, pagar_f) VALUES (?,?,?,?)";
  $query = $conexion->prepare($sql);
  $query->bind_param('ssss', $numero_fotos,
					          $tono_foto,
                    $tamanio_foto,
                    $total_pagar);
  $respuesta = $query->execute();
  $query->close();
?>
