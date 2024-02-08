<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ficha Prospecto</title>
    <link rel="shortcut icon" href="https://unimexver.edu.mx/favicon.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <div class="container-fluid p-0">
        <header
            class="ff_header bg-unimex d-flex flex-wrap align-items-center justify-content-center justify-content-md-between border-bottom">
            <div class="col-md-2 mb-md-0">
                <div class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="{{ asset('assets/img/logo_Unimex.png') }}"
                        srcset="{{ asset('assets/img/logo_Unimex.png') }}" alt="">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <p id="nombreProspecto" class="text-white text-center  m-auto">
                    <i class="bi bi-file-person-fill"></i> Ficha Prospecto:
                </p>
            </div>

            <div class="col-md-3 text-end text-center text-white m-auto">
                <p><i class="bi bi-telephone-fill"></i> Call Center</p>
            </div>
        </header>
        @include('includes.menu_archivos')
    </div>

    @yield('content')

    <footer class="container-fluid bg-unimex text-white p-3">
        <div class="row">
            <div class="col-12 col-md-4 text-center">
                <p id="namePromotor">
                    <i class="bi bi-person-fill"></i>
                </p>
            </div>
            <div class="col-12 col-md-4 text-center">
                <p id="datePromotor">
                    <i class="bi bi-clock"></i>
                </p>
            </div>
            <div class="col-12 col-md-4 text-center">
                ©2024 Universidad Mexicana.
            </div>
        </div>
    </footer>
    @include('modales.modal_confirmacion')
    @include('modales.modal_no_mensajes')
    @include('modales.modal_carga')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="{{ asset('assets/js/bloqueos.js') }}"></script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
    @php
        $validar_folio = isset($_REQUEST['folio_crm']);
        $validar_prmotor = isset($_REQUEST['promotor']);
    @endphp
    @if ($validar_folio == true && $validar_prmotor == true)
        <script>
            $(document).ready(function() {

                let folio_crm = "{{ $_REQUEST['folio_crm'] }}";
                let promotor = "{{ $_REQUEST['promotor'] }}";

                let ruta = setBaseURL() + "getFichaProspecto/" + folio_crm + "/" + promotor;

                $.ajax({
                    url: ruta,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    //console.log(data); // imprimimos la respuesta

                    if (data == 1) {
                        //console.log('no existe prospecto');
                        $("#modal_error_folio").modal("show");
                    } else if (data == 2) {
                        //console.log('no existe promotor');
                        $('#modal_error_promotor').modal('show');
                    } else {
                        //console.log('tratar info Prospecto');

                        let matricula = data.infoProspecto.matricula;

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

                        let infoProspecto = data.infoProspecto;
                        let infoPromotor = data.infoPromotor;
                        let dateInfo = data.fechaFormateada;

                        llenarAreaInformacion(infoProspecto);
                        llenarCamposEditables(infoProspecto);
                        printInfoPromotor(infoPromotor, dateInfo);
                    }

                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })

            });

            // escuchador de cambio de plantel se llena de nuevo el combo nivel y se resetan carrera y horario
            $("select[name=plantel_info]").change(function() {
                $('#plantel_info_error').addClass('d-none');
                $("#nivel_info").empty();
                $("#carrera_info").empty();
                $("#horario_info").empty();

                let plantel = $('select[name=plantel_info]').val();

                $.ajax({
                    url: setBaseURL() + "get/niveles/" + plantel,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    //console.log(data);
                    $("#nivel_info").append('<option value="">Selecciona un nivel</option>');
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index].clave;
                        $("#nivel_info").append("<option value='" + data[index].clave +
                            "'>" + data[index].descrip + "</option>");
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            });

            $("select[name=nivel_info]").change(function() {
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
                }).done(function(data) {
                    //console.log(data.Carrera.length);
                    $("#carrera_info").append('<option value="">Selecciona un carrera</option>');
                    if (data.Carrera.length > 0) {
                        //hay array de carreras
                        for (let index = 0; index < data.Carrera.length; index++) {
                            const element = data.Carrera[index];
                            //console.log(element);
                            $("#carrera_info").append("<option value='" + element.clave_carrera +
                                "'>" + element.descrip_ofi + "</option>");
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            });

            // escuchador de cambio de carrera
            $("select[name=carrera_info]").change(function() {
                $('#carrera_info_error').addClass('d-none');

                let claveCampana = $('select[name=campana_info]').val();
                let clavePlantel = $('select[name=plantel_info]').val();
                let claveNivel = $('select[name=nivel_info]').val();
                let claveCarrera = $('select[name=carrera_info]').val();

                establecerHorario(claveCampana, clavePlantel, claveNivel, claveCarrera);

            });

            $("select[name=campana_info]").change(function() {
                $('#campana_info_error').addClass('d-none');
            });
            $("select[name=horario_info]").change(function() {
                $('#horario_info_error').addClass('d-none');
            });


            function setBaseURL() {
                let base_url = "{{ env('APP_URL') }}";
                return base_url;
            }

            function setFolioCrm() {
                let folio_crm = "{{ $_REQUEST['folio_crm'] }}";
                return folio_crm;
            }

            function setPromotor() {
                let promotor = "{{ $_REQUEST['promotor'] }}";
                return promotor;
            }

            function llenarAreaInformacion(infoProspecto) {
                $("#campana_info option[value=" + infoProspecto.claveCampana + "]").attr("selected", true); //establece campana
                $("#plantel_info option[value=" + infoProspecto.clavePlantel + "]").attr("selected", true); //establece plantel
                $("#nivel_info option[value=" + infoProspecto.claveNivel + "]").attr("selected", true); // establece nivel
                $("#carrera_info option[value=" + infoProspecto.claveCarrera + "]").attr("selected", true); // establece nivel
                $("#horario_info option[value=" + infoProspecto.claveHorario + "]").attr("selected", true); // establece nivel
                $("#origen_info option[value=" + infoProspecto.origen + "]").attr("selected", true); // establece origen

                let nombre = infoProspecto.termometro;
                establecer_color(nombre);

            }

            function llenarCamposEditables(infoProspecto) {

                //!llenado del formulario de guardar datos

                $('#nombreProspecto').html('<i class="bi bi-file-person-fill"></i> Ficha Prospecto: ' + infoProspecto
                    .nombreCompleto)

                let bitacora = infoProspecto.listaBitacoraSeguimiento.Cls_Bitacora;
                let listRedes = infoProspecto.listRedes;

                establecerNumeros(infoProspecto);
                establecer_redes(listRedes);
            }

            function establecer_color(nombre) {
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

            function printInfoPromotor(infoPromotor, dateInfo) {

                let lineaPromotor = '<i class="bi bi-person-fill"></i> ' + infoPromotor.nombre;
                let lineaFecha = '<i class="bi bi-clock"></i> ' + dateInfo.nombreDiaSemana + ', ' + dateInfo.diaMes + ' de ' +
                    dateInfo.nombreMes + ' de ' + dateInfo.año;

                $('#namePromotor').html(lineaPromotor);
                $('#datePromotor').html(lineaFecha);
            }

            function establecerHorario(claveCampana, clavePlantel, claveNivel, claveCarrera) {
                $("#horario_info").empty();
                $.ajax({
                    url: setBaseURL() + "obtener/horarios/" + claveCampana + '/' + clavePlantel + '/' +
                        claveNivel + "/" + claveCarrera,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
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
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            //informacion de los tabs
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

            // parte de los mensajes de whats
            function establecer_mensajes_whats(folioCRM) {
                $('#conversaciones > tbody').empty();

                let folio_crm = setFolioCrm();
                let url = setBaseURL() + "obtener/mensajes/whatsapp/" + folio_crm;
                console.log(url);

                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {

                    console.log(data);
                    //console.log(data.length);

                    if (data.length == 0) {
                        console.log('no hay datos');

                        $('#modal_no_mensajes').modal('show');

                    } else {
                        $('#editar_prospecto').addClass('d-none');
                        $('#mensajes_whatsapp').removeClass('d-none');

                        for (let index = 0; index < data.Cls_MensajesWhatsapp.length; index++) {
                            cont = index + 1;
                            if (cont % 2 !== 0) {
                                //numero inpar
                                style = "background-color:white !important;";
                            }
                            if (cont % 2 === 0) {
                                //numero par
                                style = "background-color:#D3DFE8 !important;";
                            }
                            const element = data.Cls_MensajesWhatsapp[index];

                            //console.log(element);

                            switch (element.sentimientoMW) {
                                case "Normal":
                                    caritaBg = "&#128512;";
                                    break;
                                case "Triste":
                                    caritaBg = "&#128543;";
                                    break;
                                case "Enojado":
                                    caritaBg = " &#128545;";
                                    break;

                                default:
                                    break;
                            }

                            let fila = `
                                <tr>
                                    <td style="${style}">${element.fechaMW}</td>
                                    <td style="${style}">${element.tipo_usuarioMW}</td>
                                    <td style="${style}">${element.nombreMW}</td>
                                    <td style="${style}">${element.detalleMW}</td>
                                    <td style="${style}">${element.estatus_conversacionMW}</td>
                                    <td style="${style}">${caritaBg}</td>
                                </tr>
                            `;
                            $('#conversaciones tbody').append(fila);

                        }
                    }

                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            const myModal = new bootstrap.Modal('#modal_carga', {
                backdrop: 'static',
                keyboard: false
            })
        </script>
    @endif
    @if ($validar_folio == false && $validar_prmotor == false)
    @endif
    @if ($validar_folio == true && $validar_prmotor == false)
        <script>
            $(document).ready(function() {
                $("#modal_error").modal("show");
            });
        </script>
    @endif
    @if ($validar_folio == false && $validar_prmotor == true)
        <script>
            $(document).ready(function() {
                $("#modal_error").modal("show");
            });
        </script>
    @endif
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/consumo.js') }}"></script>
    <script src="{{ asset('assets/js/busquedas.js') }}"></script>
</body>

</html>
