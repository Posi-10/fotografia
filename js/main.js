$(document).ready(() => {

    $('#numero_fotos').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function variables() {
        numero_f = $('#numero_fotos').val();
        color_f = $('#color_foto').val();
    }

    function precio(color, precioBN, precioC, fotos) {
        if (color == "Blanco y Negro") {
            return pecioT = precioBN * fotos;
        } else if (color == "Color") {
            return pecioT = precioC * fotos;
        } else {
            return false;
        }
    }

    function tamano() {
        variables();
        error();
        tamanio_f = "";
        if ($('#tamanio_foto_3x4').is(':checked')) {

            if (numero_f == 0 || numero_f == "") {
                Swal.fire(
                    'Error',
                    'Especifica la cantidad de fotos ',
                    'error'
                )
                return false;
            } else if (color_f == 0) {
                Swal.fire(
                    'Error',
                    'Selecciona un formato de imagen "Blanco/negro" o "color" ',
                    'error'
                )
                return false;
            } else {
                precio_t = precio(color_f, 4, 5.50, numero_f);
                tamanio_f = "Tamaño 3x4";
            }
        } else if ($('#tamanio_foto_5x7').is(':checked')) {

            if (numero_f == 0 || numero_f == "") {
                Swal.fire(
                    'Error',
                    'Especifica la cantidad de fotos ',
                    'error'
                )
                return false;
            } else if (color_f == 0) {
                Swal.fire(
                    'Error',
                    'Selecciona un formato de imagen "Blanco/negro" o "color" ',
                    'error'
                )
                return false;
            } else {
                precio_t = precio(color_f, 6, 7.50, numero_f);
                tamanio_f = "Tamaño 5x7";
            }
        } else if ($('#tamanio_foto_4x6').is(':checked')) {

            if (numero_f == 0 || numero_f == "") {
                Swal.fire(
                    'Error',
                    'Especifica la cantidad de fotos ',
                    'error'
                )
                return false;
            } else if (color_f == 0) {
                Swal.fire(
                    'Error',
                    'Selecciona un formato de imagen "Blanco/negro" o "color" ',
                    'error'
                )
                return false;
            } else {
                precio_t = precio(color_f, 5.20, 6.20, numero_f);
                tamanio_f = "Tamaño 4x6";
            }

        } else if ($('#tamanio_foto_6x8').is(':checked')) {

            if (numero_f == 0 || numero_f == "") {
                Swal.fire(
                    'Error',
                    'Especifica la cantidad de fotos ',
                    'error'
                )
                return false;
            } else if (color_f == 0) {
                Swal.fire(
                    'Error',
                    'Selecciona un formato de imagen "Blanco/negro" o "color" ',
                    'error'
                )
                return false;
            } else {
                precio_t = precio(color_f, 7.90, 9, numero_f);
                tamanio_f = "Tamaño 6x8";
            }

        } else {
            Swal.fire(
                'Error',
                'Selecciona una de las opciones de tamaño "3x4" por ejemplo',
                'error'
            )
            return false;


        }

    }

    function error() {

    }

    $('#btn_calcular').click(() => {
        tamano();
        $('#total_pagar').val(Intl.NumberFormat("ja-JP", { style: "currency", currency: "USD" }).format(precio_t));
        Swal.fire({
            title: 'Antes de continuar',
            showDenyButton: true,
            confirmButtonText: `Quieres guardar el registro?`,
            denyButtonText: `No gracias :D`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {


                $.ajax({
                    type: "POST",
                    data: {
                        "numero_fotos": numero_f.toString(),
                        "tono_foto": color_f.toString(),
                        "tamanio_foto": tamanio_f.toString(),
                        "total_pagar": precio_t.toString()
                    },
                    url: "php/introducirDatos.php",
                    success: function(r) {
                        window.location.reload();
                        r = r.trim();
                        console.log(r);
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('No se guardo el registro', '', 'info')
            }
        })

    });

    $("#btn_limpiar").click(() => {
        $("#form_fotografia")[0].reset();
    });

});
error();
Swal.fire({
    title: 'Antes de continuar',
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Quieres guardar el registro?`,
    denyButtonText: `No gracias :D`,
}).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
        Swal.fire('Guardado con exito', '', 'success')
        $.ajax({
            type: "POST",
            data: {
                "numero_fotos": numero_f.toString(),
                "tono_foto": color_f.toString(),
                "tamanio_foto": tamanio_f.toString(),
                "total_pagar": precio_t.toString()
            },
            url: "php/introducirDatos.php",
            success: function(r) {
                window.location.reload();
                r = r.trim();
                console.log(r);
            }
        });
    } else if (result.isDenied) {
        Swal.fire('No se guardo el registro', '', 'info')
    }
})