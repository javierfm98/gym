    <div class="table-responsive">
        <table class="table custom-table mt-5">
          <thead>
            <tr style="text-align: center; border-bottom: 1px solid #ececec !important;">
              <th scope="col">Valor</th>
              <th scope="col">Tipo</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($measurements as $measurement)
            <tr class="border_bottom" style="text-align: center;">
              <td>{{ $measurement->value }}</td>
              <td>{{ $measurement->stat->description }}</td>
               <td>
                  <div>
                    <form action="{{ route('bodies.destroy', $measurement->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-circle border-0" data-toggle="tooltip" data-placement="top" title="Eliminar"> <i class="fas fa-times fa-fw "></i> </button> 
                    </form>
                  </div>
               </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>

