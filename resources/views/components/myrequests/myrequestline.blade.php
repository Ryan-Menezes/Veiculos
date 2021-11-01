<tr>
    <td>{{ $request->id }}</td>
    <td>{{ $request->priceFormat }}</td>
    <td>{{ $request->discountFormat }}</td>
    <td>{{ $request->statusFormat }}</td>
    <td>{{ $request->createdAtFormat }}</td>
    <td>
        <a href="{{ route('site.requests.show', ['requestmodel' => $request]) }}" target="_blank" title="Visualizar Pedido {{ $request->id }}" class="mr-2"><i class="fas fa-external-link-alt"></i> Ver Pedido</a>
        @if($request->status == 'PA' || $request->status == 'PE')
    	<button 
            class="btn btn-sm btn-danger load-ajax-confirm",
            title="Cancelar Pedido" 
            data-container="#cancel" 
            data-url="{{ route('panel.myrequests.cancel', $request) }}"
            data-token="{{ csrf_token() }}"
            data-method="POST"
            data-_method="PUT"
        ><i class="fas fa-ban"></i></button>
        @endif
    </td>
</tr>