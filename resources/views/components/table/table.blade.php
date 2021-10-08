<div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools row">
                {{-- <div class="col d-flex align-items-center">
                    <button class="btn btn-sm btn-danger">Novo</button>
                </div> --}}
                
                <div class="col d-flex align-items-center">
                    <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Buscar">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
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
            <tbody class="table-users-body">
                <x-table.btnload class="autoclick" container=".table-users-body" route="panel.users.load" removeElement="#parentLoading"/>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>