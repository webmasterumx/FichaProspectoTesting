<div class="tab-pane fade show active py-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <div id="editar_prospecto">
        <form id="formDatosGenerales" class="row" action="{{ route('guardar.datos.prospecto') }}" method="get">
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label for="nombre_form" class="form-label">Nombre:</label>
                    <input type="email" class="form-control text-center form-control-sm" name="nombre_form"
                        id="nombre_form">
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label for="apellidos_form" class="form-label">Apellido Paterno:</label>
                    <input type="email" class="form-control form-control-sm text-center" name="apellidos_form"
                        id="apellidos_form">
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="mb-3">
                    <label for="apellido_mat_form" class="form-label">Apellido Materno:</label>
                    <input type="email" class="form-control form-control-sm text-center" name="apellido_mat_form"
                        id="apellido_mat_form">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <table id="listRedes" class="table table-sm table-borderless">
                    <thead>
                        <tr>
                            <th style="background-color: #2E4D7B; color:white;" scope="col">Red
                                social</th>
                            <th style="background-color: #2E4D7B; color:white;" scope="col">
                                userName</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm form-control-sm" aria-label="Username"
                        id="telefono_uno" name="telefono_uno" aria-describedby="basic-addon1" placeholder="Tel. a 10 digitos">
                    <span id="etiqueta_telefon_uno" class="input-group-text  text-white py-1" id="basic-addon1">
                        <i class="bi bi-x-circle-fill"></i>
                    </span>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Tel. a 10 digitos" aria-label="Username"
                        id="telefono_dos" name="telefono_dos" aria-describedby="basic-addon1">
                    <span id="etiqueta_telefono_dos" class="input-group-text  text-white py-1" id="basic-addon1">
                        <i class="bi bi-x-circle-fill"></i>
                    </span>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" aria-label="Username" name="celular_uno"
                        id="celular_uno" aria-describedby="basic-addon1" placeholder="Telfono Celular 1">
                    <span id="etiqueta_celular_uno" class="input-group-text  text-white py-1" id="basic-addon1">

                    </span>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Telefono celular 2"
                        aria-label="Username" aria-describedby="basic-addon1" name="celular_dos" id="celular_dos">
                    <span id="etiqueta_celular_dos" class="input-group-text  text-white py-1" id="basic-addon1">

                    </span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label for="email_form" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email_form" name="email_form" value="">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Referido Por:</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="Tú referido" disabled>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label for="origen-form" class="form-label">Origen del Registro:</label>
                    <input type="email" class="form-control" id="origen-form" value="Whatsapp">
                </div>
            </div>
            @isset($_REQUEST['folio_crm'])
                <input type="text" value="{{ $_REQUEST['folio_crm'] }}" name="folio_crm" id="folio_crm" hidden>
            @endisset
        </form>
    </div>
    <div class="row d-none" id="mensajes_whatsapp">
        <div class="col-12 col-md-6">
            <h2>Detalle Mensajes WhatsApp</h2>
        </div>
        <div class="col-12 col-md-6">
            <p class="text-center">
                Estatus Whatsapp: ACTIVA <br>
                Estatus Conversación: CHB CON CARRERA
            </p>
        </div>
        <div class="col-11">
            <table id="conversaciones">
                <thead>
                    <tr>
                        <th class="bg-encabezado_table text-white" scope="col">Fecha</th>
                        <th class="bg-encabezado_table text-white" scope="col">Tipo Usuario</th>
                        <th class="bg-encabezado_table text-white" scope="col">Nombre</th>
                        <th class="bg-encabezado_table text-white" scope="col">Detalle</th>
                        <th class="bg-encabezado_table text-white" scope="col">Estatus Conversación</th>
                        <th class="bg-encabezado_table text-white" scope="col">Sentimiento</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="col-1">
            <button onclick="mostrarEdicionProspecto()" id="boton-back"></button>
        </div>
    </div>
</div>
