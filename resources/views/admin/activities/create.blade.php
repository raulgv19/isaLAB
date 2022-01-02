@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Nueva actividad</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/activities">Todas las actividades</a></li>
              <li class="breadcrumb-item active">Nueva actividad</li>
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
              <form method="POST" action="{{ route('activities.store') }}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label>Capacidad</label>
                    <input type="number" class="form-control" name="capacity" placeholder="Capacidad">
                  </div>
                  <div class="form-group">
                    <label>Duracion</label>
                    <input type="number" class="form-control" name="duration" placeholder="Duracion">
                  </div>
                  <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" class="form-control" name="schedule" placeholder="Fecha">
                  </div>
                  
                  <div class="form-group">
                    <label>Instructor</label>
                    <input type="text" class="form-control" name="instructor_name" placeholder="Nombre del instructor">
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