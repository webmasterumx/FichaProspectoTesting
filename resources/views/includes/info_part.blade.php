<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="folio_crm" class="form-label">Folio CRM:</label>
        <input type="text" class="form-control text-center" id="folio_crm" value="" disabled>
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="matricula" class="form-label">Matrícula:</label>
        <input type="text" class="form-control text-center" id="matricula" value="" disabled>
    </div>
</div>
<div class="col-12 col-md-5">
    <div class="mb-3">
        <label for="prospecto" class="form-label">Prospecto:</label>
        <input type="email" class="form-control text-center" id="prospecto" disabled>
    </div>
</div>
<div class="col-12 col-md-3">
    <div class="mb-3">
        <label for="promotor_propietario" class="form-label">Promotor Propietario:</label>
        <input type="email" class="form-control text-center" id="promotor_propietario" disabled>
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="saldo_actual" class="form-label">Saldo Actual:</label>
        <input type="text" class="form-control text-center" id="saldo_actual" disabled>
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Último Estatus Detalle:</label>
        <span id="status_detalle" class="badge w-100"></span>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Campaña:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="campana_info"
            name="campana_info" form="formDatosGenerales">
            @foreach ($campañas as $campaña)
                <option value="{{ $campaña['Campana'] }}"> {{ $campaña['Nombre'] }} </option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Plantel:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="plantel_info"
            form="formDatosGenerales" name="plantel_info">
            @foreach ($planteles as $plantel)
                <option value="{{ $plantel['clave'] }}">{{ $plantel['descrip'] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nivel:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="nivel_info"
            form="formDatosGenerales" name="nivel_info">
            @foreach ($niveles as $nivel)
                <option value="{{ $nivel['clave'] }}">{{ $nivel['descrip'] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Carrera:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="carrera_info"
            name="carrera_info" form="formDatosGenerales"> 
            <option value="0" selected disabled>Selecciona una carrera</option>
            @foreach ($carreras as $carrera)
                <option value=" {{ $carrera['clave_carrera'] }} "> {{ $carrera['descrip_ofi'] }} </option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12 col-md-4">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Horario:</label>
        <select class="form-select form-select-sm" aria-label="Small select example" id="horario_info"
            name="horario_info" form="formDatosGenerales">
        </select>
    </div>
</div>
