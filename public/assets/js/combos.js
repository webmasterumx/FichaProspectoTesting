// primer escuchador cambio de campaña
$("select[name=campana_info]").change(function () {
    $('#campana_info_error').addClass('d-none');
});

// escuchador de cambio de plantel se llena de nuevo el combo nivel y se resetan carrera y horario
$("select[name=plantel_info]").change(function () {
    $('#plantel_info_error').addClass('d-none');
    $("#nivel_info").empty();
    $("#carrera_info").empty();
    $("#horario_info").empty();

    let plantel = $('select[name=plantel_info]').val();

    $.ajax({
        url: setBaseURL() + "get/niveles/" + plantel,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        //console.log(data);
        $("#nivel_info").append('<option value="">Selecciona un nivel</option>');
        for (let index = 0; index < data.length; index++) {
            const element = data[index].clave;
            $("#nivel_info").append("<option value='" + data[index].clave +
                "'>" + data[index].descrip + "</option>");
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })
});

//escuchador cambio de nivel
$("select[name=nivel_info]").change(function () {
    $('#nivel_info_error').addClass('d-none');
    $("#carrera_info").empty();
    $("#horario_info").empty();

    let claveCampana = $('select[name=campana_info]').val();
    let clavePlantel = $('select[name=plantel_info]').val();
    let claveNivel = $('select[name=nivel_info]').val();

    $.ajax({
        url: setBaseURL() + "obtener/carreras/" + claveCampana + '/' + clavePlantel + '/' +
            claveNivel,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data);
        $("#carrera_info").append('<option value="">Selecciona un carrera</option>');
        if (data.length == 0) {
            console.log('no hay carreras disponibles');
        } else if (data.Carrera.length > 0) {
            //hay array de carreras
            for (let index = 0; index < data.Carrera.length; index++) {
                const element = data.Carrera[index];
                //console.log(element);
                $("#carrera_info").append("<option value='" + element.clave_carrera +
                    "'>" + element.descrip_ofi + "</option>");
            }
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })
});

// escuchador de cambio de carrera
$("select[name=carrera_info]").change(function () {
    $('#carrera_info_error').addClass('d-none');

    let claveCampana = $('select[name=campana_info]').val();
    let clavePlantel = $('select[name=plantel_info]').val();
    let claveNivel = $('select[name=nivel_info]').val();
    let claveCarrera = $('select[name=carrera_info]').val();

    $("#horario_info").empty();
    $.ajax({
        url: setBaseURL() + "obtener/horarios/" + claveCampana + '/' + clavePlantel + '/' +
            claveNivel + "/" + claveCarrera,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        console.log(data.Horarios);
        if (data.Horarios.length > 0) {
            //hay array de carreras
            $("#horario_info").append(
                '<option value="">Selecciona un horario</option>');
            for (let index = 0; index < data.Horarios.length; index++) {
                const element = data.Horarios[index];
                //console.log(element);
                $("#horario_info").append("<option value='" + element.Horario + "'>" +
                    element.Descripcion + "</option>");
            }
        } else {
            $("#horario_info").append(
                '<option value="">Selecciona un horario</option>');
            $("#horario_info").append("<option value='" + data.Horarios.Horario + "'>" +
                data.Horarios.Descripcion + "</option>")
        }
    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    })

});

$("select[name=horario_info]").change(function () {
    $('#horario_info_error').addClass('d-none');
});

$("select[name=estatusDetalle]").change(function () {
    let validacion = $(this).find(':selected').data('id');

    if (validacion == 2) {
        $('select[name=actividadProxima]').attr('disabled', true);
        $('#date_bitacora').attr('disabled', true);
        $('select[name=horarioContacto]').attr('disabled', true);
    } 
    if (validacion == 1) {
        $('select[name=actividadProxima]').attr('disabled', false);
        $('#date_bitacora').attr('disabled', false);
        $('select[name=horarioContacto]').attr('disabled', false);
    } 


});