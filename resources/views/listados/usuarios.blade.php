@extends('layouts.maestra01')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--Hoja de estilos -->
  <link rel="stylesheet" href="../css/usuarios.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
   
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/usuarios.js"></script>


</head>
<body>




  <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

              
                <button type="submit" id="btn_open_modal" class="btn btn-outline-success"onclick='open_modal();'>
                  Nuevo
                  <i class="fa-solid fa-plus"></i>
                </button>

              
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="crud_usuarios" class="table table-bordered table-hover">
                    <thead>
                    
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha de creación</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($usuarios as $usuario)
                      <tr>    
                          <td>{{$usuario->id}}</td>
                          <td>{{$usuario->name}}</td>
                          <td>{{$usuario->email}}</td>
                          <td>{{$usuario->created_at}}</td>
                          <td>
                            <div class="wrap_registro">
                              

                            
                              <button type="button" class="btn btn-outline-info get_data_user ubicacion_form" data-toggle="modal" data-id="{{ $usuario->id }}" onclick='get_data(this, "{{ route('verUsuario') }}",mode_ver);'>
                                  <i class="fa-regular fa-eye"></i>
                              </button>

                              
                              <button type="button" class="btn btn-outline-warning get_data_user ubicacion_form" data-toggle="modal" data-id="{{ $usuario->id }}" onclick='update_data(this, "{{ route('verUsuario') }}",mode_editar);'>
                                <i class="fa-regular fa-pen-to-square"></i>
                              </button>



                              <form action="{{route('deleteUser')}}" method="POST" class="ubicacion_form">

                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="idusuario" value="{{$usuario->id}}">
                                <button type="submit" class="btn btn-outline-danger">
                                  <i class="fa-solid fa-trash"></i>
                                </button>

                              </form>
                            </div>
                          </td>
                      </tr>
                  @endforeach
                  
                    </tbody>
                    
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              
                <!-- /.card-body -->
            
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

      </section>


      <div class="modal" tabindex="-1" id="crearUsuarioModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h5 class="modal-title">Crear usuario</h5>
                  
                </div>
                <div class="modal-body">
                  
                  
                  
                  <div class="container">
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                              <div class="card">
                                
                                  <div class="card-body">
                                      <form method="POST" action="{{ route('store') }}">
                                          @csrf

                                          <div class="row mb-3">
                                              <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                              <div class="col-md-6">
                                                  <input id="name" type="text" class="form-control" name="name">

                              
                                              </div>
                                          </div>

                                          <div class="row mb-3">
                                              <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                              <div class="col-md-6">
                                                  <input id="email" type="email" class="form-control" name="email" >

                                                  @error('email')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                                              </div>
                                          </div>

                                          <div class="row mb-3">
                                              <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                              <div class="col-md-6">
                                                  <input id="password" type="password" pattern=".{6,}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                  @error('password')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                                              </div>
                                          </div>

                                          <div class="row mb-3">

                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <select class="form-control" id="id_cargo" name="id_cargo">
                                                    <option selected>Seleccione</option>
                                                    <option value="1">Administrativo</option>
                                                    <option value="2">Operativo</option>
                                                </select>
                                              </div>
                                            </div>

                                          </div>

                                          <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Guardar') }}
                                                </button>
                                              
                                            </div>
                                          </div>

                                
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>



          <!-- Modal ver_usuario -->

          <div class="modal" tabindex="-1" id="modal_ver_usuario">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                 
                  
                </div>
                <div class="modal-body">

                  <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username" id="name_user"></h3>
                    <h5 class="widget-user-desc">Usuario</h5>
                  </div>
                  <div class="widget-user-image">
                    <img id="userAvatar" src="" alt="User Avatar">
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">Email</h5>
                          <span class="description-text" id="emailUser"></span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header">Fecha de creación</h5>
                          <span class="description-text" id="creacionUser"></span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header">Rol</h5>
                          <span class="description-text" id="rol_usuario"></span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                  
                    <!-- /.row -->
                  </div>
                  <br>
                  <div class="centered-form">

          
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  
                  </div>
                  
                </div>
                  
                  
              
                </div>
                <div class="modal-footer">
                  
                </div>
            </div>
          </div>
      </div>



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
            
             <button class="btn btn-success btn-block" onclick='close_modal();'>OK</button>
  
           
          </div>
          
        </div>
      </div>     


      <!-- MODAL EXIT ALERT -->


      <div id="alertSwalExit" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <div class="icon-box-exit">
                <i class="fa-solid fa-circle-xmark"></i>
              </div>				
              <h4 class="modal-title w-100">Atención!</h4>	
            </div>
            <div class="modal-body">
              <p id="error-message">Hecho satisfactoriamente</p>
            </div>
            
             <button class="btn btn-success btn-block" onclick='close_modalExit();'>OK</button>
  
           
          </div>
          
        </div>
      </div>    


      <!-- Modal update -->


      <div class="modal" tabindex="-1" id="modal_edit_usuario">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body">
              <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username" id="name_user_edit"></h3>
                    <h5 class="widget-user-desc">Usuario</h5>
                </div>
                <div class="widget-user-image">
                    <img id="userAvatarEdit" src="" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                      <div class="container">
                          <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                  <div class="card-body">
                                      <form method="POST" action="{{ route('editUsuario') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="idusuario_edit" name="idusuario" value="">
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                            <div class="col-md-6">
                                              <input id="name_edit" type="text" class="form-control" name="name" value="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                            <div class="col-md-6">
                                              <input id="email_edit" type="email" class="form-control" name="email" value="" >
                                              @error('email')
                                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                              @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Cargo') }}</label>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                  <select class="form-control" id="id_cargo_edit" name="id_cargo">
                                                    <option selected>Seleccione</option>
                                                    <option value="1">Administrativo</option>
                                                    <option value="2">Usuario</option>
                                                  </select>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                            <div class="col-md-6">
                                              <input id="password_edit" type="password" pattern=".{6,}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="">
                                              @error('password')
                                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                              </span>
                                              @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                              <button type="submit" class="btn btn-primary">
                                              {{ __('Guardar') }}
                                              </button>
                                            </div>
                                        </div>
                                      </form>
                                  </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <br>
                    <div class="centered-form">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
              </div>
          </div>
        </div>
    

  @endsection

  @section('titulo')

      <div class="bienvenido">
          <h1 class="m-0"><strong>Listado de usuarios</strong></h1>
      </div>

  @endsection
  
</body>
</html>

<script>
    var verUsuarioUrl = "{{ route('verUsuario') }}";
    var mode_ver = "ver";
    var mode_editar = "editar";
    var guardar_userURL = "{{ route('store') }}";
</script>

    

   
  