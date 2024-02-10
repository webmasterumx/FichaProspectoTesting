<div class="tab-pane fade show active py-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <div id="editar_prospecto">
        <div class="row">
            <div class="col-12 col-md-4 mb-3">
                <label for="nombre_form" class="form-label">Nombre:</label>
                <x-input-form-general-text name="nombre_form" id="nombre_form"></x-input-form-general-text>
            </div>
            <div class="col-12 col-md-2 mb-3">
                <label for="apellidos_form" class="form-label">Apellido Paterno:</label>
                <x-input-form-general-text name="apellidos_form" id="apellidos_form"></x-input-form-text>
            </div>
            <div class="col-12 col-md-2 mb-3">
                <label for="apellido_mat_form" class="form-label">Apellido Materno:</label>
                <x-input-form-general-text name="apellido_mat_form" id="apellido_mat_form"></x-input-form-text>
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
                    <x-input-form-general-tel name="telefono_uno" id="telefono_uno"
                        placeholder="Tel. a 10 digitos"></x-input-form-general-tel>
                    <span id="etiqueta_telefon_uno" class="input-group-text  text-white py-1"
                        id="telefono_uno_label"></span>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <x-input-form-general-tel name="telefono_dos" id="telefono_dos"
                        placeholder="Tel. a 10 digitos"></x-input-form-general-tel>
                    <span id="etiqueta_telefono_dos" class="input-group-text  text-white py-1"
                        id="telefono_dos_label"></span>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <x-input-form-general-tel name="celular_uno" id="celular_uno"
                        placeholder="Telfono Celular 1"></x-input-form-general-tel>
                    <span id="etiqueta_celular_uno" class="input-group-text  text-white py-1"
                        id="celular_uno_label"></span>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="input-group mb-3">
                    <x-input-form-general-tel name="celular_dos" id="celular_dos"
                        placeholder="Telefono celular 2"></x-input-form-general-tel>
                    <span id="etiqueta_celular_dos" class="input-group-text  text-white py-1"
                        id="celular_dos_label"></span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label for="email_form" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email_form" name="email_form"
                        form="formDatosGenerales">
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <label for="referido_por_info" class="form-label">Referido Por: </label>
                <input type="text" class="form-control" id="referido_por_info" name="referido_por_info" disabled>
            </div>
            <div class="col-12 col-md-4">
                <div class="mb-3">
                    <label for="origen_info" class="form-label">Origen del Registro:</label>
                    <select class="form-select form-select-sm" id="origen_info" name="origen_info" disabled></select>
                </div>
            </div>
            @isset($_REQUEST['folio_crm'])
                <input type="text" form="formDatosGenerales" value="{{ $_REQUEST['folio_crm'] }}" name="folio_crm"
                    id="folio_crm" hidden>
            @endisset
        </div>
    </div>
    <div class="row d-none" id="mensajes_whatsapp">
        <div class="col-12 col-md-6">
            <h2>Detalle Mensajes WhatsApp</h2>
        </div>
        <div class="col-12 col-md-6">
            <p class="text-center">
                Estatus Whatsapp: ACTIVA <br>
                Estatus Conversación: <span id="estaus_conversacion"></span>
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
