<tr>
    <td>{{ $permission->id }}</td>
    <td>{{ $permission->name }}</td>
    <td>
        @can('view.permissions')
    	<button
            class="btn btn-sm btn-warning load-ajax-click" 
            data-container=".cont-show" 
            data-url="{{ route('panel.permissions.show', $permission) }}"
            data-token="{{ csrf_token() }}"
            data-remove="false"
            data-append="false"
            data-method="GET"
            data-loading="false"
        ><i class="fas fa-info"></i></button>
        @endcan
    </td>
</tr>