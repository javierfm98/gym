@extends('layouts.menu') 

@section('title', 'Pagos')
@section('content')

      <div class="row">
         <h3 class="title-wrapper">Listado de pagos de clientes</h3>
         <div class="col-9">
            <form>
               <input type="text" name="search" class="search-bar" placeholder="Buscar..." id="search-bar" autocomplete="off"> 
               <i class="fas fa-search fa-fw icon-search"></i>
            </form>
         </div>
      </div>

      <div class="table-responsive mt-4">

         @if (session('notification'))
            <div class="alert alert-success" role="alert">
               {{ session('notification') }}
            </div>
         @endif
         
         @if(count($subscriptions) > 0)
         <table class="table custom-table">
            <thead>
               <tr style="text-align: center;">
                  <th>nombre</th>
                  <th>apellido</th>
                  <th>Tipo</th>
                  <th>Estatus</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>

               

               @foreach ($subscriptions as $subscription)
                  <tr class="list" style="text-align: center;">
                     <td> {{ $subscription->user->name }} </td>
                     <td> {{ $subscription->user->surname }} </td>
                     <td>{{ $subscription->rate->name}}</td>
                     <td>
                           @if($subscription->status == 1)
                              <span class="badge badge-pill badge-success">PAGADO</span>
                           @else
                               <span class="badge badge-pill badge-danger">IMPAGO</span>
                           @endif
                     </td>
                     <td>
                        <div class="d-flex flex-row-reverse">
                           <form action="{{ route('subscriptions.unpaid') }}" method="POST">
                              @csrf
                              <input type="hidden" name="id" value="{{ $subscription->id }}">
                              <button class="btn-circle border-0"> <i class="fas fa-times fa-fw"></i> </button>
                           </form>     
                           <form action="{{ route('subscriptions.paid') }}" method="POST">
                              @csrf
                              <input type="hidden" name="id" value="{{ $subscription->id }}">
                              <button type="submit" class="btn-circle border-0"> <i class="fas fa-check fa-fw"></i> </button>
                           </form> 
                        </div>
                     </td>
                  </tr>
                  <tr class="spacer"></tr>
               @endforeach
            </tbody>
         </table>
         @else
            <div class="container mt-5 empty d-flex justify-content-center">
               <h3 style="opacity: 0.5;" >No hay clientes</h3>
            </div>
         @endif
      </div>
      <div class="border-0">
         {{ $subscriptions->links('vendor.pagination.custom') }}  
      </div>
@endsection

@section('scripts')

<script src="{{ asset('js/search.js') }}"></script> 

@endsection

