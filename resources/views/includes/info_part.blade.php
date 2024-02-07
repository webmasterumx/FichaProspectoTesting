<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="folio_crm" class="form-label">Folio CRM:</label>
        <input type="text" class="form-control text-center" id="folio_crm"
            @isset($_REQUEST['folio_crm'])value="{{ $ficha_prospecto['folioCRM'] }}"@endisset disabled>
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="matricula" class="form-label">Matrícula:</label>
        <input type="text" class="form-control text-center" id="matricula"
            @isset($_REQUEST['folio_crm'])value="{{ $ficha_prospecto['matricula'] }}"@endisset disabled>
    </div>
</div>
<div class="col-12 col-md-5">
    <div class="mb-3">
        <label for="prospecto" class="form-label">Prospecto:</label>
        <input type="email" class="form-control text-center"
            @isset($_REQUEST['folio_crm'])value="{{ $ficha_prospecto['nombreCompleto'] }}"@endisset id="prospecto"
            disabled>
    </div>
</div>
<div class="col-12 col-md-3">
    <div class="mb-3">
        <label for="promotor_propietario" class="form-label">Promotor Propietario:</label>
        <input type="email" class="form-control text-center" id="promotor_propietario"
            value="{{ $ficha_prospecto['promotorPropietario'] }}" disabled>
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="saldo_actual" class="form-label">Saldo Actual:</label>
        <input type="text" class="form-control text-center" id="saldo_actual"
            @isset($_REQUEST['folio_crm'])value="{{ $ficha_prospecto['saldoActual'] }}"@endisset disabled>
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Último Estatus Detalle:</label>
        <span id="status_detalle" class="badge w-100">
            @isset($_REQUEST['folio_crm'])
                {{ $ficha_prospecto['ultimoEstatusDetalle'] }}
            @endisset
        </span>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Campaña:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="campana_info"
            name="campana_info" form="formDatosGenerales">
            <option value="">Selecciona una campaña</option>
            @foreach ($campanas as $campana)
                <option value="{{ $campana['Campana'] }}">{{ $campana['Nombre'] }}</option>
            @endforeach
        </select>
        <div id="campana_info_error" class="text-danger fs-7 d-none">
            campo obligatorio
        </div>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Plantel:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="plantel_info"
            form="formDatosGenerales" name="plantel_info">
            <option value="">Selecciona un plantel</option>
            @foreach ($planteles as $plantel)
                <option value="{{ $plantel['clave'] }}">{{ $plantel['descrip'] }}</option>
            @endforeach
        </select>
        <div id="plantel_info_error" class="text-danger fs-7 d-none">
            campo obligatorio
        </div>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nivel:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="nivel_info"
            form="formDatosGenerales" name="nivel_info">
            <option value="">Selecciona un nivel</option>
            @foreach ($niveles as $nivel)
                <option value="{{ $nivel['clave'] }}">{{ $nivel['descrip'] }}</option>
            @endforeach
        </select>
        <div id="nivel_info_error" class="text-danger fs-7 d-none">
            campo obligatorio
        </div>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Carrera:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="carrera_info"
            name="carrera_info" form="formDatosGenerales">
            <option value="">Selecciona una carrera</option>
            @foreach ($carreras as $carrera)
                <option value="{{ $carrera['clave_carrera'] }}">{{ $carrera['descrip_ofi'] }}</option>
            @endforeach
        </select>
        <div id="carrera_info_error" class="text-danger fs-7 d-none">
            campo obligatorio
        </div>
        <div>
            @isset($envio)
                {{ $envio['estado'] }}
            @endisset
        </div>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Horario:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="horario_info"
            name="horario_info" form="formDatosGenerales">
            <option value="default">Selecciona un horario</option>
            @foreach ($horarios as $horario)
                <option value="{{ $horario['Horario'] }}"> {{ $horario['Descripcion'] }} </option>
            @endforeach
        </select>
        <div id="horario_info_error" class="text-danger fs-7 d-none">
            campo obligatorio
        </div>
    </div>
</div>
