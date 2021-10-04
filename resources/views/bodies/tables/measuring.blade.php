		<div class="table-container">
			<table class="custom-table">
				<thead>
					<tr style="text-align: center;">
					<th>valor</th>
					<th>tipo</th>
					<th>fecha</th>
					<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($measurements as $measurement)
						<tr style="text-align: center;">
						<td> {{ $measurement->value }} </td>
						<td> {{ $measurement->stat->description }} </td>
						<td> {{ $measurement->date->format('d-m-Y') }} </td>
						<td>
							<div class="action-container">
								<form action="{{ route('bodies.destroy', $measurement->id) }}" method="POST">
									@csrf
        							@method('DELETE')
									<button type="submit" class="button-circle"><i class="fas fa-times fa-fw"></i></button> 		
								</form>
							</div>
						</td>
						</tr>
						<tr class="spacer-body"></tr>
					@endforeach		
				</tbody>						 	
			</table>
		</div>