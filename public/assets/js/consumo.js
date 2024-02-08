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
        console.log(bitacora.Cls_Bitacora);
        if (bitacora.length == undefined) {
            //console.log(bitacora);
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
                    <td style="background-color:white !important;"></td>
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
                        <td style="${style}"></td>
                    </tr>
                `;
                $('#bitacora_table tbody').append(fila);
            }
        }
        else {

        }
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
        $("#estatusDetalle").prepend('<option value="">Selecciona Estatus Detalle</option>');
        //console.log(data.EstatusDetalle); // imprimimos la respuesta
        for (let index = 0; index < data.EstatusDetalle.length; index++) {
            $("#estatusDetalle").prepend("<option value='" + data.EstatusDetalle[index].clave + "'>" + data.EstatusDetalle[index].descrip + "</option>");
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
        $("#horarioContacto").prepend('<option value="">Seleccion Horario de Contactación</option>');
        //console.log(data.RangoContactacion); // imprimimos la respuesta
        for (let index = 0; index < data.RangoContactacion.length; index++) {
            $("#horarioContacto").prepend("<option value='" + data.RangoContactacion[index].id + "'>" + data.RangoContactacion[index].nombre + "</option>");
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
            $("#actividadRealizada").prepend("<option value='" + data.TipoContacto[index].tipoContacto + "'>" + data.TipoContacto[index].Descripcion + "</option>");
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
            $("#actividadProxima").prepend("<option value='" + data.TipoContacto[index].tipoContacto + "'>" + data.TipoContacto[index].Descripcion + "</option>");
        }

        $('#cargador_bitacora').addClass('d-none');
        $('#form_bitacora').removeClass('d-none');
        $('#lista_bitacora').removeClass('d-none');
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

}