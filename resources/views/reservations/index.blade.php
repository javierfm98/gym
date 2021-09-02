@extends('layouts.menu') 

@section('title', 'Reservar')
@section('content')

 @if(session('cosa'))
	<input type="hidden" id="juan" value="{{ session('cosa') }}">
@endif
	

    <div class="mb-5 div-date">
       <input type="date" class="input-date" id="datePicker">
       <i class="far fa-calendar-alt fa-fw date-icon"></i> 
    </div>

@if (session('notification'))
      <div class="alert alert-danger  mb-5 alert-reservation " role="alert" id="same">
            {{ session('notification') }}
      </div> 
@endif

<div class="table-responsive" id="trainings"></div>
 

<div id="clientModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content modal-pop">
            <div class="modal-header">
                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="modal-title"><small>Selecciona el cliente que quiere apuntar</small></p>
                    </div>
                    <div class="col">
                        <form autocomplete="off">
                            <input type="text" name="search" class="search-bar-modal" placeholder="Buscar..." id="search-bar">
                            <i class="fas fa-search fa-fw icon-search-modal"></i>
                            <span class="clear" onclick="clearSearchBar()"></span>
                            <input type="hidden" name="" id="id_training">
                        </form>
                    </div>
                </div>
                
               
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               
            </div>
            <div class="modal-body">
            <div class="table-responsive">
               <table class="table-modal custom-table-modal">
                  <thead>
                     <tr>
                        <th>nombre</th>
                        <tr class="spacer-modal"></tr>
                     </tr>
                  </thead>
                  <tbody id="result">
                  	
                  </tbody>
               </table>
            </div>
            <p id="buscar"></p>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>

<script src="{{ asset('js/search.js') }}"></script> 
<script src="{{ asset('js/reservation.js') }}"></script>

<script>
    $(document).ready(function() {
        let url = new URLSearchParams(location.search);
        var date = url.get('date');
        let datePicker = $('#datePicker');
        if(date != null){
            datePicker.val(date);           
        }    
    });
</script>

@endsection



