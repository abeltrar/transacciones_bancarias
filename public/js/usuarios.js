$(document).ready(function () {
    $('#crud_usuarios').DataTable();
});

function open_modal()
{

    
    $("#crearUsuarioModal").modal("show"); // Abre la modal
    

}


function showAlert(mensaje) {
    // Establece el mensaje de error
    document.getElementById("error-message").textContent = mensaje;
    
    // Muestra el popup
    $('#alertSwal').modal('show');
}

function showAlertExit(mensaje) {
    // Establece el mensaje de SUCCESS
    document.getElementById("error-message").textContent = mensaje;
    
    // Muestra el popup
    $('#alertSwalExit').modal('show');
}

function get_data(boton, verUsuarioUrl,mode) {
    console.log(mode);
    // Obtén el botón que disparó el evento click
    var idUsuario = $(boton).data('id');
    ver_usuario(verUsuarioUrl, idUsuario,mode);
}

function update_data(boton, verUsuarioUrl,mode) {
    // Obtén el botón que disparó el evento click
    var idUsuario = $(boton).data('id');
    ver_usuario(verUsuarioUrl, idUsuario,mode);
}


function ver_usuario(verUsuarioUrl,idUsuario,mode){

    
    // Realiza una solicitud AJAX al controlador
        $.ajax({
            url: verUsuarioUrl, // Ruta a controlador
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },
            data: {
                idusuario: idUsuario 
            }, // Convierte el objeto a formato JSON
        
            success: function (data) {
                console.log(data);
                if (data.error) {
                    // Manejar el error
                    showAlert(data.error);
                } else {
                    // Procesar los datos del usuario
                    var user = data.user;
                    if(mode=='ver'){


                        $('#modal_ver_usuario').modal('show');
                        // Actualizar la modal con la información del usuario
                        $("#name_user").text(user.name);
                        $('#userAvatar').attr('src', user.foto);
                        $("#emailUser").text(user.email);
                        $("#cedula_ver").text(user.cedula);
                        $("#rol_usuario").text(user.nombre_cargo);
                    }else{

    
                        
                        $("#name_user_edit").text(user.name);
                        $('#userAvatarEdit').attr('src', user.foto);
                        $('#name_edit').val(user.name);
                        $('#email_edit').val(user.email);
                        $('#idusuario_edit').val(user.id);
                        $('#password_edit').val(user.password);
                        $('#id_cargo_edit').val(user.id_cargo);
                        $("#cedula_edit").val(user.cedula);
                        $('#modal_edit_usuario').modal('show');
                    }
                    
                }
            },
            error: function () {

                showAlert("Se ha producido un error al cargar los datos.");
            }

            
    });
        
       


}

// function guardar_user(guardar_user){
//     // Obtener el formulario por su ID
//     var formulario = $('#form_create');

//     // Serializar los datos del formulario en un formato que se pueda enviar mediante AJAX
//     var formData = formulario.serialize();

//     console.log(formData);


//     // Realizar una solicitud AJAX para guardar los datos
//     $.ajax({
//         url: guardar_user, // Reemplaza con tu URL de guardado
//         method: 'POST',
//         headers: {
//             "Content-Type": "application/json",
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

//             // Puedes agregar más encabezados aquí si es necesario
//         },
//         data: formData,
//         success: function(response) {
//             if (response.success) {
            
//                 showAlertExit(response.message)
//             } else {
//                 showAlert(response.message);
//             }
//         },
//         error: function() {
//             // Manejar errores si la solicitud AJAX falla
//             alert('Se produjo un error en la solicitud AJAX');
//         }
//     });
   
// }


function close_modal() {
    $('#alertSwal').modal('show');

}

function close_modalExit() {
    $('#alertSwalExit').modal('show');

}


