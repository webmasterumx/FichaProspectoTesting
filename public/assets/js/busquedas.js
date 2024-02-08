function searchForTelefono() {

    $('#iconoSearch').addClass('d-none');
    $('#iconoCargando').removeClass('d-none');

    let search_type = 3;
    let search_text = $('#telefonoReferido').val();
    let search_plantel = 0;

    console.log(search_text);

    let ruta = setBaseURL() + "search/crm/" + search_type + "/" + search_text + "/" + search_plantel;

    console.log(ruta);

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        $('#cargador').removeClass('d-none');
        console.log(data.length); // imprimimos la respuesta

        if (data.length == 0) {
            $('#messageConfirmacion').html('No se encontraron resultados');
            $('#modal_confirmacion').modal('show');

        }
        else {
            $('#exampleModal').modal('show');
            $('#table_search > tbody').empty();
            if ($("#dataBuscador").hasClass("d-none") === false) {
                $('#dataBuscador').addClass('d-none');
            }

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
        }

        $('#iconoSearch').removeClass('d-none');
        $('#iconoCargando').addClass('d-none');
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

}