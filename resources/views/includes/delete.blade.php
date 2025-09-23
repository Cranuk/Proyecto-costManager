<div id="delete-modal" class="custom-modal d-none" tabindex="-1" aria-hidden="true">
    <div>
        <form id="delete-form" method="POST" class="form-style">
            @csrf
            @method('DELETE')
            <div class="space-20"></div>

            <div class="subtitle underlined center">
                Confirmar eliminación
            </div>

            <div class="space-10"></div>

            <p class="center">¿Seguro que deseas eliminar este registro?</p>

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
