<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
    <form id="formReferido" action="{{ route('guardar.referido') }}" method="GET" class="row">
        <div class="col-12 col-md-4 d-flex">
            Telefono
            <div class="form-check">
                <input class="ms-3 form-check-input" type="radio" id="radio_casa" name="telefonoReferidoType[]"
                    value="1" checked>
                <label class="form-check-label" for="radio_casa">
                    Casa
                </label>
            </div>
            <div class="form-check">
                <input class="ms-3 form-check-input" type="radio" id="radio_oficina" name="telefonoReferidoType[]"
                    value="2">
                <label class="form-check-label" for="radio_oficina">
                    Oficina
                </label>
            </div>
            <div class="form-check">
                <input class="ms-3 form-check-input" type="radio" id="radio_celular" name="telefonoReferidoType[]"
                    value="3">
                <label class="form-check-label" for="radio_celular">
                    Celular
                </label>
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="mb-3">
                <label for="nombreReferido" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombreReferido" name="nombreReferido">
            </div>
            <div class="text-danger fs-6">
                @foreach ($errors->get('nombreReferido') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="mb-3">
                <label for="apellidoPaternoReferido" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="apellidoPaternoReferido" name="apellidoPaternoReferido">
            </div>
            <div class="text-danger fs-6">
                @foreach ($errors->get('apellidoPaternoReferido') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="mb-3">
                <label for="apellidoMaternoReferido" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="apellidoMaternoReferido" name="apellidoMaternoReferido">
            </div>
            <div class="text-danger fs-6">
                @foreach ($errors->get('apellidoMaternoReferido') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-2">
            <button id="enviarReferido" type="submit" class="btn btn-primary">Agregar Referido</button>
        </div>
        <div class="col-12 col-md-4">
            <div class="mb-3 d-flex">
                <input type="text" class="form-control text-center" id="telefonoReferido" name="telefonoReferido"
                    placeholder="Tel. maximo 13 digitos" maxlength="13" onkeyup = "if(event.keyCode == 13) searchForTelefono()">
                <button onclick="searchForTelefono()" type="button" class="btn btn-primary">
                    <i id="iconoSearch" class="bi bi-search"></i>
                    <div id="iconoCargando" class="spinner-border d-none" style="height: 12px !important; width: 12px !important;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
            <div class="text-danger fs-6">
                @foreach ($errors->get('telefonoReferido') as $error)
                    {{ $error }}
                @endforeach
            </div>
            <div class="mb-3">
                <label for="emailReferido" class="form-label">Correo
                    Electronico:</label>
                <input type="email" class="form-control text-center" id="emailReferido" name="emailReferido"
                    placeholder="Email">
            </div>
            <div class="text-danger fs-6">
                @foreach ($errors->get('emailReferido') as $error)
                    {{ $error }}
                @endforeach
            </div>
        </div>
        <div id="cargador_referidos" class="col-12 col-md-8 mt-3 text-center d-none">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Cargando datos</p>
        </div>
        <div id="dataReferidos" class="col-12 col-md-8 d-none">
            <div class="table-responsive" style="overflow-y: scroll;  height: 150px;">
                <table id="table_referidos" class="table table-sm">
                    <thead>
                        <tr>
                            <th class="bg-encabezado_table text-white" scope="col">Folio CRM</th>
                            <th class="bg-encabezado_table text-white" scope="col">Nombre</th>
                            <th class="bg-encabezado_table text-white" scope="col">Telefono</th>
                            <th class="bg-encabezado_table text-white" scope="col">Telefono 2</th>
                            <th class="bg-encabezado_table text-white" scope="col">Celular</th>
                            <th class="bg-encabezado_table text-white" scope="col">Celular 2</th>
                            <th class="bg-encabezado_table text-white" scope="col">Correo Electronico</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        @isset($_REQUEST['folio_crm'])
            <input type="text" value="{{ $_REQUEST['folio_crm'] }}" name="folio_crm" id="folio_crm" hidden>
        @endisset
        @isset($_REQUEST['promotor'])
            <input type="text" value="{{ $_REQUEST['promotor'] }}" name="promotor" id="promotor" hidden>
        @endisset
    </form>
</div>
