document.addEventListener('DOMContentLoaded', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function abrirModalConFechas(actionUrl, tableValue = '') {
        $('#filter-form').attr('action', actionUrl);
    
        if (!tableValue) {
            $('#table').prop('disabled', true).val('');
        } else {
            $('#table').prop('disabled', false).val(tableValue);
        }

        $.ajax({
            url: '/filters/date',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let yearSelect = $('#year');
                let monthSelect = $('#month');

                yearSelect.empty();
                monthSelect.empty();

                response.years.forEach(function(year) {
                    yearSelect.append($('<option>', {
                        value: year,
                        text: year
                    }).addClass('input-select'));
                });

                $.each(response.months, function(key, value) {
                    monthSelect.append($('<option>', {
                        value: key,
                        text: value
                    }).addClass('input-select'));
                });

                $('#filter-modal').removeClass('d-none').hide().fadeIn(400);
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar los select de fechas:', error);
                console.error('URL intentada:', actionUrl);
            }
        });
    }

    // Evento para las tablas
    $('#filter-link').on('click', function(e){
        e.preventDefault();
        let filtroEn = $(this).data('table');
        console.log("Tabla seleccionada:", filtroEn);
        abrirModalConFechas('/filters/table', filtroEn);
    });

    // Evento para el inicio / balances
    $('#filter-home-link').on('click', function(e){
        e.preventDefault();
        console.log("¡Clic en el filtro del inicio!");
        abrirModalConFechas('/filters/balance', '');
    });

    // Botón cancelar del modal
    $('#filter-modal .cancel').on('click', function() {
        $('#filter-modal').fadeOut(400, function() {
            $(this).addClass('d-none');
        });
    });

    // Cerrar modal al hacer click fuera del contenido
    $(window).on('click', function(e) {
        if ($(e.target).is('#filter-modal')) {
            $('#filter-modal').fadeOut(400, function() {
                $(this).addClass('d-none');
            });
        }
    });
});