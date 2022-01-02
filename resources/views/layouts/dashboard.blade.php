@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0"> </h1>
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
         @if (\App\Http\Controllers\DashboardController::isClient(auth()->user()->id))
         <div class="col-12">
            <div class="row">
               @foreach ($activities as $activity)
               <div class="col-lg-3">
                  <div class="card actividad">
                     <div class="nombre-actividad">
                        <p>{{$activity->name}} <span class="activity-duration">{{$activity->duration}}min</span></p>
                     </div>
                     <div class="card-body table-responsive p-0">
                        <p class="texto-silenciado">{{$activity->schedule}}  <span class="activity-capacity">{{$activity->capacity}} plazas restantes</span></p>
                        <form method="POST" action="{{ route('reserva.store') }}">
                           @csrf
                           <input type="hidden" value="{{auth()->user()->id}}" name="userID">
                           <input type="hidden" value="{{$activity->id}}" name="activityID">
                           @if (\App\Http\Controllers\DashboardController::alreadyBooked($activity->id,auth()->user()->id))
                           @else
                           <button type="submit" class="reserva-actividad">Reservar</button>
                           @endif
                        </form>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
            <!-- /.card -->
         </div>
         <div class="col-12">
            <p><b>Tu asistencia esta semana</b></p>
            <div class="card">
               <div class="card-body table-responsive p-0">
                  <ul id="activity-tracker">
                     <li class="track-weekday">L</li>
                     <li class="track-weekday">M</li>
                     <li class="track-weekday">X</li>
                     <li class="track-weekday">J</li>
                     <li class="active-track-weekday">V</li>
                     <li class="track-weekday">S</li>
                     <li class="track-weekday">D</li>
                  </ul>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
         <div class="col-12">
            <p><b>Reservas para esta semana</b></p>
            <div class="card">
               <div class="messages-box">
                  <div class="list-group rounded-0">
                     @foreach ($bookedActivities as $bookedActivity)
                     <a href="#" class="list-group-item list-group-item-action list-group-item-light rounded-0 aviso-clase-reservada">
                        <div class="media">
                           <img src="{{ asset('/media/img/login-img.png') }}" alt="user" width="50" class="rounded-circle">
                           <div class="media-body ml-4">
                              <div class="d-flex align-items-center justify-content-between mb-1">
                                 <h6 class="mb-0">{{$bookedActivity->instructor_name}}</h6>
                                 <form id="delete-form" method="POST" action="{{ route('reserva.destroy', $bookedActivity->activity_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Cancelar reserva">
                                 </form>
                              </div>
                              <p class="text-muted mb-0 text-small" style="opacity: 65%;">Sera tu instructor para la clase de {{$bookedActivity->name}} </p>
                           </div>
                        </div>
                     </a>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
         @else
         @endif
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection