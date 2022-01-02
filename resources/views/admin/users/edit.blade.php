@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Editar <small>User ID {{$user->id}}</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/users">Todos los usuarios</a></li>
              <li class="breadcrumb-item active">Editar usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
          <!-- general form elements -->
        <div class="card">
              <!-- form start -->
              <form method="POST" action="{{ route('users.update', $user->id) }}">
              @csrf
              @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{$user->name}}">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$user->email}}">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection