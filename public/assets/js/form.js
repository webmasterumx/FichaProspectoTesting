$("#formReferido").validate({
    rules: {
        nombreReferido: {
            required: true,
        },
        apellidoPaternoReferido: {
            required: true,
        },
        apellidoMaternoReferido: {
            required: true,
        },
        telefonoReferido: {
            required: true,
        },
        emailReferido: {
            required: true,
            email: true
        }
    },
    messages: {
        nombreReferido: {
            required: "campo requerido"
        },
        apellidoPaternoReferido: {
            required: "campo requerido"
        },
        apellidoMaternoReferido: {
            required: "campo requerido"
        },
        telefonoReferido: {
            required: "campo requerido"
        },
        emailReferido: {
            required: "campo requerido",
            email: "correo no valido"
        },
    },
    submitHandler: function (form) {
        $('#enviarReferido').attr('disabled', true);
        $('#cargador_referidos').removeClass('d-none');
        if ($("#dataReferidos").hasClass("d-none") === false) {
            $('#dataReferidos').addClass('d-none');
        }

        let data = new FormData(form);
        let typeTelefono = data.get('telefonoReferidoType[]');
        let nombreP = data.get('nombreReferido');
        let apellidoPP = data.get('apellidoPaternoReferido');
        let apellidoMP = data.get('apellidoMaternoReferido');
        let telefonoP = data.get('telefonoReferido');
        let emailP = data.get('emailReferido');
        let ruta = setBaseURL() + 'guardar/referido/?telefonoReferidoType=' + typeTelefono + '&nombreReferido=' + nombreP + '&apellidoPaternoReferido=' + apellidoPP + '&apellidoMaternoReferido=' + apellidoMP + '&telefonoReferido=' + telefonoP + '&emailReferido=' + emailP + "&folioCRM=" + setFolioCrm() + "&promotor=" + setPromotor();

        let xhr = new XMLHttpRequest();

        // 2. Configuración: solicitud GET para la URL /article/.../load
        xhr.open('GET', ruta);

        // 3. Envía la solicitud a la red
        xhr.send();

        // 4. Esto se llamará después de que la respuesta se reciba
        xhr.onload = function () {
            if (xhr.status != 200) { // analiza el estado HTTP de la respuesta
                console.log(`Error ${xhr.status}: ${xhr.statusText}`); // ej. 404: No encontrado
            } else { // muestra el resultado
                console.log(`Hecho, obtenidos ${xhr.response.length} bytes`); // Respuesta del servidor
                console.log("respuesta: " + xhr.response);

                if (xhr.response == true || xhr.response == 1) {
                    $('#messageConfirmacion').html('Referido agregado con exito')
                    $("#modal_confirmacion").modal("show");
                    $('#enviarReferido').attr('disabled', false);

                    getReferidos();
                }
                else {

                }
            }
        };

        xhr.onprogress = function (event) {
            if (event.lengthComputable) {
                console.log(`Recibidos ${event.loaded} de ${event.total} bytes`);
            } else {
                console.log(`Recibidos ${event.loaded} bytes`); // sin Content-Length
            }

        };

        xhr.onerror = function () {
            console.log("Solicitud fallida");
        };

        form.reset();
    }
});

$("#formBitacora").validate({
    rules: {
        actividadRealizada: {
            required: true,
        },
        estatusDetalle: {
            required: true,
        },
        comentariosBitacora: {
            required: true,
        }
    },
    messages: {
        actividadRealizada: {
            required: "campo requerido",
        },
        estatusDetalle: {
            required: "campo requerido"
        },
        comentariosBitacora: {
            required: "campo requerido"
        }
    },
    submitHandler: function (form) {
        $('#enviarActividad').attr('disabled', true);
        $('#cargador_bitacora').removeClass('d-none');
        if ($("#form_bitacora").hasClass("d-none") === false || $("#lista_bitacora").hasClass("d-none") === false) {
            $('#form_bitacora').addClass('d-none');
            $('#lista_bitacora').addClass('d-none');
        }

        let data = new FormData(form);
        let actividadRealizada = $('select[name=actividadRealizada]').val();
        let estatusDetalle = $('select[name=estatusDetalle]').val();
        let proximaActividad = $('select[name=actividadProxima]').val();
        let fecha = $('#date_bitacora').val();
        let horarioContacto = $('select[name=horarioContacto]').val();
        let comentarios = $('#comentariosBitacora').val();
        let promotor = setPromotor();

        let ruta = setBaseURL() + "guardar/bitacora/?folio_crm=" + setFolioCrm() + "&actividadRealizada=" + actividadRealizada + "&estatusDetalle=" + estatusDetalle + "&actividadProxima=" + proximaActividad + "&date_bitacora=" + fecha + "&horarioContacto=" + horarioContacto + "&comentariosBitacora=" + comentarios + "&promotor=" + promotor;
        console.log(ruta);
        let xhr = new XMLHttpRequest();

        // 2. Configuración: solicitud GET para la URL /article/.../load
        xhr.open('GET', ruta);

        // 3. Envía la solicitud a la red
        xhr.send();

        // 4. Esto se llamará después de que la respuesta se reciba
        xhr.onload = function () {
            if (xhr.status != 200) { // analiza el estado HTTP de la respuesta
                console.log(`Error ${xhr.status}: ${xhr.statusText}`); // ej. 404: No encontrado
            } else { // muestra el resultado
                console.log(`Hecho, obtenidos ${xhr.response.length} bytes`); // Respuesta del servidor
                console.log("respuesta: " + xhr.response);

                if (xhr.response == true || xhr.response == 1) {
                    $('#messageConfirmacion').html('Datos guardados con exito')
                    $("#modal_confirmacion").modal("show");
                    $('#enviarActividad').attr('disabled', false);
                    getBitacora();
                }
                else {

                }
            }
        };

        xhr.onprogress = function (event) {
            if (event.lengthComputable) {
                console.log(`Recibidos ${event.loaded} de ${event.total} bytes`);
            } else {
                console.log(`Recibidos ${event.loaded} bytes`); // sin Content-Length
            }

        };

        xhr.onerror = function () {
            console.log("Solicitud fallida");
        };

        form.reset();
    }
});

$("#form_search").validate({
    rules: {
        text_crm: {
            required: true,
        }
    },
    messages: {
        text_crm: {
            required: "campo requerido",
        }
    },
    submitHandler: function (form) {
        form.preventDefault();
        searchProspecto();

    }
});
