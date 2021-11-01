<tr>
    <td>{{ $role->id }}</td>
    <td>{{ $role->name }}</td>
    <td>
        @can('delete.roles')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm"
            title="Deletar Função"
            data-container="#delete" 
            data-url="{{ route('panel.roles.destroy', $role) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="DELETE"
        ><i class="fas fa-trash-alt"></i></button>
        @endcan

        @can('edit.roles')
    	<button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Função"
            data-container=".form-edit" 
            data-url="{{ route('panel.roles.edit', $role) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>