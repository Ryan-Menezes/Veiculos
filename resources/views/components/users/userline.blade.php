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
	    	<button class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></button>
	    @else
	    	<p>-</p>
	    @endif
    </td>
</tr>