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
                    <span class="material-symbols-outlined icon-medium hover:text-red-600 duration-300">
                        cancel
                    </span>
                </button>
                <button type="submit">
                    <span class="material-symbols-outlined icon-medium hover:text-green-600 duration-300">
                        check_circle
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
