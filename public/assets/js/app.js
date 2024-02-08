

function limpiarTabla() {
    $('#table_search > tbody').empty();

    if ($("#dataBuscador").hasClass("d-none") === false) {
        $('#dataBuscador').addClass('d-none');
    }
}

function searchProspecto() {
    $('#table_search > tbody').empty();
    $('#cargador').removeClass('d-none');
    if ($("#dataBuscador").hasClass("d-none") === false) {
        $('#dataBuscador').addClass('d-none');
    }

    var formElement = document.getElementById("form_search");
    formData = new FormData(formElement);

    let search_type = formData.get('search_crm[]');
    let search_text = $('#text_crm').val();
    let search_plantel = $('select[name=plantel_search]').val();

    let ruta = setBaseURL() + "search/crm/" + search_type + "/" + search_text + "/" + search_plantel;

    console.log(ruta);

    if (search_text == null || search_text == "" || search_text == " ") {
        $('#label-error-text').removeClass('d-none');
    } else {
        $('#label-error-text').addClass('d-none');

        $.ajax({
            url: ruta,
            method: "GET",
            dataType: 'json',
        }).done(function (data) {
            $('#cargador').removeClass('d-none');
            console.log(data.length); // imprimimos la respuesta
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                //console.log(element);
                let rutaPros = setBaseURL() + "?folio_crm=" + element.folioCRM + "&promotor=" + setPromotor();
                //console.log(rutaPros);
                cont = index + 1;
                if (cont % 2 !== 0) {
                    //numero inpar
                    style = "background-color:white !important;";
                }
                if (cont % 2 === 0) {
                    //numero par
                    style = "background-color:#D3DFE8 !important;";
                }
                let fila = `
                    <tr>
                        <td style="${style}"><a href="${rutaPros}">${element.folioCRM}</a></td>
                        <td style="${style}">${element.nombreCompleto}</td>
                        <td style="${style}">${element.telefono1}</td>
                        <td style="${style}">${element.telefono2}</td>
                        <td style="${style}">${element.celular1}</td>
                        <td style="${style}">${element.celular2}</td>
                        <td style="${style}">${element.email}</td>
                    </tr>
                `;
                $('#table_search tbody').append(fila);
            }
            $('#cargador').addClass('d-none');
            $('#dataBuscador').removeClass('d-none');
        }).fail(function (e) {
            console.log("Request: " + JSON.stringify(e));
        })
    } 


}

function mostrarEdicionProspecto() {
    console.log('hola');
    $('#mensajes_whatsapp').addClass('d-none');

    $('#editar_prospecto').removeClass('d-none');
}

function actualizarReferido() {
    
    let claveCampana = $('select[name=campana_info]').val();
    let clavePlantel = $('select[name=plantel_info]').val();
    let claveNivel = $('select[name=nivel_info]').val();
    let claveCarrera = $('select[name=carrera_info]').val();
    let claveHorario = $('select[name=horario_info]').val();
    console.log(claveHorario);

    if ((claveCampana == "") || (claveCampana == null) || (claveCampana == undefined) || (claveCampana == " ") || (claveCampana == 0)) {
        $('#campana_info_error').removeClass('d-none');
    }
    else if ((clavePlantel == "") || (clavePlantel == null) || (clavePlantel == undefined) || (clavePlantel == " ") || (clavePlantel == 0)) {
        $('#plantel_info_error').removeClass('d-none');
    }
    else if ((claveNivel == "") || (claveNivel == null) || (claveNivel == undefined) || (claveNivel == " ") || (claveNivel == 0)) {
        $('#nivel_info_error').removeClass('d-none');
    }
    else if ((claveCarrera == "") || (claveCarrera == null) || (claveCarrera == undefined) || (claveCarrera == " ") || (claveCarrera == 0)) {
        $('#carrera_info_error').removeClass('d-none');
    }
    else if ((claveHorario == "default") || (claveHorario == null) || (claveHorario == undefined) || (claveHorario == " ") || (claveHorario == 0)) {
        $('#horario_info_error').removeClass('d-none');
    }
    else {

        $('#modal_carga').modal('show');
        let claveCampana = $('select[name=campana_info]').val();
        let clavePlantel = $('select[name=plantel_info]').val();
        let claveNivel = $('select[name=nivel_info]').val();
        let claveCarrera = $('select[name=carrera_info]').val();
        let claveHorario = $('select[name=horario_info]').val();
        let nombre_form = $('#nombre_form').val();
        let apellidos_form = $('#apellidos_form').val();
        let apellido_mat_form = $('#apellido_mat_form').val();
        let telefono_uno = $('#telefono_uno').val();
        let telefono_dos = $('#telefono_dos').val();
        let celular_uno = $('#celular_uno').val();
        let celular_dos = $('#celular_dos').val();
        let email_form = $('#email_form').val()
        let folio_crm = setFolioCrm();

        let ruta = setBaseURL() + "guardar/datos/prospecto?claveCampana=" + claveCampana + "&clavePlantel=" + clavePlantel + "&claveNivel=" + claveNivel + "&claveCarrera=" + claveCarrera + "&claveHorario=" + claveHorario + "&nombre_form=" + nombre_form + "&apellidos_form=" + apellidos_form + "&apellido_mat_form=" + apellido_mat_form + "&telefono_uno=" + telefono_uno + "&telefono_dos=" + telefono_dos + "&celular_uno=" + celular_uno + "&celular_dos=" + celular_dos + "&email_form=" + email_form + "&folio_crm=" + folio_crm;
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
                    $('#modal_carga').modal('hide');
                    $('#messageConfirmacion').html('Datos del prospecto guardados con exito')
                    $("#modal_confirmacion").modal("show");
                }
                else {

                }
            }
        };

    }

}
