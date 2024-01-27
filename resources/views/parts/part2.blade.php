<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
    <div class="row">
        <div class="col-12 col-md-4">
            <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                <option selected>Selecciona Actividad Realizada</option>
                <option value="1">Cita</option>
                <option value="2">Llamada</option>
                <option value="3">Mensaje</option>
                <option value="4">Correo</option>
            </select>
            <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                <option selected>Selecciona Estattus Detalle</option>
                <option value="1">ANTICIPO PAGO</option>
                <option value="2">BUZÓN</option>
                <option value="3">DATOS FALSOS</option>
                <option value="3">DUPLICADOS</option>
                <option value="3">ESTÁ EN EL TRABAJO</option>
                <option value="3">INTERESADO</option>
                <option value="3">MAS DE 5 INTENTOS SIN CONTACTO</option>
                <option value="3">NO OCNTESTA</option>
                <option value="">NO SE ENCUENTRA/ NO PUEDE CONTESTAR</option>
                <option value="">PROSPECTACION</option>
                <option value="">PRUEBA</option>
                <option value="">REALIZO PAGO</option>
                <option value="">SE CORTO / CUELGA</option>
            </select>
            <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                <option selected>Seleccion la Proxima Actividad</option>
                <option value="1">Cita</option>
                <option value="2">Llamada</option>
                <option value="3">Mensaje</option>
                <option value="4">Correo</option>
            </select>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Ingrese la Fecha a la
                    Agenda</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <select class="form-select form-select-sm mb-3" aria-label="Default select example">
                <option selected>Seleccion Horario de Contactación</option>
                <option value="1">9 - 11 am</option>
                <option value="1">11 - 2 pm</option>
                <option value="1">2 - 4 pm</option>
                <option value="1">4 - 7 pm</option>
                <option value="1">7 - 9 pm</option>
            </select>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Comentarios o
                    Actividad</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </div>
        <div class="col-12 col-md-8">
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
        </div>
    </div>
</div>
