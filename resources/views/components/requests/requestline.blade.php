<tr>
    <td>{{ $request->id }}</td>
    <td>{{ $request->priceFormat }}</td>
    <td>{{ $request->discountFormat }}</td>
    <td>{{ $request->statusFormat }}</td>
    <td>{{ $request->createdAtFormat }}</td>
    <td>{{ $request->updatedAtFormat }}</td>
    <td>
    	@can('view.requests')
    	<button
            class="btn btn-sm btn-warning load-ajax-click" 
            title="Visualizar Pedido"
            data-container=".cont-show" 
            data-url="{{ route('panel.requests.show', $request) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-info"></i></button>
        @endcan

        @can('delete.requests')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm"
            title="Deletar Pedido"
            data-container="#delete" 
            data-url="{{ route('panel.requests.destroy', $request) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="DELETE"
        ><i class="fas fa-trash-alt"></i></button>
        @endcan

        @can('edit.requests')
    	<button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Pedido"
            data-container=".form-edit" 
            data-url="{{ route('panel.requests.edit', $request) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>