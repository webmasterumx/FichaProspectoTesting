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
                    <td style="${style}"><a href="{{ env('APP_URL') }}/?folio_crm=${element.folioCRM}&promotor=@isset($_REQUEST['promotor']){{ $_REQUEST['promotor'] }}@endisset">${element.folioCRM}</a></td>
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