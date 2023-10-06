
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

function crear_cuenta(){
    var cedula = $('#cedula').val();
    var celular = $('#celular').val();
    var email = $('#email').val();


    console.log(email);

  
    $.ajax({
        method: 'POST',
        url: '/createCuenta',
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        },
        data: {
            cedula: cedula,
            celular: celular,
            email: email
        },
        success: function(response) {
            console.log(response);
            if(response.status == 0){
                showAlert(response.message);
               
            }

            if(response.status == 1){
                showAlertExit(response.message);
                $('#cedula').val('');
                $('#celular').val('');
                $('#email').val('');
            }

          
        },
        error: function(xhr) {
            console.log(xhr)
            showAlert("Error al conseguir la información");

        }
    });

        
}

