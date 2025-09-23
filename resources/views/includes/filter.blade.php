<div id="filter-modal" class="custom-modal d-none" tabindex="-1" aria-hidden="true">
    <div>
        <form id="filter-form" class="form-style" method="POST">
            @csrf
            <div class="space-20"></div>

            <div class="subtitle underlined center">
                Seleccionar mes y año
            </div>

            <div class="space-10"></div>

            <input type="hidden" id="table" name="table">

            <label for="month" class="label-text">Mes</label>
            <select name="month" id="month" class="input-select"></select>

            <div class="space-10"></div>

            <label for="year" class="label-text">Año</label>
            <select name="year" id="year" class="input-select"></select>

            <div class="space-10"></div>

            <div class="button-box">
                <button type="button" class="cancel">
                    <i class='bx bxs-x-circle icon-medium'></i>
                </button>
                <button type="submit">
                    <i class='bx bxs-check-circle icon-medium'></i>
                </button>
            </div>
        </form>
    </div>
</div>
