@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            @include('includes.info_part')
            @include('includes.acciones_part')
            @include('includes.tab_part')

            <!-- modales -->
            @include('modales.modal_error')
            @isset($_REQUEST['folio_crm'])
                @include('modales.modal_error_folio')
            @endisset
            @isset($_REQUEST['promotor'])
                @include('modales.modal_error_promotor')
            @endisset
        </div>
    </div>
@endsection
