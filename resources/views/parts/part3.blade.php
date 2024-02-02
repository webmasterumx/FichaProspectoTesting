<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
    <form id="formReferido" action="{{ route('guardar.referido') }}" method="GET" class="row">
        <div class="col-12 col-md-4 d-flex">
            Telefono
            <div class="form-check">
                <input class="ms-3 form-check-input" type="radio" id="radio_casa" name="telefonoReferidoType[]"
                    value="1">
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
        </div>
        <div class="col-12 col-md-2">
            <div class="mb-3">
                <label for="apellidoPaternoReferido" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="apellidoPaternoReferido" name="apellidoPaternoReferido">
            </div>
        </div>
        <div class="col-12 col-md-2">
            <div class="mb-3">
                <label for="apellidoMaternoReferido" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="apellidoMaternoReferido" name="apellidoMaternoReferido">
            </div>
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-primary">Agregar Referido</button>
        </div>
        <div class="col-12 col-md-4">
            <div class="mb-3">
                <input type="text" class="form-control text-center" id="telefonoReferido" name="telefonoReferido"
                    placeholder="Tel. maximo 13 digitos">
            </div>
            <div class="mb-3">
                <label for="emailReferido" class="form-label">Correo
                    Electronico:</label>
                <input type="email" class="form-control text-center" id="emailReferido" name="emailReferido"
                    placeholder="Email">
            </div>
        </div>
        <div class="col-12 col-md-8">
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
                        @php
                            $cont = 0;
                            $stylePar = "background-color:white !important;";
                            $styleInpar = "background-color:#D3DFE8 !important;";
                        @endphp
                        @foreach ($referidos as $referido)
                            @php
                                $cont = $cont + 1;
                            @endphp
                            
                            <tr>
                                <th @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif><a href="{{ env('APP_URL') }}?folio_crm={{$referido['folioCRM']}}&promotor={{$_REQUEST['promotor']}}"> {{ $referido['folioCRM'] }} </a></th>
                                <td @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif> {{ $referido['nombreCompleto'] }} </td>
                                <td @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif> {{ $referido['telefono1'] }} </td>
                                <td @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif> {{ $referido['telefono2'] }} </td>
                                <td @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif> {{ $referido['celular1'] }} </td>
                                <td @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif> {{ $referido['celular2'] }} </td>
                                <td @if (($cont % 2) == 0) style="{!! $stylePar !!}" @else style=" {!! $styleInpar !!} " @endif> {{ $referido['email'] }} </td>
                            </tr> 
                        @endforeach
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
