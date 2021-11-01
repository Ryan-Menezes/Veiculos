<tr>
    <td>{{ $manufacturer->id }}</td>
    <td><img class="image rounded border image-table" src="{{ asset('storage/' . $manufacturer->image) }}"></td>
    <td>{{ $manufacturer->name }}</td>
    <td>
        @can('delete.manufacturers')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm"
            title="Deletar Fabricante"
            data-container="#delete" 
            data-url="{{ route('panel.manufacturers.destroy', $manufacturer) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="DELETE"
        ><i class="fas fa-trash-alt"></i></button>
        @endcan

        @can('edit.manufacturers')
    	<button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Fabricante"
            data-container=".form-edit" 
            data-url="{{ route('panel.manufacturers.edit', $manufacturer) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>