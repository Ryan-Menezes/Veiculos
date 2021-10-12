<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\{
    Vehicle,
    Manufacturer
};
use Gate;

class VehicleController extends Controller
{
    private $vehicle;
    private $prefix = 'panel.';

    public function __construct(Vehicle $vehicle){
        $this->vehicle = $vehicle;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.vehicles')) abort(404);

        // carregando view
        $title = 'Veículos';
        $columns = $this->vehicle->columns;

        return view($this->prefix . 'vehicles.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.vehicles')) abort(404);

        // Carregando view
        $vehicles = $this->vehicle->search($search, $offset, $limit);

        $html = '';

        foreach($vehicles as $vehicle):
           $html .= view('components.vehicles.vehicleline', compact('vehicle'));
        endforeach;

        if($vehicles->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-vehicles-body',
                'route'         => 'panel.vehicles.load',
                'removeElement' => '#parentLoading',
                'offset'        => $vehicles->count(),
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado algum usuário
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem veículos no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar veículos com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = [];
        $ports = [];
        $status = ['D' => 'Disponível', 'I' => 'Indisponível'];
        $manufacturers = Manufacturer::all()->pluck('name', 'id');
        for($i = 1901; $i <= date('Y'); $i++) $years[$i] = $i;
        for($i = 1; $i <= 10; $i++) $ports[$i] = $i;

        return view('panel.vehicles.create', compact('years', 'ports', 'manufacturers', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::of($data['brand'])->slug('-');

        // Verifica permissão
        if(Gate::denies('create.vehicles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para cadastrar um veículo!'
            ]);
        endif;

        // Atualiza usuário
        if($this->vehicle->create($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Veículo cadastrado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Veículo não cadastrado, Ocorreu um erro no processo de cadastro!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        // Verifica permissão
        if(Gate::denies('delete.vehicles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar um veículo!'
            ]);
        endif;

        // Deletando um veículo
        if($vehicle->delete()):
            return json_encode([
                'success'   => true,
                'message'   => 'Veículo deletado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Veículo não deletado, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
