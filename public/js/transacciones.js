$(document).ready(function () {
    
});


function pageLoaded() {
    let loaderSection = document.querySelector('.loader-section');
    loaderSection.classList.add('loaded');
   

}
window.onload = pageLoaded;
 
function soundExit() {
    var modalSound = document.getElementById("modalSoundCorrecto");
    if (modalSound) {
        modalSound.play(); // Reproduce el sonido al abrir el modal
    }

}

function soundError() {
    var modalSound = document.getElementById("modalSoundIncorrecto");
    if (modalSound) {
        modalSound.play(); // Reproduce el sonido al abrir el modal
    }

}


function open_modal() {

    $('#modal_recargar').modal('show');
    soundExit();
}

function open_modal_pagar() {


    var token = $('#valor_pagar').val();

    $.ajax({
        method: 'POST',
        url: '/enviartoken',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            token: token
           
        },
        success: function(response) {
            if(response.status == 0){
                $('#valor_pagar').val('');
                showAlert(response.message);
               
            }

            if(response.status == 1){

                $('#valor_pagar').val('');

                var nombreVariable = "Valor";
                var botonEnviarCorreo = document.getElementById('enviar_correo');
                botonEnviarCorreo.style.display = 'none';
                var btnconfirmarpago = document.getElementById('btnconfirmarpago');
                btnconfirmarpago.style.display = 'block';
                var labelElement = document.querySelector('label[for="valor_pagar"]');

                if (labelElement) {
                    // Cambia el texto de la etiqueta por el nuevo nombre
                    labelElement.textContent = nombreVariable;
                }
                var ingresoCodigo = "Ingrese el valor a pagar";

                var inputElement = document.getElementById('valor_pagar');

                // Verifica si se encontró el elemento input
                if (inputElement) {
                    // Cambia el texto del atributo placeholder por el nuevo texto
                    inputElement.placeholder = ingresoCodigo;
                }

                $('#modal_pagar').modal('show');
                soundExit();
            }

          
        },
        error: function(xhr) {
            $('#valor_pagar').val('');
            console.log(xhr)
            showAlert("Error al conseguir la información");
        }
    });


    
   
}

function send_email(){

    let loaderSection = document.querySelector('.loader-section');
    loaderSection.classList.remove('loaded'); // Muestra el preloader

    $.ajax({
        method: 'POST',
        url: '/pagarCuenta',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status == 0){
                showAlert(response.message);
               
            }

            if(response.status == 1){

                pageLoaded();
                var nombreVariable = "Código";
                var botonEnviarCorreo = document.getElementById('enviar_correo');
                botonEnviarCorreo.style.display = 'block';
                var btnconfirmarpago = document.getElementById('btnconfirmarpago');
                btnconfirmarpago.style.display = 'none';
                var labelElement = document.querySelector('label[for="valor_pagar"]');
            
                if (labelElement) {
                    // Cambia el texto de la etiqueta por el nuevo nombre
                    labelElement.textContent = nombreVariable;
                }
            
                
                var ingresoCodigo = "Ingrese el código enviado a su correo";
            
                var inputElement = document.getElementById('valor_pagar');
            
                // Verifica si se encontró el elemento input
                if (inputElement) {
                    // Cambia el texto del atributo placeholder por el nuevo texto
                    inputElement.placeholder = ingresoCodigo;
                }
            
                $('#modal_pagar').modal('show');
                soundExit();
            }

          
        },
        error: function(xhr) {
            pageLoaded();
            console.log(xhr)
            showAlert("Error al conseguir la información");
        }
    });



 
}

function save_pago(){

    var saldo = $('#valor_pagar').val();

    $.ajax({
        method: 'POST',
        url: '/enviarpago',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            saldo: saldo
           
        },
        success: function(response) {
            if(response.status == 0){
                $('#valor_pagar').val('');
                showAlert(response.message);
               
            }

            if(response.status == 1){
                $('#valor_pagar').val('');
                showAlertExit(response.message + " su saldo actual es de : " + response.saldo);
                $('#modal_pagar').modal('hide');
            }

          
        },
        error: function(xhr) {
            $('#valor_pagar').val('');
            console.log(xhr)
            showAlert("Error al conseguir la información");
        }
    });


}


function showAlert(mensaje) {
    // Establece el mensaje de error
    document.getElementById("error-message").textContent = mensaje;
    soundError();
    // Muestra el popup
    $('#alertSwal').modal('show');
}

function showAlertExit(mensaje) {
    // Establece el mensaje de SUCCESS
    document.getElementById("success-message").textContent = mensaje;
    soundExit();
    // Muestra el popup
    $('#alertSwalExit').modal('show');
    
}

function open_modal_saldo(){
    $('#modal_ver_saldo').modal('show');
    soundExit();

}


function ver_saldo(){

    var documento = $('#documento_consult').val();
    var celular = $('#celular_consult').val();

    $.ajax({
        method: 'POST',
        url: '/verCuenta',
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },
        data: {
            documento: documento,
            celular: celular
           
        },
        success: function(response) {
            if(response.status == 0){
                showAlert(response.message);
                $('#modal_ver_saldo').modal('hide');
                $('#documento_consult').val('');
                $('#celular_consult').val('');
                $('#modal_ver_saldo').modal('hide');
               
            }

            if(response.status == 1){
                var saldoElement = document.getElementById('Saldo_actual');
                saldoElement.textContent = response.saldo;
                $('#modal_saldo').modal('show');
                soundExit();
                $('#documento_consult').val('');
                $('#celular_consult').val('');
                $('#modal_ver_saldo').modal('hide');
            }

          
        },
        error: function(xhr) {
            console.log(xhr)
            showAlert("Error al conseguir la información");
            $('#modal_ver_saldo').modal('hide');
        }
    });

   
}

function send_recarga(){

    var documento = $('#documento').val();
    var celular = $('#celular').val();
    var valor = $('#valor').val();


    $.ajax({
        method: 'POST',
        url: '/recargarCuenta',
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },
        data: {
            documento: documento,
            celular: celular,
            valor: valor
        },
        success: function(response) {
            if(response.status == 0){
                showAlert(response.message);
               
            }

            if(response.status == 1){
                showAlertExit(response.message + " su saldo actual es de : " + response.saldo);
                $('#documento').val('');
                $('#celular').val('');
                $('#valor').val('');
                $('#modal_recargar').modal('hide');
            }

          
        },
        error: function(xhr) {
            console.log(xhr)
            showAlert("Error al conseguir la información");
            $('#modal_recargar').modal('hide');
        }
    });



}

