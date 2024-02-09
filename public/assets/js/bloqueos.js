$("#telefono_uno").bind('keypress', function (event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$("#telefono_dos").bind('keypress', function (event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$("#celular_uno").bind('keypress', function (event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$("#celular_dos").bind('keypress', function (event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$("#telefonoReferido").bind('keypress', function (event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

function validarMatricula(matricula) {

    if (matricula === "" || matricula === " " || matricula === null) {
        //console.log('este prospecto no tiene matricula, se puede editar');
        $("#plantel_info").prop('disabled', false);
        $("#especialidad_info").prop('disabled', false);
        $("#carrera_info").prop('disabled', false);
        $("#horario_info").prop('disabled', false);
        $("#campana_info").prop('disabled', false);
    } else {
        //console.log("este prospecto trae matricula por lo tanto no se puede editar");
        $("#plantel_info").prop('disabled', true);
        $("#especialidad_info").prop('disabled', true);
        $("#carrera_info").prop('disabled', true);
        $("#horario_info").prop('disabled', true);
        $("#campana_info").prop('disabled', true);
        $("#nivel_info").prop('disabled', true);
    }
}