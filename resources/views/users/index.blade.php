@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> All Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Date Registered</th>
                      <th>Email</th>
                      <th>Actions</th>
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
                          <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                
                          <a class="btn btn-danger btn-sm" href="{{ route('users.destroy', $user->id) }}">
                              <form id="delete-form" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <i class="fas fa-trash">
                              </i>
                                <input type="submit" class="btn btn-danger" value="Delete">
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
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection