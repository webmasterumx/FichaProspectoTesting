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
        @if ($_REQUEST['folio_crm'] == '' || $_REQUEST['folio_crm'] == 'promotor')
            <script>
                $(document).ready(function() {
                    $("#modal_error").modal("show");
                });
            </script>
        @else
            <script>
                window.addEventListener('load', function() {
                    $('#text_carga').html('Cargando datos..');
                    $('#modal_carga').modal('show');
                });

                $(document).ready(function() {  
                    let folio_crm = "{{ $_REQUEST['folio_crm'] }}";
                    let promotor = "{{ $_REQUEST['promotor'] }}";
                    let ruta = setBaseURL() + "getFichaProspecto/" + folio_crm + "/" + promotor;

                    $.ajax({
                        url: ruta,
                        method: "GET",
                        dataType: 'json',
                    }).done(function(data) {
                        if (data == 1) {
                            // no existe prospecto
                            $("#modal_error_folio").modal("show");
                        } else if (data == 2) {
                            // no existe promotor
                            $('#modal_error_promotor').modal('show');
                        } else {
                            // tratar info Prospecto

                            let infoProspecto = data.infoProspecto;
                            let infoPromotor = data.infoPromotor;
                            let dateInfo = data.fechaFormateada;
                            let matricula = data.infoProspecto.matricula;
                            let listRedes = infoProspecto.listRedes;
                            let nombre = infoProspecto.termometro;
                            let ultimoEstatusDetalle = infoProspecto.ultimoEstatusDetalle;

                            //cargarMenuPrincipal();
                            validarMatricula(matricula);
                            llenarInputs(infoProspecto);
                            establecer_color(nombre, ultimoEstatusDetalle);
                            llenar_combos(infoProspecto);
                            establecerNumeros(infoProspecto);
                            establecer_redes(listRedes);
                            printInfoPromotor(infoPromotor, dateInfo);
                        }

                    }).fail(function(e) {
                        console.log("Request: " + JSON.stringify(e));
                    })

                });

                // incio - funciones de establecimiento 

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

                // fin - funciones de establecimiento

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
                                $('#estaus_conversacion').html(element.estatus_conversacionMW);

                            }

                        }

                    }).fail(function(e) {
                        console.log("Request: " + JSON.stringify(e));
                    })
                }

                const myModal = new bootstrap.Modal('#modal_carga', {
                    backdrop: 'static',
                    keyboard: false
                });

                const modal_busqueda = new bootstrap.Modal('#exampleModal', {
                    backdrop: 'static',
                    keyboard: false
                });
            </script>
        @endif
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
    <script src="{{ asset('assets/js/combos.js') }}"></script>
    <script src="{{ asset('assets/js/areas.js') }}"></script>
    <script src="{{ asset('assets/js/llenar_combos.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/menu.js') }}"></script> --}}
</body>

</html>
