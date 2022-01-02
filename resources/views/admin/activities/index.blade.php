@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"> Actividades</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
   <div class="container">
   @if (session('success'))
   <div class="alert alert-primary alert-dismissible fade show" role="alert" id="exito-creado">
        {{ \Session::get('success') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
    @endif
      <div class="row">
         <div class="col-12">
            <a href="/admin/activities/create" class="add-btn btn-primary">Nueva actividad</a>
         </div>
         <div class="col-12">
            <div class="card">
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Nombre</th>
                           <th>Fecha</th>
                           <th>Plazas</th>
                           <th>Instructor</th>
                           <th>Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($activities as $activity)
                        <tr>
                           <td>{{$activity->id}}</td>
                           <td>{{$activity->name}}</td>
                           <td>{{$activity->created_at->format('d M Y')}}</td>
                           <td>{{$activity->capacity}}</td>
                           <td>{{$activity->instructor_name}}</td>
                           <td>
                              <a class="boton btn btn-info btn-sm" href="{{ route('activities.edit', $activity->id) }}">
                              Editar
                              </a>
                              <a class="btn btn-sm" href="{{ route('activities.destroy', $activity->id) }}">
                                 <form id="delete-form" method="POST" action="{{ route('activities.destroy', $activity->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn-danger boton" value="Eliminar">
                                 </form>
                              </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection