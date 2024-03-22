   // Seleccionar el elemento de la alerta
        var errorAlert = document.getElementById('error-alert');
        // Si la alerta existe, espera un segundo y luego la oculta
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.display = 'none';
            }, 1000); // 1000 milisegundos = 1 segundo
        }