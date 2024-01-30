<div class="col-12 col-md-2">
</div>
<div class="col-12 col-md-10">
    <div class="row">
        <div class="col-12 col-md-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-search"></i> Búsqueda
            </button>

            <!-- Modal -->
            <div class="modal fade" style="font-size: 12px !important;" id="exampleModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #337ab7;">
                            <h1 class="modal-title text-white fs-5" id="exampleModalLabel">Búsquedas de
                                prospectos</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_search" class="row">
                                <div class="col-12 col-md-8">
                                    <p>Selecciona un criterio de búsqueda</p>
                                    <div class="w-100 d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" id="folio_crm"
                                                name="search_crm[]" checked>
                                            <label class="form-check-label" for="folio?crm">
                                                Folio CRM
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input ms-2" type="radio" value="2"
                                                id="nombre_crm" name="search_crm[]">
                                            <label class="form-check-label" for="nombre_crm">
                                                Nombre
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input ms-2" type="radio" value="3"
                                                id="tel_crm" name="search_crm[]">
                                            <label class="form-check-label" for="tel_crm">
                                                Teléfono Casa/Oficina/Celular
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input ms-2" type="radio" value="4"
                                                id="email_crm" name="search_crm[]">
                                            <label class="form-check-label" for="email_crm">
                                                Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <label id="label-error-type" for="text_crm" class="text-danger">campo
                                            requerido</label>
                                    </div>
                                    <div class="mt-3">
                                        <label for="text-crm" class="form-label">Ingresa
                                            el FolioCRM / Telefono / Celular / Email:</label>
                                        <input type="text" class="form-control" required id="text_crm"
                                            name="text_crm"
                                            placeholder="Ingresa el FolioCRM / Telefono / Celular / Email">
                                        <label id="label-error-text" for="text_crm" class="text-danger d-none">campo
                                            requerido</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <p>Si conoces el plantel, seleecionalo aquí:</p>
                                    <select class="form-select" aria-label="Default select example"
                                        name="plantel_search" id="plantel_search">
                                        <option value="0" selected>Selecciona una opción</option>
                                        @foreach ($planteles as $plantel)
                                            <option value="{{ $plantel['clave'] }}"> {{ $plantel['descrip'] }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-12" style="height: 150px !important;">

                                </div>
                            </form>
                        </div>
                        <diiv class="row p-3">
                            <div class="col-12 col-md-6">
                                <button onclick="searchProspecto()" type="button" class="btn btn-primary w-100">Buscar
                                    prospectos</button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button type="button" class="btn btn-danger w-100"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </diiv>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <button type="button" class="btn btn-warning btn-sm" disabled><i class="bi bi-upc"></i>
                Genera Matrícula</button>
        </div>
        <div class="col-12 col-md-3">
            <button type="button" onclick="enviarDatosProspecto()" class="btn btn-info btn-sm"><i
                    class="bi bi-floppy-fill"></i> Guardar
                Cambios</button>
        </div>
        <div class="col-12 col-md-4">
            <button id="mensajesWhatsapp" type="button" class="btn btn-success btn-sm"
                onclick="mostrarMensajes()"><i class="bi bi-phone-fill"></i> Mensajes WhatsApp</button>
        </div>
    </div>
</div>
