@extends('layouts.menu') 

@section('title', 'Reservar')
@section('content')

				@if(session('cosa'))
					<input type="hidden" id="juan" value="{{ session('cosa') }}">
				@endif


				<div class="training-container">
					<div class="date-picker-container">
						<input type="date" class="input-date" id="datePicker">
						<i class="far fa-calendar-alt fa-fw date-icon "></i> 
					</div>

				@if (session('notification'))
					<div class="custom-alert alert-red">
						{{ session('notification') }}
					</div> 
				@endif

				<div id="trainings"></div>	
			</div> 


			<div class="modal-container" id="modal-container">
				<div class="modal-wrapper hidden-modal" id="modal">
					<div class="modal-custom">
						<div class="header-modal">
							<div class="close-modal">
								<small>Selecciona el cliente que quiere apuntar</small>
								<button class="button-back" id="close-modal" onClick="closeModal()"><i class="fas fa-times fa-fw"></i></button>
							</div>
							<div class="search-container-modal">
								<form autocomplete="off">
									<input type="text" name="search" class="search-bar-modal" placeholder="Buscar..." id="search-bar">
									<i class="fas fa-search fa-fw icon-search-modal"></i>
									<span class="clear-search-bar" onclick="clearSearchBar()"></span>
									<input type="hidden" name="" id="id_training">					
								</form>
							</div>
							<hr class="spacer-training">
						</div>
						<div class="body-modal">
							<table class="table-modal">
								<thead>
									<tr>
										<th>nombre</th>
										<th></th>
									</tr>
									<tr class="spacer-modal"></tr>
								</thead>
								<tbody id=result>
								</tbody>
							</table>
						</div>
						<p id="buscar"></p>
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

