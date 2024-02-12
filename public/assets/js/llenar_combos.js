function llenar_combos(infoProspecto) {

    let claveCampana = infoProspecto.claveCampana;
    let clavePlantel = infoProspecto.clavePlantel;
    let claveNivel = infoProspecto.claveNivel;
    let claveCarrera = infoProspecto.claveCarrera;
    let claveHorario = infoProspecto.claveHorario;
    let origen = infoProspecto.origen;

    llenarComboCampañas(claveCampana);
    llenaComboPlantel(clavePlantel);
    llenarComboNivel(clavePlantel, claveNivel);
    llenarCombosCarrera(claveCampana, clavePlantel, claveNivel, claveCarrera);
    llenarComboHorarios(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario);
    llenarComboOrigen(origen);

}

function llenarComboCampañas(claveCampana) {
    let ruta = setBaseURL() + 'obtener/campanas/0';

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const campañas = data.EntCampanaDTO;
        let option_default = `<option value="">Seleciona una campaña</option>`;
        if (campañas != undefined) {
            $("#campana_info").append(option_default); //se establece la campaña por defecto
            for (let index = 0; index < campañas.length; index++) { //recorrer el array de campañas
                const element = campañas[index]; // se establece un elemento por campaña optenida
                let option = `<option value="${element.Campana}">${element.Nombre}</option>`; //se establece la opcion por campaña
                $("#campana_info").append(option); // se inserta la campaña de cada elemen  to
            }
        }
        else {
            $("#campana_info").append(option_default);
        }

        $("#campana_info option[value=" + claveCampana + "]").attr("selected", true);

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });

}

function llenaComboPlantel(clavePlantel) {
    let ruta = setBaseURL() + 'get/planteles';

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const plateles = data;
        let option_default = `<option value="">Seleciona un plantel</option>`;
        if (plateles != undefined) {
            $("#plantel_info").append(option_default); //se establece el plantel por defecto
            for (let index = 0; index < plateles.length; index++) { //recorrer el array de planteles
                const element = plateles[index]; // se establece un elemento por plantel optenida
                let option = `<option value="${element.clave}">${element.descrip}</option>`; //se establece la opcion por campaña
                $("#plantel_info").append(option); // se inserta la platel de cada elemento
            }
        }
        else {
            $("#plantel_info").append(option_default);
        }
        $("#plantel_info option[value=" + clavePlantel + "]").attr("selected", true);

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}

function llenarComboNivel(clavePlantel, claveNivel) {
    let ruta = setBaseURL() + 'get/niveles/' + clavePlantel;

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const niveles = data;
        let option_default = `<option value="">Seleciona un Nivel</option>`;
        if (niveles != undefined) {
            $("#nivel_info").append(option_default); //se establece la campaña por defecto
            for (let index = 0; index < niveles.length; index++) { //recorrer el array de campañas
                const element = niveles[index]; // se establece un elemento por campaña optenida
                let option = `<option value="${element.clave}">${element.descrip}</option>`; //se establece la opcion por campaña
                $("#nivel_info").append(option); // se inserta la campaña de cada elemen  to
            }
        }
        else {
            $("#nivel_info").append(option_default);
        }

        $("#nivel_info option[value=" + claveNivel + "]").attr("selected", true);

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}

function llenarCombosCarrera(claveCampana, clavePlantel, claveNivel, claveCarrera) {
    let ruta = setBaseURL() + 'obtener/carreras/' + claveCampana + '/' + clavePlantel + '/' + claveNivel;

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const carreras = data.Carrera;
        let option_default = `<option value="">Seleciona una Carrera</option>`;
        if (carreras != undefined) {
            $("#carrera_info").append(option_default); //se establece la campaña por defecto
            for (let index = 0; index < carreras.length; index++) { //recorrer el array de campañas
                const element = carreras[index]; // se establece un elemento por campaña optenida
                let option = `<option value="${element.clave_carrera}">${element.descrip_ofi}</option>`; //se establece la opcion por campaña
                $("#carrera_info").append(option); // se inserta la campaña de cada elemen  to
            }
        }
        else {
            $("#carrera_info").append(option_default);
        }

        $("#carrera_info option[value=" + claveCarrera + "]").attr("selected", true);

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}

function llenarComboHorarios(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario) {
    let ruta = setBaseURL() + 'obtener/horarios/' + claveCampana + '/' + clavePlantel + '/' + claveNivel + '/' + claveCarrera;

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const horarios = data.Horarios;
        let option_default = `<option value="">Seleciona un Horario</option>`;
        if (horarios != undefined) {
            $("#horario_info").append(option_default); //se establece la campaña por defecto
            for (let index = 0; index < horarios.length; index++) { //recorrer el array de campañas
                const element = horarios[index]; // se establece un elemento por campaña optenida
                let option = `<option value="${element.Horario}">${element.Descripcion}</option>`; //se establece la opcion por campaña
                $("#horario_info").append(option); // se inserta la campaña de cada elemen  to
            }
        }
        else {
            $("#horario_info").append(option_default);
        }
        $("#horario_info option[value=" + claveHorario + "]").attr("selected", true);

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}

function llenarComboOrigen(origen) {
    let ruta = setBaseURL() + 'obtener/origenes';

    $.ajax({
        url: ruta,
        method: "GET",
        dataType: 'json',
    }).done(function (data) {
        const origenes = data.OrigenesDTO;
        let option_default = `<option value="">Seleciona un origen</option>`;
        if (origenes != undefined) {
            $("#origen_info").append(option_default); //se establece la campaña por defecto
            for (let index = 0; index < origenes.length; index++) { //recorrer el array de campañas
                const element = origenes[index]; // se establece un elemento por campaña optenida
                let option = `<option value="${element.Origen_id}">${element.Descripcion}</option>`; //se establece la opcion por campaña
                $("#origen_info").append(option); // se inserta la campaña de cada elemen  to
            }
        }
        else {
            $("#origen_info").append(option_default);
        }
        $("#origen_info option[value=" + origen + "]").attr("selected", true);

        $('#modal_carga').modal('hide');

    }).fail(function (e) {
        console.log("Request: " + JSON.stringify(e));
    });
}