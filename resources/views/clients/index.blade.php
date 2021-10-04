@extends('layouts.menu') 

@section('title', 'Clientes')
@section('content')

               <h3>Clientes</h3>
               <div class="header">
                  <div class="search-container">
                     <form>
                        <input type="text" name="search" class="search-bar" placeholder="Buscar..." id="search" autocomplete="off">
                        <i class="fas fa-search fa-fw icon-search"></i>
                     </form>
                  </div>
                  
                  <a href="{{ route('clients.create') }}" class="button button-add"> <i class="fas fa-plus fa-fw"></i>Añadir cliente</a> 
               </div>
               <div class="table-container">
                  @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                              {{ session('notification') }}
                        </div>
                     @endif

                  <table class="custom-table">
                     <thead>
                      <tr style="text-align: center;">
                         <th>nombre</th>
                         <th>apellido</th>
                         <th>correo</th>
                         <th>teléfono</th>
                         <th>fecha</th>
                         <th></th>
                      </tr>
                     </thead>
                     <tbody>
                        @foreach ($clients as $client)
                           <tr  style="text-align: center;">
                              <td> {{ $client->name }} </td>
                              <td> {{ $client->surname }} </td>
                              <td> {{ $client->email }} </td>
                              <td> {{ $client->phone }} </td>
                              <td> {{ $client->created_at->format('d/m/Y')}} </td>
                              <td>
                                 <div class="action-container">
                                  <a href="{{ route('clients.edit', $client->id) }}" class="button-circle"><i class="fas fa-user-edit fa-fw "></i></a>

                                  <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                    @csrf
                                       @method('DELETE')
                                    <button type="submit" class="button-circle"><i class="fas fa-trash fa-fw"></i></button>   
                                  </form>
                                    
                                 </div>
                              </td>
                           </tr>
                           <tr class="spacer"></tr>
                        @endforeach
                     </tbody>                   
                  </table>
                  @if(count($clients) < 1)
                        <div class="empty-data">
                           <h3>No hay clientes</h3>
                        </div>
                    @endif
               </div>
               <div>
                  {{ $clients->links('vendor.pagination.custom') }}  
               </div>

@endsection

@section('scripts')

<script src="{{ asset('js/searchClients.js') }}"></script>  


@endsection