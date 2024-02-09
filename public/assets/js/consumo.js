function getReferidos() {
    $('#table_referidos > tbody').empty();
    $('#cargador_referidos').removeClass('d-none');
    if ($("#dataReferidos").hasClass("d-none") === false) {
        $('#dataReferidos').addClass('d-none');
    }

    let folio_crm = setFolioCrm();
    let ruta = setBaseURL() + "optener/referidos/" + folio_crm;

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data); // imprimimos la respuesta
        for (let index = 0; index < data.length; index++) {
            const element = data[index];
            let rutaPros = setBaseURL() + "?folio_crm=" + element.folioCRM + "&promotor=" + setPromotor();
            //console.log(element);
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
            $('#table_referidos tbody').append(fila);
        }
        $('#cargador_referidos').addClass('d-none');
        $('#dataReferidos').removeClass('d-none');
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })
}

function getBitacora() {

    $('#bitacora_table > tbody').empty();
    $("#estatusDetalle").empty();
    $("#horarioContacto").empty();
    $("#actividadRealizada").empty();
    $("#actividadProxima").empty();
    $('#cargador_bitacora').removeClass('d-none');

    if ($("#form_bitacora").hasClass("d-none") === false || $("#lista_bitacora").hasClass("d-none") === false) {
        $('#form_bitacora').addClass('d-none');
        $('#lista_bitacora').addClass('d-none');
    }

    let folio_crm = setFolioCrm();
    let promotor = setPromotor();
    let ruta = setBaseURL() + "getFichaProspecto/" + folio_crm + "/" + promotor;

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data); // imprimimos la respuesta
        let bitacora = data.infoProspecto.listaBitacoraSeguimiento.Cls_Bitacora;
        let nombre = data.infoProspecto.termometro;
        let ultimoEstatusDetalle = data.infoProspecto.ultimoEstatusDetalle;

        if (bitacora.length == undefined) {
            //console.log(bitacora);
            if (bitacora.cerrado == false) {
                iconoCerrado = '<i class="bi bi-app"></i>';
            } else {
                iconoCerrado = '<i class="bi bi-check-square"></i>';
            }
            let fila = `
                <tr>
                    <td style="background-color:white !important;">${bitacora.fechaAgenda}</td>
                    <td style="background-color:white !important;">${bitacora.promotorActividad}</td>
                    <td style="background-color:white !important;">${bitacora.actividadRealizada}</td>
                    <td style="background-color:white !important;">${bitacora.estatusDetalle}</td>
                    <td style="background-color:white !important;">${bitacora.actividad}</td>
                    <td style="background-color:white !important;">${bitacora.fechaHoraCaptura}</td>
                    <td style="background-color:white !important;">${bitacora.tipoContacto}</td>
                    <td style="background-color:white !important;">${bitacora.promotorPropietario}</td>
                    <td class="text-center" style="background-color:white !important; color: #327AB7 !important; font-size: 22px !important;">${iconoCerrado}</td>
                </tr>
            `;
            $('#bitacora_table tbody').append(fila);
        }
        else if (bitacora.length != undefined) {
            for (let index = 0; index < bitacora.length; index++) {
                const element = bitacora[index];
                //console.log(element);
                cont = index + 1;
                if (cont % 2 !== 0) {
                    //numero inpar
                    style = "background-color:white !important;";
                }
                if (cont % 2 === 0) {
                    //numero par
                    style = "background-color:#D3DFE8 !important;";
                }

                if (element.cerrado == false) {
                    iconoCerrado = '<i class="bi bi-app"></i>';

                } else {
                    iconoCerrado = '<i class="bi bi-check-square"></i>';
                }

                let fila = `
                    <tr>
                        <td style="${style}">${element.fechaAgenda}</td>
                        <td style="${style}">${element.promotorActividad}</td>
                        <td style="${style}">${element.actividadRealizada}</td>
                        <td style="${style}">${element.estatusDetalle}</td>
                        <td style="${style}">${element.actividad}</td>
                        <td style="${style}">${element.fechaHoraCaptura}</td>
                        <td style="${style}">${element.tipoContacto}</td>
                        <td style="${style}">${element.promotorPropietario}</td>
                        <td class="text-center" style="${style} color: #327AB7 !important; font-size: 22px !important;">${iconoCerrado}</td>
                    </tr>
                `;
                $('#bitacora_table tbody').append(fila);
            }
        }
        else {

        }

        establecer_color(nombre, ultimoEstatusDetalle);
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

    //llenar combos

    let combo1 = setBaseURL() + "obtener/estados";
    let combo2 = setBaseURL() + "obtener/horariosContacto";
    let combo3 = setBaseURL() + "obtener/actividadesRealizadas/" + 1;
    let combo4 = setBaseURL() + "obtener/actividadesProximas/" + 2

    $.ajax({
        url: combo1,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data);
        const EstatusDetalle = data.EstatusDetalle;
        $("#estatusDetalle").append('<option value="">Selecciona Estatus Detalle</option>');
        for (let index = 0; index < EstatusDetalle.length; index++) {
            let option = `<option value="${EstatusDetalle[index].clave}" data-id="${EstatusDetalle[index].grp_Id}">${EstatusDetalle[index].descrip}</option>`;
            $("#estatusDetalle").append(option);
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

    $.ajax({
        url: combo2,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        //console.log(data);
        $("#horarioContacto").append('<option value="0">Seleccion Horario de Contactación</option>');
        //console.log(data.RangoContactacion); // imprimimos la respuesta
        for (let index = 0; index < data.RangoContactacion.length; index++) {
            $("#horarioContacto").append("<option value='" + data.RangoContactacion[index].id + "'>" + data.RangoContactacion[index].nombre + "</option>");
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

    $.ajax({
        url: combo3,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        //console.log(data);
        //console.log(data.TipoContacto); // imprimimos la respuesta
        for (let index = 0; index < data.TipoContacto.length; index++) {
            $("#actividadRealizada").append("<option value='" + data.TipoContacto[index].tipoContacto + "'>" + data.TipoContacto[index].Descripcion + "</option>");
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

    $.ajax({
        url: combo4,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        //console.log(data);
        //console.log(data.TipoContacto); // imprimimos la respuesta
        for (let index = 0; index < data.TipoContacto.length; index++) {
            $("#actividadProxima").append("<option value='" + data.TipoContacto[index].tipoContacto + "'>" + data.TipoContacto[index].Descripcion + "</option>");
        }

        $('#cargador_bitacora').addClass('d-none');
        $('#form_bitacora').removeClass('d-none');
        $('#lista_bitacora').removeClass('d-none');
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

    getViabilidadMatriculacion();

}

function getViabilidadMatriculacion() {
    let folio_crm = setFolioCrm();
    let url = setBaseURL() + "viabilidad/matriculacion/" + folio_crm;
    $.ajax({
        url: url,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data);
        if (data == true || data == 1) {
            $('#enviarActividad').attr('disabled', false);
        }
        else {
            $('#enviarActividad').attr('disabled', true);
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })
}