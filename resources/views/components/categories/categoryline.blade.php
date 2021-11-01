<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $category->name }}</td>
    <td>
        @can('delete.categories')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm"
            title="Deletar Categoria"
            data-container="#delete" 
            data-url="{{ route('panel.categories.destroy', $category) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="DELETE"
        ><i class="fas fa-trash-alt"></i></button>
        @endcan

        @can('edit.categories')
    	<button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Categoria"
            data-container=".form-edit" 
            data-url="{{ route('panel.categories.edit', $category) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>