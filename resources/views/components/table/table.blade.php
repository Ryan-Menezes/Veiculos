<div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools row">
                @if($btnnew)
                <div class="col d-flex align-items-center">
                    <button
                        class="btn btn-sm btn-danger load-ajax-click" 
                        data-container=".form-create" 
                        data-url="{{ route($routeCreate) }}"
                        data-token="{{ csrf_token() }}"
                        data-remove="false"
                        data-append="false"
                        data-method="GET"
                        data-loading="false"
                    >Novo</button>
                </div>
                @endif
                
                <div class="col d-flex align-items-center">
                    <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" placeholder="Buscar"
                        id="search"
                        class="form-control float-right load-ajax-enter" 
                        data-container=".{{ $container }}" 
                        data-url="{{ route($route, ['offset' => 0, 'limit' => 10]) }}"
                        data-token="{{ csrf_token() }}"
                        data-remove="false"
                        data-append="false"
                        data-method="POST"
                        data-data="{{ null }}"
                        data-loading="false"
                    >

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default" onclick="() => $('.load-ajax-enter').trigger('change')">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    @foreach($columns as $column)
                    <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="{{ $container }}">
                <x-table.btnload class="autoclick" container=".{{ $container }}" route="{{ $route }}" removeElement="#parentLoading"/>          
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>