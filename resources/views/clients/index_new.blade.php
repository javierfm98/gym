@extends('layouts.menu') 

@section('title', 'Clientes')
@section('content')

      <div class="row">
         <h3 class="title-wrapper">Clientes</h3>
         <div class="col-9">
         <form autocomplete="off">
             <input type="text" name="search" class="search-bar" placeholder="Buscar..." id="search-bar">
             <i class="fas fa-search fa-fw icon-search"></i>
         </form>
         </div>
         <div class="col d-flex flex-row-reverse">
            <a href="{{ route('clients.create') }}" class="boton-add boton"> <i class="fas fa-plus fa-fw"></i>Añadir cliente</a>
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
            <tbody id="result">

            </tbody>
         </table>


@endsection

@section('scripts')

<script src="{{ asset('js/search.js') }}"></script> 

@endsection

