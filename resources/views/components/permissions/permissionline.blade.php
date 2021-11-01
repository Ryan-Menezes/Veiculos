<tr>
    <td>{{ $permission->id }}</td>
    <td>{{ $permission->name }}</td>
    <td>
        @can('edit.permissions')
        <button
            class="btn btn-sm btn-primary load-ajax-click" 
            title="Editar Permissão"
            data-container=".form-edit" 
            data-url="{{ route('panel.permissions.edit', $permission) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-pencil-alt"></i></button>
        @endcan
    </td>
</tr>