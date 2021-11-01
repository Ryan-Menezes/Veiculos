<tr>
    <td>{{ $vehicle->id }}</td>
    <td><img class="image rounded border image-table" src="{{ asset('storage/' . $vehicle->firstImage()) }}"></td>
    <td>{{ $vehicle->brand }}</td>
    <td>{{ $vehicle->model }}</td>
    <td>{{ $vehicle->year }}</td>
    <td>{{ $vehicle->createdAtFormat }}</td>
    <td>{{ $vehicle->updatedAtFormat }}</td>
    <td>
        @can('delete.vehicles')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm"
            title="Deletar Veículo"
            data-container="#delete" 
            data-url="{{ route('panel.vehicles.destroy', $vehicle) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="DELETE"
        ><i class="fas fa-trash-alt"></i></button>
        @endcan

        @can('edit.vehicles')
    	<button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Veículo"
            data-container=".form-edit" 
            data-url="{{ route('panel.vehicles.edit', $vehicle) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>