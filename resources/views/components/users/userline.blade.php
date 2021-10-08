<tr>
    <td>{{ $user->id }}</td>
    <td><img class="image rounded border image-table" src="{{ asset('assets/images/anonimo.png') }}"></td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->created_at }}</td>
    <td>{{ $user->updated_at }}</td>
    <td>
    	@if($user->id != auth()->user()->id)
	    	<button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
	    	<button
                class="btn btn-sm btn-primary load-ajax-click" 
                data-container=".form-editcreate" 
                data-url="{{ route('panel.users.edit', $user) }}"
                data-token="{{ csrf_token() }}"
                data-remove="false"
                data-append="false"
                data-method="GET"
                data-loading="false"
            ><i class="fas fa-pencil-alt"></i></button>
	    @else
	    	<p>-</p>
	    @endif
    </td>
</tr>