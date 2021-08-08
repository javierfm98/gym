@extends('layouts.menu') 

@section('title', 'Entrenadores')
@section('content')

      <div class="row">
         <h3 class="title-wrapper">Entrenadores</h3>
         <div class="col-9">
            <form>
               <input type="text" name="search" class="search-bar" placeholder="Buscar..." id="search-bar" autocomplete="off"> 
               <i class="fas fa-search fa-fw icon-search"></i>
            </form>
         </div>
         <div class="col d-flex flex-row-reverse">
            <a href="{{ route('trainers.create') }}" class="boton-add boton"> <i class="fas fa-plus fa-fw"></i>Añadir trainer</a>
         </div>
      </div>

      <div class="table-responsive mt-4">

         @if (session('notification'))
            <div class="alert alert-success" role="alert">
               {{ session('notification') }}
            </div>
         @endif

         <table class="table custom-table">
            <thead>
               <tr style="text-align: center;">
                  <th>nombre</th>
                  <th>apellido</th>
                  <th>correo</th>
                  <th>teléfono</th>
                  <th>Fecha</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($trainers as $trainer)
                  <tr class="list" style="text-align: center;">
                     <td> {{ $trainer->name }} </td>
                     <td> {{ $trainer->surname }} </td>
                     <td> {{ $trainer->email }} </td>
                     <td> {{ $trainer->phone }} </td>
                     <td>  {{ $trainer->created_at->format('d/m/Y')}} </td>
                     <td>
                        <div class="d-flex flex-row-reverse">
                           <button class="btn-circle border-0" data-toggle="tooltip" data-placement="top" title="Ver"> <i class="fas fa-ellipsis-h fa-fw"></i> </button>     
                           <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn-circle border-0" data-toggle="tooltip" data-placement="top" title="Eliminar"> <i class="fas fa-trash fa-fw"></i> </button>
                           </form> 
                           <a href="{{ route('trainers.edit', $trainer->id) }}" class="btn-circle border-0" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fas fa-user-edit fa-fw "></i> </a> 
                        </div>
                     </td>
                  </tr>
                  <tr class="spacer"></tr>
               @endforeach
            </tbody>
         </table>
         @if(count($trainers) < 1)
            <div class="container mt-5 empty d-flex justify-content-center">
               <h3 style="opacity: 0.5;" >No hay entrenadores</h3>
            </div>
         @endif
      </div>
      <div class="border-0">
         {{ $trainers->links('vendor.pagination.custom') }}  
      </div>

@endsection

@section('scripts')

<script src="{{ asset('js/search.js') }}"></script> 

@endsection

