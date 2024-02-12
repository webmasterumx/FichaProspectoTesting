/**
 * en esta funcion se llenara solo los inputs de informacion y edicion
 */

function llenarInputs(infoProspecto) {
    //? inputs de información
    $('#folio_crm_info').val(infoProspecto.folioCRM);
    $('#matricula_info').val(infoProspecto.matricula);
    $('#prospecto_info').val(infoProspecto.nombreCompleto);
    $('#promotor_propietario_info').val(infoProspecto.promotorPropietario);
    $('#saldo_actual').val(infoProspecto.saldoActual);
    $('#referido_por_info').val('Tu referido: ' + infoProspecto.referido);

    //! inputs de edicion
    $('#nombre_form').val(infoProspecto.nombre);
    $('#apellidos_form').val(infoProspecto.apPaterno);
    $('#apellido_mat_form').val(infoProspecto.apMaterno);
    $('#telefono_uno').val(infoProspecto.telefono1);
    $('#telefono_dos').val(infoProspecto.telefono2);
    $('#celular_uno').val(infoProspecto.celular1);
    $('#celular_dos').val(infoProspecto.celular2);
    $('#email_form').val(infoProspecto.email);

    //* info cabcera
    $('#nombreProspecto').html('<i class="bi bi-file-person-fill"></i> Ficha Prospecto: ' + infoProspecto.nombreCompleto)

}

/**
 * funcion para llenar la lista de redes
 * @param {*} listRedes 
 */
function establecer_redes(listRedes) {
    if (listRedes.length == 0) {
        //console.log('no se hace nada puesto que no tiene redes');
    } else {
        //console.log('se accede a la otra variable para imprimir las redes con nombre');
        let arrayRedes = listRedes.Cls_RedesSociales;
        for (let index = 0; index < arrayRedes.length; index++) {
            const element = arrayRedes[index];
            //console.log(element);
            let fila = `
            <tr>
                <td>${element.descripcion}</td>
                <td>${element.userName}</td>
            </tr>
            `;

            $('#listRedes tbody').append(fila);
        }
    }
}

/**
 * establce el color de la etiqueta de estatus
 * @param {*} nombre 
 */
function establecer_color(nombre, ultimoEstatusDetalle) {
    console.log(nombre);
    $('#status_detalle').html('' + ultimoEstatusDetalle);

    switch (nombre) {
        case "Green":
            $('#status_detalle').addClass('text-bg-success');
            break;
        case "Yellow":
            $('#status_detalle').addClass('text-bg-warning');
            break;
        case "Black":
            $('#status_detalle').addClass('bg-black');
            break;
        case "Gray":
            $('#status_detalle').addClass('bg-secondary');
            break;
        case "Red":
            $('#status_detalle').addClass('bg-danger');
            break;
        case "Blue":
            $('#status_detalle').addClass('bg-primary');
            break;
        case "Purple":
            $('#status_detalle').addClass('bg-purple');
            break;
        case "Cyan":
            $('#status_detalle').addClass('bg-cyan');
            break;
        default:
            break;
    }
}

/**
 * establce los datos del promotor operador y pinta el formato de la fecha actual 
 * @param {*} infoPromotor 
 * @param {*} dateInfo 
 */
function printInfoPromotor(infoPromotor, dateInfo) {

    let lineaPromotor = '<i class="bi bi-person-fill"></i> ' + infoPromotor.nombre;
    let lineaFecha = '<i class="bi bi-clock"></i> ' + dateInfo.nombreDiaSemana + ', ' + dateInfo.diaMes + ' de ' +
        dateInfo.nombreMes + ' de ' + dateInfo.año;

    $('#namePromotor').html(lineaPromotor);
    $('#datePromotor').html(lineaFecha);
}

/**
 * establece el color de los numero de telefono
 * @param {*} infoProspecto 
 */
function establecerNumeros(infoProspecto) {
    if (infoProspecto.celular1 == "") {
        $('#etiqueta_celular_uno').addClass('bg-danger');
        $('#etiqueta_celular_uno').html('<i class="bi bi-x-circle-fill"></i>');
    } else {
        $('#etiqueta_celular_uno').addClass('bg-success');
        $('#etiqueta_celular_uno').html('<i class="bi bi-check-circle-fill"></i>');
    }
    if (infoProspecto.celular2 == "") {
        $('#etiqueta_celular_dos').addClass('bg-danger');
        $('#etiqueta_celular_dos').html('<i class="bi bi-x-circle-fill"></i>');
    } else {
        $('#etiqueta_celular_dos').addClass('bg-success');
        $('#etiqueta_celular_dos').html('<i class="bi bi-check-circle-fill"></i>');
    }
    if (infoProspecto.telefono1 == "") {
        $('#etiqueta_telefon_uno').addClass('bg-danger');
        $('#etiqueta_telefon_uno').html('<i class="bi bi-x-circle-fill"></i>');
    } else {
        $('#etiqueta_telefon_uno').addClass('bg-success');
        $('#etiqueta_telefon_uno').html('<i class="bi bi-check-circle-fill"></i>');
    }
    if (infoProspecto.telefono2 == "") {
        $('#etiqueta_telefono_dos').addClass('bg-danger');
        $('#etiqueta_telefono_dos').html('<i class="bi bi-x-circle-fill"></i>');
    } else {
        $('#etiqueta_telefono_dos').addClass('bg-success');
        $('#etiqueta_telefono_dos').html('<i class="bi bi-check-circle-fill"></i>');
    }
}