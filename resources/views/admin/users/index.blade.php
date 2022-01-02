@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"> Socios</h1>
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
            <div class="card">
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Nombre</th>
                           <th>Fecha de registro</th>
                           <th>Email</th>
                           <th>Acciones</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($users as $user)
                        <tr>
                           <td>{{$user->id}}</td>
                           <td>{{$user->name}}</td>
                           <td>{{$user->created_at->format('d M Y')}}</td>
                           <td>{{$user->email}}</td>
                           <td>
                              <a class="boton btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}">
                              Editar
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