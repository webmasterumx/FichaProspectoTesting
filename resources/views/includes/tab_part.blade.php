<div class="col-12 mt-3">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: #f0ad4e;">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                role="tab" aria-controls="nav-home" aria-selected="true">Datos de Contacto</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Seguimiento
                del Prospecto</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Referidos
                del Prospecto</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        @include('parts.part1')
        @include('parts.part2')
        @include('parts.part3')
    </div>
</div>
