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
    <script src="../js/cuentas.js"></script>
</head>
<body>


    <div class="card card_creacion_head">
    <div class="card-header">
        Crear cuenta
    </div>
    <div class="card-body card_creacion">
        
        <form>
            
           <small id="emailHelp" class="form-text text-muted">Ingrese los datos para creación de cuentas de los usuarios.</small>
           <br>
            <div class="form-group">
                <label for="">Cedula</label>
                <input type="number" class="form-control" id="cedula" aria-describedby="cedula" placeholder="Ingrese cédula">
                
            </div>
            <div class="form-group">
                <label for="">Celular</label>
                <input type="number" class="form-control" id="celular" placeholder="Ingrese celular">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Ingrese email">
            </div>
            <button type="button" class="btn btn-primary btn_cuenta" onclick="crear_cuenta();">Guardar</button>
        </form>



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



    

  
  @endsection

  
    
</body>
</html>