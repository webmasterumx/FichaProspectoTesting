

function limpiarTabla() {
    $('#table_search > tbody').empty();

    if ($("#dataBuscador").hasClass("d-none") === false) {
        $('#dataBuscador').addClass('d-none');
    }

    $('#text_crm').val("");
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

        $('#text_carga').html('Guardando datos..');
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

function llenarComboPlantel() {
    let ruta = setBaseURL() + 'get/planteles';
    $('#plantel_search').empty();

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const plateles = data;
        let option_default = `<option value="0">Seleciona un plantel</option>`;
        if (plateles != undefined) {
            $("#plantel_search").append(option_default); //se establece el plantel por defecto
            for (let index = 0; index < plateles.length; index++) { //recorrer el array de planteles
                const element = plateles[index]; // se establece un elemento por plantel optenida
                let option = `<option value="${element.clave}">${element.descrip}</option>`; //se establece la opcion por campaña
                $("#plantel_search").append(option); // se inserta la platel de cada elemento
            }
        }
        else {
            $("#plantel_search").append(option_default);
        }

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}

function llenarComboPromotores() {
    $("#promotor_info").empty();
    let promotor = setPromotor();
    let ruta = setBaseURL() + 'obtener/listado/callcenter/' + promotor;
    $('#plantel_search').empty();

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data);
        const promotores = data.Cls_Promotores;
        let option_default = `<option value="0">Seleciona un promotor</option>`;
        if (promotores != undefined) {
            $("#promotor_info").append(option_default); //se establece el plantel por defecto
            for (let index = 0; index < promotores.length; index++) { //recorrer el array de planteles
                const element = promotores[index]; // se establece un elemento por plantel optenida
                let option = `<option value="${element.claveUsuario}">${element.nombre}</option>`; //se establece la opcion por campaña
                $("#promotor_info").append(option); // se inserta la platel de cada elemento
            }
        }
        else {
            $("#promotor_info").append(option_default);
        }

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}