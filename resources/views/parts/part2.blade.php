<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
    <div class="row">

        <div id="cargador_bitacora" class="col-12 mt-3 text-center d-none">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Cargando datos</p>
        </div>

        <div id="form_bitacora" class="col-12 col-md-4 d-none">
            <form id="formBitacora" action="{{ route('guardar.bitacora') }}" method="GET">
                <select class="form-select form-select-sm mb-3" aria-label="Default select example"
                    id="actividadRealizada" name="actividadRealizada">
                </select>
                <select class="form-select form-select-sm mb-3" aria-label="Default select example" id="estatusDetalle"
                    name="estatusDetalle">
                </select>
                <select class="form-select form-select-sm mb-3" aria-label="Default select example"
                    id="actividadProxima" name="actividadProxima">
                </select>
                <div class="mb-3">
                    <label for="date_bitacora" class="form-label">Elegir fecha</label>
                    <input type="date" class="form-control" id="date_bitacora" name="date_bitacora" value="">
                </div>
                <select class="form-select form-select-sm mb-3" aria-label="Default select example" id="horarioContacto"
                    name="horarioContacto">
                </select>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios o
                        Actividad</label>
                    <textarea class="form-control" id="comentariosBitacora" name="comentariosBitacora" rows="3"></textarea>
                </div>
                @isset($_REQUEST['folio_crm'])
                    <input type="text" value="{{ $_REQUEST['folio_crm'] }}" name="folio_crm" id="folio_crm" hidden>
                @endisset
                @isset($_REQUEST['promotor'])
                    <input type="text" value="{{ $_REQUEST['promotor'] }}" name="promotor" id="promotor" hidden>
                @endisset
            </form>
        </div>
        <div id="lista_bitacora" class="col-12 col-md-8 d-none">
            <div class="table-responsive" style="overflow-y: scroll;  height: 300px;">
                <table id="bitacora_table" class="table table-sm">
                    <thead>
                        <tr>
                            <th class="bg-encabezado_table text-white" scope="col">Fecha Actualización</th>
                            <th class="bg-encabezado_table text-white" scope="col">Promotor Actividad </th>
                            <th class="bg-encabezado_table text-white" scope="col">Actividad Realizada</th>
                            <th class="bg-encabezado_table text-white" scope="col">Estatus Detalle</th>
                            <th class="bg-encabezado_table text-white" scope="col">Comentarios</th>
                            <th class="bg-encabezado_table text-white" scope="col">Fecha Agenda</th>
                            <th class="bg-encabezado_table text-white" scope="col">Próxima Actividad</th>
                            <th class="bg-encabezado_table text-white" scope="col">Promotor Propietario</th>
                            <th class="bg-encabezado_table text-white" scope="col">Cerrado</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <button id="enviarActividad" type="submit" form="formBitacora" class="btn btn-primary mt-3"><i class="bi bi-floppy-fill"></i>
                &nbsp; Guardar Actividad</button>
        </div>
    </div>
</div>
