import flashy from '@pablotheblink/flashyjs';

flashy.setDefaults({
    position: 'top-right',          
    timeout: 5000,           
    animation: 'fade',      
});

document.addEventListener('DOMContentLoaded', function() {
    const status = $('meta[name="flash-status"]').attr('content');
    const error = $('meta[name="flash-error"]').attr('content');

    if (status) flashy(status, { type: 'info' });
    if (error) flashy(error, { type: 'error' });
});