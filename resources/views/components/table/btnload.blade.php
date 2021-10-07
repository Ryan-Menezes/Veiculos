<tr id="parentLoading">
    <td colspan="500">
        <div class="loading">
            <button 
                class="btn btn-sm btn-danger load-ajax-click {{ $class ?? null }}" 
                data-container="{{ $container }}" 
                data-url="{{ route($route, ['offset' => $offset, 'limit' => $limit, 'search' => $search]) }}"
                data-token="{{ csrf_token() }}"
                data-removeelement="{{ $removeElement ?? null }}"
                data-remove="{{ $remove ?? true }}"
                data-append="{{ $append ?? true }}"
                data-method="{{ $method ?? 'POST' }}"
                data-data="{{ $datax ?? null }}"
            >
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </td>
</tr>