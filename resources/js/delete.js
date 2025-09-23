document.addEventListener('DOMContentLoaded', function() {

    // Abrir modal al hacer click en el botón eliminar
    $(document).on('click', '.btn-delete', function() {
        let deleteId = $(this).data('id');
        let table = $(this).data('table');
        let action = '';

        console.log("ID a eliminar: " + deleteId);
        console.log("Tabla: " + table);

        if (table == "expenses") {
            action = `/expenses/delete/${deleteId}`;
        } else if (table == "categories") {
            action = `/categories/delete/${deleteId}`;
        }else{
            action = `/revenues/delete/${deleteId}`;
        }

        $('#delete-form').attr('action', action);

        // Mostrar modal con fade
        $('#delete-modal')
            .removeClass('d-none')
            .css('display', 'flex')
            .hide()
            .fadeIn(200);
    });

    // Cerrar modal con botón cancelar
    $('#delete-modal .cancel').on('click', function() {
        $('#delete-modal').fadeOut(200, function() {
            $(this).addClass('d-none');
        });
    });

    // Cerrar modal al hacer click fuera del contenido
    $(window).on('click', function(e) {
        if ($(e.target).is('#delete-modal')) {
            $('#delete-modal').fadeOut(200, function() {
                $(this).addClass('d-none');
            });
        }
    });

});