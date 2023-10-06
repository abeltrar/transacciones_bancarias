@extends('layouts.maestra01')

@section('content')
   

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <form action="{{route('CreaCarrera')}}">

                  <input type="submit" value="Nuevo" class="btn btn-outline-primary">

                 </form>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">

                <thead>
                  
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Duración</th>
                    <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  @foreach($carreras as $carrera)
                    <tr>    
                        <td>{{$carrera->id}}</td>
                        <td>{{$carrera->nombre_carrera}}</td>
                        <td>{{$carrera->descripcion}}</td>
                        <td>{{$carrera->tiempo}} (años)</td>
                        <td>
                            <form action="{{route('UpdateCarrera')}}" method="get">

                              <input type="hidden" name="id_carrera" value="{{$carrera->id}}">
                              <input type="submit" value="Editar" class="btn btn-outline-info">

                            </form>
                            <form action="{{route('delete')}}" method="POST">

                              @csrf
                              @method('DELETE')

                              <input type="hidden" name="id_carrera" value="{{$carrera->id}}">
                              <input type="submit" value="Eliminar" class="btn btn-outline-danger" style="margin-left: 80px; margin-top: -65px">

                            </form>
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
   
   

@endsection

@section('titulo')

    <div class="bienvenido">
        <h1 class="m-0"><strong>Listado de carreras</strong></h1>
    </div>

@endsection