<div id="modal_error_folio" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-warning text-white ">
            <div class="modal-header border-0 row">
                <div class="col-11"></div>
                <div class="col-1">
                    <button type="button" class="text-white text-center bg-warning border-0"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Lo sentimos, no se encontró información con el Folio CRM:
                    {{ $_REQUEST['folio_crm'] }}</h5>
            </div>
        </div>
    </div>
</div>
