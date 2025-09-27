document.addEventListener('DOMContentLoaded', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let filtroEn = "";

    // Abrir modal y cargar selects
    $('#filter-link').on('click', function(e){
        e.preventDefault();

        filtroEn = $(this).data('table');
        let action = '/filters/table';

        $('#table').val(filtroEn);
        $('#filter-form').attr('action', action);

        console.log(filtroEn);

        $.ajax({
            url: '/filters/date',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let years = response.years;
                let months = response.months;

                let yearSelect = $('#year');
                let monthSelect = $('#month');

                yearSelect.empty();
                monthSelect.empty();

                // Carga de datos al select año
                years.forEach(function(year) {
                    yearSelect.append($('<option>', {
                        value: year,
                        text: year
                    }).addClass('input-select'));
                });

                // Carga de datos al select mes
                $.each(months, function(key, value) {
                    monthSelect.append($('<option>', {
                        value: key,
                        text: value
                    }).addClass('input-select'));
                });

                // Muestro el modal una vez cargados los selects
                $('#filter-modal').removeClass('d-none').hide().fadeIn(400);
            },
            error: function(error) {
                console.error('Error al cargar los select de fechas:', error);
                console.error(action);
            }
        });
    });

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
