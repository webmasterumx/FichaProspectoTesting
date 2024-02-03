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
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
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

                        let matricula = data.infoProspecto.matricula;

                        if (matricula === "" || matricula === " " || matricula === null) {
                            console.log('este prospecto no tiene matricula, se puede editar');
                            $("#plantel_info").prop('disabled', false);
                            $("#especialidad_info").prop('disabled', false);
                            $("#carrera_info").prop('disabled', false);
                            $("#horario_info").prop('disabled', false);
                            $("#campana_info").prop('disabled', false);
                        } else {
                            console.log("este prospecto trae matricula por lo tanto no se puede editar");
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
                $("#nivel_info").empty();
                $("#carrera_info").empty();
                $("#horario_info").empty();

                $("#nivel_info").prepend('<option value="0" selected disabled>Selecciona un nivel</option>');
                let plantel = $('select[name=plantel_info]').val();

                $.ajax({
                    url: setBaseURL() + "get/niveles/" + plantel,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
                    console.log(data);
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index].clave;
                        $("#nivel_info").prepend("<option value='" + data[index].clave +
                            "' selected='selected'>" + data[index].descrip + "</option>");
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            });

            $("select[name=nivel_info]").change(function() {
                $("#carrera_info").empty();
                $("#horario_info").empty();

                $("#carrera_info").prepend('<option value="0" selected disabled>Selecciona un carrera</option>');
                let claveCampana = $('select[name=campana_info]').val();
                let clavePlantel = $('select[name=plantel_info]').val();
                let claveNivel = $('select[name=nivel_info]').val();

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
                            $("#carrera_info").prepend("<option value='" + element.clave_carrera +
                                "' selected='selected'>" + element.descrip_ofi + "</option>");
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            });

            // escuchador de cambio de carrera
            $("select[name=carrera_info]").change(function() {
                console.log($('select[name=carrera_info]').val());

                establecerListaHorarios();

            });

            function setBaseURL() {
                let base_url = "{{ env('APP_URL') }}";
                return base_url;
            }

            function llenarAreaInformacion(infoProspecto) {
                $('#folio_crm').val(infoProspecto.folioCRM);
                $('#matricula').val(infoProspecto.matricula);
                $('#prospecto').val(infoProspecto.nombreCompleto);
                $('#saldo_actual').val(infoProspecto.saldoActual);
                $('#promotor_propietario').val(infoProspecto.promotorPropietario);
                $('#status_detalle').html(infoProspecto.ultimoEstatusDetalle);

                let claveCampana = infoProspecto.claveCampana;
                let clavePlantel = infoProspecto.clavePlantel;
                let claveNivel = infoProspecto.claveNivel;
                let claveCarrera = infoProspecto.claveCarrera;
                let claveHorario = infoProspecto.claveHorario;
                let nombre = infoProspecto.termometro;

                $("#campana_info option[value=" + claveCampana + "]").attr("selected", true);
                $("#plantel_info option[value=" + clavePlantel + "]").attr("selected", true);
                $("#nivel_info option[value=" + claveNivel + "]").attr("selected", true);


                establecer_color(nombre);
                if (claveCarrera == 1 || claveCarrera == "" || claveCarrera == null) {
                    //generarListaCarreras(claveCampana, clavePlantel, claveNivel, claveCarrera);
                } else {
                    establecerCarrera(claveCampana, clavePlantel, claveNivel, claveCarrera)
                }

                if (claveHorario == 1 || claveCarrera == "" || claveCarrera == null) {
                    console.log('horario inexistente');
                    generarListaHorarios(claveCampana, clavePlantel, claveNivel, claveCarrera);
                } else {
                    console.log('horario existente');
                    establecerHorario(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario)
                }

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
                $('#nombreProspecto').html('<i class="bi bi-file-person-fill"></i> Ficha Prospecto: ' + infoProspecto
                    .nombreCompleto)

                let bitacora = infoProspecto.listaBitacoraSeguimiento.Cls_Bitacora;
                let listRedes = infoProspecto.listRedes;

                establecerNumeros(infoProspecto);
                establecer_bitacora(bitacora);
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

            function generarListaCarreras(claveCampana, clavePlantel, claveNivel, claveCarrera) {
                $("#carrera_info").prepend('<option value="1" selected disabled>Selecciona una carrera</option>');
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
                            console.log(element);
                            $("#carrera_info").prepend("<option value='" + element.clave_carrera +
                                "'>" + element.descrip_ofi + "</option>");
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            function generarListaHorarios(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario) {
                $("#horario_info").empty();
                $("#horario_info").prepend('<option value="0" selected disabled>Selecciona un horario</option>');
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
                            $("#horario_info").prepend("<option value='" + element.Horario +
                                "'>" + element.Descripcion + "</option>");
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

            function establecerCarrera(claveCampana, clavePlantel, claveNivel, claveCarrera) {
                $("#carrera_info").empty();
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
                            } else {
                                $("#carrera_info").prepend("<option value='" + element.clave_carrera +
                                    "'>" + element.descrip_ofi + "</option>");
                            }
                        }
                    }
                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }

            function establecerHorario(claveCampana, clavePlantel, claveNivel, claveCarrera, claveHorario) {
                console.log(claveHorario);
                $("#horario_info").empty();
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
                            console.log(element);
                            if (element.Horario == claveHorario) {
                                console.log(true);
                                selector = 'selected';
                            } else {
                                console.log(false);
                                selector = '';
                            }
                            $("#horario_info").prepend("<option value='" + element.Horario + "' " + selector + ">" +
                                element.Descripcion + "</option>");

                        }
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

            function establecer_bitacora(bitacora) {
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
            function mostrarMensajes() {
                $('#editar_prospecto').addClass('d-none');
                $('#mensajes_whatsapp').removeClass('d-none');

                let folio_crm = "{{ $_REQUEST['folio_crm'] }}";

                establecer_mensajes_whats(folio_crm);
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

            //getMenu(0);

        });

        function getMenu(idMenu) {

            let ruta = "{{ env('APP_URL') }}obtener/menu/" + idMenu;
            console.log(ruta);

            $.ajax({
                url: ruta,
                method: "GET",
                dataType: 'json',
            }).done(function(data) {
                console.log(data.Cls_MenuDoctos.length); // imprimimos la respuesta
                for (let index = 0; index < data.Cls_MenuDoctos.length; index++) {
                    const element = data.Cls_MenuDoctos[index];
                    console.log(element);
                    let item = `
                        <li class="dropdown" id="${element.id_menu}">
                            <a class="nav-link dropdown-toggle text-white" onmouseover="getSubMenus(${element.id_menu})" href="${element.url_destino}" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                ${element.descripcion}
                            </a>
                        </li>
                    `;
                    $("#listaMenus").append($("<li>").html(item));
                }

            }).fail(function(e) {
                console.log("Request: " + JSON.stringify(e));
            })
        }

        function getSubMenus(idMenu) {
            let ruta = "{{ env('APP_URL') }}obtener/menu/" + idMenu;
            console.log(ruta);

            $.ajax({
                url: ruta,
                method: "GET",
                dataType: 'json',
            }).done(function(data) {
                console.log(data.Cls_MenuDoctos.length); // imprimimos la respuesta
                let submenu = `<ul class="dropdown-menu show">`;
                for (let index = 0; index < data.Cls_MenuDoctos.length; index++) {
                    const element = data.Cls_MenuDoctos[index];
                    //console.log(element);
                    let menuPeque = `
                        <li class="dropend ">
                            <a class="dropdown-item" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                                ${element.descripcion}
                            </a>
                        </li>
                    `;

                    submenu = submenu + menuPeque;
                }

                submenu = submenu + `</ul>`;
                console.log(submenu);

                $('#menu_' + idMenu).append(submenu);

            }).fail(function(e) {
                console.log("Request: " + JSON.stringify(e));
            })
        }

        function searchProspecto() {
            console.log('hola');

            var formElement = document.getElementById("form_search");
            formData = new FormData(formElement);
            console.log(formData);
            console.log(formData.get('search_crm[]'));

            let search_type = formData.get('search_crm[]');
            let search_text = formData.get('text_crm');
            let search_plantel = formData.get('plantel_search');

            let ruta = "{{ env('APP_URL') }}" + "search/crm/" + search_type + "/" + search_text + "/" + search_plantel;

            if (search_text == null || search_text == "" || search_text == " ") {
                $('#label-error-text').removeClass('d-none');
            } else {
                $('#label-error-text').addClass('d-none');

                $.ajax({
                    url: ruta,
                    method: "GET",
                    dataType: 'json',
                }).done(function(data) {
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
                        $('#table_search tbody').append(fila);
                    }

                }).fail(function(e) {
                    console.log("Request: " + JSON.stringify(e));
                })
            }


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
