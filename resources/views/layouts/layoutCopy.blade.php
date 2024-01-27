<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ficha Prospecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        label,
        input,
        table,
        button,
        select {
            font-size: 12px !important;
        }

        .bg-unimex {
            background-color: #004b93;
        }

        .ff_header {
            font-family: 'Glyphicons Halflings' !important;
            font-size: 20px;
        }

        #boton-back {
            background-image: url("{{ asset('assets/img/Regresar.png') }}");
            background-repeat: no-repeat;
            height: 50px !important;
            width: 55px !important;
            background-position: center;
            background-size: cover;
            border: none;
        }

        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-cyan {
            background-color: #0dcaf0 !important;
        }

        .bg-encabezado_table {
            background: #2E4d7B !important;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .dropend .dropdown-toggle {
            color: black;
            margin-left: 1em;
        }

        .dropdown .dropdown-menu {
            display: none;
        }

        .dropdown:hover>.dropdown-menu,
        .dropend:hover>.dropdown-menu {
            display: block;
            margin-top: 0.125em;
            margin-left: 0.125em;
        }

        @media screen and (min-width: 769px) {
            .dropend:hover>.dropdown-menu {
                position: absolute;
                top: 0;
                left: 100%;
            }

            .dropend .dropdown-toggle {
                margin-left: 0.5em;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <header
            class="ff_header bg-unimex d-flex flex-wrap align-items-center justify-content-center justify-content-md-between border-bottom">
            <div class="col-md-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="{{ asset('assets/img/logo_Unimex.png') }}"
                        srcset="{{ asset('assets/img/logo_Unimex.png') }}" alt="">
                </a>
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
        <header class="py-1 mt-0 bg-unimex">
            <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Doc. Grales
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Convenios</a></li>
                                <li><a class="dropdown-item" href="#">Documentación Nuevo Ingreso</a></li>
                                <li class="dropend">
                                    <a class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Folleto de Ventajas
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Metropolitano</a></li>
                                        <li><a class="dropdown-item" href="#">Veracruz</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Apertura de Grupos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">IZCALLI</a></li>
                                <li><a class="dropdown-item" href="#">SATÉLITE</a></li>
                                <li><a class="dropdown-item" href="#">POLANCO</a></li>
                                <li><a class="dropdown-item" href="#">VERACRUZ</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hojas de Costos
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropend">
                                    <a class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        IZCALLI
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropend">
                                            <a class="dropdown-item" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Preparatoría
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">2020 - 2021</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropend">
                                            <a class="dropdown-item" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Licenciatura
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">2021 - 3</a></li>
                                                <li><a class="dropdown-item" href="#">2021 - 2</a></li>
                                                <li><a class="dropdown-item" href="#">2021 - 1</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropend">
                                            <a class="dropdown-item" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Posgrado
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">2021 - 3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#">SATÉLITE</a></li>
                                <li><a class="dropdown-item" href="#">POLANCO</a></li>
                                <li><a class="dropdown-item" href="#">VERACRUZ</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Folletos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Metropolitano</a></li>
                                <li><a class="dropdown-item" href="#">Veracruz</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Mapas de Ubicación
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">IZCALLI</a></li>
                                <li><a class="dropdown-item" href="#">SATÉLITE</a></li>
                                <li><a class="dropdown-item" href="#">POLANCO</a></li>
                                <li><a class="dropdown-item" href="#">VERACRUZ</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

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
                    console.log(data); // imprimimos la respuesta

                    if (data == 1) {
                        console.log('no existe prospecto');
                        $("#modal_error_folio").modal("show");
                    } else if (data == 2) {
                        console.log('no existe promotor');
                        $('#modal_error_promotor').modal('show');
                    } else {
                        console.log('tratar info Prospecto');

                        let infoProspecto = data.infoProspecto;
                        let infoPromotor = data.infoPromotor;
                        let dateInfo = data.fechaFormateada;

                        llenarAreaInformacion(infoProspecto);
                        llenarCamposEditables(infoProspecto);
                        //llenarCampos(infoProspecto); 
                        //printInfoPromotor(infoPromotor, dateInfo);
                    }

                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            });

            function setBaseURL() {
                //return "https://ficha.unimex.edu.mx/";
                return "http://sistema.com:8000/";
            }

            function llenarAreaInformacion(infoProspecto) {
                $('#folio_crm').val(infoProspecto.folioCRM);
                $('#matricula').val(infoProspecto.matricula);
                $('#prospecto').val(infoProspecto.nombreCompleto);
                $('#saldo_actual').val(infoProspecto.saldoActual);
                $('#promotor_propietario').val(infoProspecto.promotorPropietario);

                let claveCampana = infoProspecto.claveCampana;
                let clavePlantel = infoProspecto.clavePlantel;
                let claveNivel = infoProspecto.claveNivel;
                let claveCarrera = infoProspecto.claveCarrera;
                let claveHorario = infoProspecto.claveHorario;
                establecerCampana(claveCampana);
                establecer_nivel(infoProspecto.clavePlantel, infoProspecto.claveNivel);
                establecerCarrera(claveCampana, clavePlantel, claveNivel, claveCarrera);
                establecerHorario(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario);
                establecerPlantel(clavePlantel);
                esteblecer_color(infoProspecto.termometro);
            }

            function llenarCamposEditables(infoProspecto) {

                //!llenado del formulario de guardar datos
                $('#nombre_form').val(infoProspecto.nombre);
                $('#apellidos_form').val(infoProspecto.apPaterno);
                $('#apellido_mat_form').val(infoProspecto.apMaterno);
                $('#email_form').val(infoProspecto.email);
                $('#celular_uno').val(infoProspecto.celular1);
                $('#celular_dos').val(infoProspecto.celular2);
                $('#telefono_uno').val(infoProspecto.telefono1);
                $('#telefono_dos').val(infoProspecto.telefono2);
                $('#status_detalle').html(infoProspecto.ultimoEstatusDetalle);
                $('#nombreProspecto').html('<i class="bi bi-file-person-fill"></i> Ficha Prospecto: ' + infoProspecto
                    .nombreCompleto)

                let bitacora = infoProspecto.listaBitacoraSeguimiento.Cls_Bitacora;
                let listRedes = infoProspecto.listRedes;

                establecer_bitacora(bitacora);
                establecer_redes(listRedes);
                establecerNumeros(infoProspecto);
                establecer_mensajes_whats(infoProspecto.folioCRM);
            }

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

            function esteblecer_color(nombre) {
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

            function establecer_bitacora(bitacora) {
                for (let index = 0; index < bitacora.length; index++) {
                    const element = bitacora[index];
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
                            <td style="${style}"></td>
                            <td style="${style}">${element.promotorPropietario}</td>
                            <td style="${style}"></td>
                        </tr>
                    `;
                    $('#bitacora_table tbody').append(fila);
                }
            }

            function establecer_mensajes_whats(folioCRM) {
                $.ajax({
                    url: setBaseURL() + "obtener/mensajes/whatsapp/" + folioCRM,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {

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
                        console.log(element);
                        let fila = `
                            <tr>
                                <td style="${style}">${element.fechaMW}</td>
                                <td style="${style}">${element.tipo_usuarioMW}</td>
                                <td style="${style}">${element.nombreMW}</td>
                                <td style="${style}">${element.detalleMW}</td>
                                <td style="${style}">${element.estatus_conversacionMW}</td>
                                <td style="${style}">${element.sentimientoMW}</td>
                            </tr>
                        `;
                        $('#conversaciones tbody').append(fila);

                    }

                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
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

            function establecer_nivel(plantel, claveNivel) {
                $.ajax({
                    url: setBaseURL() + "get/niveles/" + plantel,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    console.log(data);
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index].clave;
                        if (element == claveNivel) {
                            $("#especialidad_info").prepend("<option value='" + data[index].clave +
                                "' selected='selected'>" + data[index].descrip + "</option>");
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            function printInfoPromotor(infoPromotor, dateInfo) {

                let lineaPromotor = '<i class="bi bi-person-fill"></i> ' + infoPromotor.nombre;
                let lineaFecha = '<i class="bi bi-clock"></i> ' + dateInfo.nombreDiaSemana + ', ' + dateInfo.diaMes + ' de ' +
                    dateInfo.nombreMes + ' de ' + dateInfo.año;

                $('#namePromotor').html(lineaPromotor);
                $('#datePromotor').html(lineaFecha);
            }

            function establecerCampana(claveCampana) {
                $.ajax({
                    url: setBaseURL() + "obtener/campanas/" + claveCampana,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    if (data.length == 0) {
                        //no hay campaña
                    } else {
                        console.log(data.EntCampanaDTO.Nombre);
                        $("#campana_info").prepend("<option value='" + data.EntCampanaDTO.Campana +
                            "' selected='selected'>" + data.EntCampanaDTO.Nombre + "</option>");
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            function establecerCarrera(claveCampana, clavePlantel, claveNivel, claveCarrera) {
                $.ajax({
                    url: setBaseURL() + "obtener/carreras/" + claveCampana + '/' + clavePlantel + '/' +
                        claveNivel,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    console.log(data.Carrera.length);
                    if (data.Carrera.length > 0) {
                        //hay array de carreras
                        for (let index = 0; index < data.Carrera.length; index++) {
                            const element = data.Carrera[index];
                            //console.log(element);
                            if (element.clave_carrera == claveCarrera) {
                                $("#carrera_info").prepend("<option value='" + element.clave_carrera +
                                    "' selected='selected'>" + element.descrip_ofi + "</option>");
                            }
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            function establecerHorario(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario) {
                $.ajax({
                    url: setBaseURL() + "obtener/horarios/" + claveCampana + '/' + clavePlantel + '/' +
                        claveNivel + "/" + claveCarrera,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    console.log(data.Horarios.length);
                    if (data.Horarios.length > 0) {
                        //hay array de carreras
                        for (let index = 0; index < data.Horarios.length; index++) {
                            const element = data.Horarios[index];
                            //console.log(element);
                            if (element.Horario == claveHorario) {
                                $("#horario_info").prepend("<option value='" + element.Clave_turno +
                                    "' selected='selected'>" + element.Descripcion + "</option>");
                            }
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            function establecerPlantel(clavePlantel) {
                $.ajax({
                    url: setBaseURL() + "get/planteles",
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    console.log(data);
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index].clave;
                        if (element == clavePlantel) {
                            $("#plantel_info").prepend("<option value='" + data[index].clave +
                                "' selected='selected'>" + data[index].descrip + "</option>");
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }
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

    <script>
        $(document).ready(function() {
            $('ul.nav li.dropdown').hover(function() {
                //$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
            }, function() {
                //$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
            });
        });

        function mostrarMensajes() {

            $('#editar_prospecto').addClass('d-none');

            $('#mensajes_whatsapp').removeClass('d-none');
        }

        function mostrarEdicionProspecto() {
            console.log('hola');
            $('#mensajes_whatsapp').addClass('d-none');

            $('#editar_prospecto').removeClass('d-none');
        }

        function enviarDatosProspecto() {
            $("#formDatosGenerales").submit();
        }
    </script>
</body>

</html>
