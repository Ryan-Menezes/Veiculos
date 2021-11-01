<tr>
    <td>{{ $discount->code }}</td>
    <td>{{ $discount->percentage }}</td>
    <td>{{ $discount->expirationDateFormat }}</td>
    <td>
        @can('delete.discounts')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm"
            title="Deletar Desconto"
            data-container="#delete" 
            data-url="{{ route('panel.discounts.destroy', $discount) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="DELETE"
        ><i class="fas fa-trash-alt"></i></button>
        @endcan

        @can('edit.discounts')
    	<button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Desconto"
            data-container=".form-edit" 
            data-url="{{ route('panel.discounts.edit', $discount) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>