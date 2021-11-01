<tr>
    <td>{{ $user->id }}</td>
    <td><img class="image rounded border image-table" src="{{ asset($user->imageFormat) }}"></td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->createdAtFormat }}</td>
    <td>{{ $user->updatedAtFormat }}</td>
    <td>
    	@if($user->id != auth()->user()->id)
            @can('delete.users')
	    	<button 
                class="btn btn-sm btn-danger load-ajax-confirm"
                title="Deletar Usuário"
                data-container="#delete" 
                data-url="{{ route('panel.users.destroy', $user) }}"
                data-token="{{ csrf_token() }}"
                data-method="POST"
                data-_method="DELETE"
            ><i class="fas fa-trash-alt"></i></button>
            @endcan

            @can('edit.users')
	    	<button
                class="btn btn-sm btn-primary load-ajax-click" 
                title="Editar Usuário"
                data-container=".form-edit" 
                data-url="{{ route('panel.users.edit', $user) }}"
                data-token="{{ csrf_token() }}"
                data-remove="false"
                data-append="false"
                data-method="GET"
                data-loading="false"
            ><i class="fas fa-pencil-alt"></i></button>
            @endcan
	    @else
	    	<p>-</p>
	    @endif
    </td>
</tr>