<?php
    require_once "php/conexion.php";
    $conexion = conectar();
    $sql = "SELECT id,cant_f,impre_f,med_f,pagar_f FROM precio;";
    $result = mysqli_query($conexion, $sql);
    $datos = $result;
?>
<!doctype html>
<html lang="es">

<head>
    <title>Fotografias</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="librerias/fontawesome/css/all.css">
    <link rel="stylesheet" href="librerias/sweetalert/css/sweetalert2.css">
    <link rel="stylesheet" href="librerias/datatable/jquery.dataTables.css">
</head>

<body>
    <div class="container py-4">
        <div class="row align-items-md-stretch">
            <div class="col">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <p class="h4">Impresion Digital</p>
                    <form method="POST" class="p-2" id="form_fotografia" name="form_fotografia">
                        <div class="p-2">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="numero_fotos" class="col-form-label"><p class="h5">Cantidad de Fotos:</p></label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="numero_fotos" name="numero_fotos" class="form-control">
                                </div>
                            </div>
                            <div class="m-2 p-2">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="tono_foto" class="col-form-label"><p class="h5">Impresion Digital</p></label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" id="color_foto" name="tono_foto">
                                            <option selected value="0">Selecciona tu Color</option>
                                            <option value="Blanco y Negro">Blanco y Negro</option>
                                            <option value="Color">Color</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="m-2 p-2">
                                <div class="mb-3">
                                    <div class="card text-white bg-secondary border-0">
                                        <div class="card-header"><label for="tamanio_foto" class="form-label"><p class="h5">Medidas</p></label></div>
                                        <div class="card-body">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="tamanio_foto" id="tamanio_foto_3x4">
                                                        <label class="form-check-label" for="tamanio_foto_3x4" value="3x4">3 x 4</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="tamanio_foto" id="tamanio_foto_5x7">
                                                        <label class="form-check-label" for="tamanio_foto_5x7" value="5x7">5 x 7</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="tamanio_foto" id="tamanio_foto_4x6">
                                                        <label class="form-check-label" for="tamanio_foto_4x6" value="4x6">4 x 6</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="tamanio_foto" id="tamanio_foto_6x8">
                                                        <label class="form-check-label" for="tamanio_foto_6x8" value="6x8">6 x 8</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-sm-5 align-self-center d-grid gap-2">
                                    <span class="btn btn-outline-info" id="btn_calcular">Calcular</span>
                                </div>
                                <div class="col-sm-5 align-self-center">
                                    <div class="mb-3">
                                        <label for="total_pagar" class="form-label"><p class="h5">Cantidad a Pagar</p></label>
                                        <input type="text" class="form-control" id="total_pagar" name="total_pagar"  disabled>
                                        <span id="ver_tabla" class="btn btn-secondary btn-sm mt-1 mr-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver tabla</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-sm-6 d-grid gap-2">
                                <span class="btn btn-outline-danger">Limpiar</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-dark" id="mi_tabla">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Tipo de Fotografia</th>
                                    <th scope="col">Medidas</th>
                                    <th scope="col">Total a pagar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($datos as $key){
                            ?>
                                <tr>
                                    <td><?php echo $key['id'];?></td>
                                    <td><?php echo $key['cant_f'];?></td>
                                    <td><?php echo $key['impre_f'];?></td>
                                    <td><?php echo $key['med_f'];?></td>
                                    <td><?php echo $key['pagar_f'];?></td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="librerias/jquery/jquery-3.6.0.js"></script>
    <script src="librerias/popper/popper.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.js"></script>
    <script src="librerias/fontawesome/js/all.js"></script>
    <script src="librerias/sweetalert/js/sweetalert2.js"></script>
    <script src="librerias/datatable/jquery.dataTables.js"></script>
    <script src="js/main.js"></script>
    <script src="js/tabla.js"></script>
</body>

</html>