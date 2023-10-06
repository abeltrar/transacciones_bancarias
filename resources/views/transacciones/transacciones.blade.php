@extends('layouts.maestra01')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="../css/transacciones.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
   
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/transacciones.js"></script>
</head>
<body>


    <div class="loader-section">
          <span class="loader"></span>
     </div>


  <div class="card">
      <div class="card-header">
        Realice todas las transacciones de su cuenta aqui <i class="fa-solid fa-hand-point-down"></i>
      </div>
      <div class="card-body">
        
      <div class="transacts">
        <img id="img-cajero" src="../img/cajero-automatico.jpg" alt="cajero">
        <div type="button" class="btn_cajero"onclick="open_modal();">Recargar</div>
        <div type="button" class="btn_cajero ver_saldo" onclick="open_modal_saldo();">Ver saldo</div>
        <div type="button" class="btn_cajero pagar"onclick="send_email();">Pagar</div>
      </div>
        
      </div>
    </div>

    

      <!-- Modal recargar -->
      <div class="modal fade" id="modal_recargar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header recargar_cuenta">
              <h5 class="modal-title" id="tittle_modal">Recargar cuenta <i class="fa-solid fa-wand-magic-sparkles"></i> </h5> 
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <audio id="modalSoundCorrecto">
                <source src="../audios/correcto.mp3" type="audio/mp3">
            </audio>

            <audio id="modalSoundIncorrecto">
                <source src="../audios/error.mp3" type="audio/mp3">
            </audio>

              <form>
               @csrf
                <div class="form-group">
                 <small id="text_init" class="form-text text-muted">Por favor ingrese la información para la recarga de su cuenta</small>
                  <label for="documento">Documento <i class="fa-regular fa-id-card"></i></label>
                  <input type="number" class="form-control" id="documento" aria-describedby="Documento" placeholder="Ingrese su documento">
                </div>
                <div class="form-group">
                  <label for="celular">Celular <i class="fa-solid fa-mobile"></i></label>
                  <input type="number" class="form-control" id="celular" placeholder="Ingrese su número de celular">
                </div>
                <div class="form-group">
                  <label for="valor">Valor <i class="fa-solid fa-comments-dollar"></i></label>
                  <input type="number" class="form-control" id="valor" placeholder="Ingrese el valor a recargar">
                </div>
              </form>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary btn_enviar" onclick="send_recarga();">Enviar <i class="fa-solid fa-thumbs-up"></i></button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal pagar -->


      <div class="modal fade" id="modal_pagar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered static" role="document">
          <div class="modal-content">
            <div class="modal-header recargar_cuenta">
              <h5 class="modal-title" id="tittle_modal">Pagar <i class="fa-solid fa-wand-magic-sparkles"></i> </h5> 
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <audio id="modalSoundCorrecto">
                <source src="../audios/correcto.mp3" type="audio/mp3">
            </audio>

            <audio id="modalSoundIncorrecto">
                <source src="../audios/error.mp3" type="audio/mp3">
            </audio>

              <form>
                <div class="form-group">
                  <small id="text_init_pagar" class="form-text text-muted">Por favor ingrese la información para el pago con su cuenta</small>
                  <label for="valor_pagar" class="d-flex align-items-center"><i class="fa-solid fa-coins"></i></label>
                  <input type="number" class="form-control" id="valor_pagar" aria-describedby="valor_pagar" placeholder="Ingrese el valor a pagar">
                </div>
              </form>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary btn_enviar" id="enviar_correo" onclick="open_modal_pagar();">Enviar <i class="fa-solid fa-thumbs-up"></i></button>
              <button type="button" class="btn btn-primary btn_enviar" id="btnconfirmarpago" onclick="save_pago();">Confirmar <i class="fa-solid fa-thumbs-up"></i></button>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL ERROR ALERT-->

      <div id="alertSwal" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <div class="icon-box">
                <i class="fa-solid fa-circle-xmark"></i>
              </div>				
              <h4 class="modal-title w-100">Atención!</h4>	
            </div>
            <div class="modal-body">
              <p id="error-message">Se ha producido un error.</p>
            </div>
            
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
  
           
          </div>
          
        </div>
      </div>     


      <!-- MODAL EXIT ALERT -->


      <div id="alertSwalExit" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <div class="icon-box-exit">
               <i class="fa-solid fa-check-double"></i>
              </div>				
              <h4 class="modal-title w-100">Atención!</h4>	
            </div>
            <div class="modal-body">
              <p id="success-message">Hecho satisfactoriamente</p>
            </div>
            
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
  
           
          </div>
          
        </div>
      </div>    


      <!-- MODAL VER SALDO -->


      <div class="modal fade" id="modal_ver_saldo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered static" role="document">
          <div class="modal-content">
            <div class="modal-header recargar_cuenta">
              <h5 class="modal-title" id="tittle_modal">Consultar saldo <i class="fa-solid fa-comments-dollar"></i></i> </h5> 
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <audio id="modalSoundCorrecto">
                <source src="../audios/correcto.mp3" type="audio/mp3">
            </audio>

            <audio id="modalSoundIncorrecto">
                <source src="../audios/error.mp3" type="audio/mp3">
            </audio>

              <form>
               @csrf
                  <div class="form-group">
                  <small id="text_init" class="form-text text-muted">Por favor ingrese la información para la consulta de su saldo</small>
                    <label for="documento">Documento <i class="fa-regular fa-id-card"></i></label>
                    <input type="number" class="form-control" id="documento_consult" aria-describedby="Documento" placeholder="Ingrese su documento">
                  </div>
                  <div class="form-group">
                    <label for="celular">Celular <i class="fa-solid fa-mobile"></i></label>
                    <input type="number" class="form-control" id="celular_consult" placeholder="Ingrese su número de celular">
                  </div>
                </form>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary btn_enviar" id="enviar_correo" onclick="ver_saldo();">Consultar <i class="fa-solid fa-thumbs-up"></i></button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modal_saldo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered static" role="document">
          <div class="modal-content">
            <div class="modal-header recargar_cuenta">
              <h5 class="modal-title" id="tittle_modal">Consultar saldo <i class="fa-solid fa-comments-dollar"></i></i> </h5> 
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <audio id="modalSoundCorrecto">
                <source src="../audios/correcto.mp3" type="audio/mp3">
            </audio>

            <audio id="modalSoundIncorrecto">
                <source src="../audios/error.mp3" type="audio/mp3">
            </audio>

              <div class="card">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch content_saldo">
                          <div class="align-self-center">
                            <h1 class="mr-2" id="Saldo_actual">$36,000.00</h1>
                          </div>
                          <div class="media-body">
                            <h4>Saldo disponible</h4>
                            <span>Mes actual</span>
                          </div>
                          <div class="align-self-center icon-saldo">
                           <i class="fa-solid fa-coins"></i>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

  
  @endsection

 
    
</body>
</html>