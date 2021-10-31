<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\{
    Vehicle,
    Category,
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
                'offset'        => $vehicles->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado algum veículo
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

    public function create()
    {
        // Verifica permissão
        if(Gate::denies('create.vehicles')) abort(404);

        $years = array_combine(range(1901, date('Y')), range(1901, date('Y')));
        $ports = range(1, 10);
        $status = ['D' => 'Disponível', 'I' => 'Indisponível'];
        $categories = Category::all()->pluck('name', 'id');
        $manufacturers = Manufacturer::all()->pluck('name', 'id');

        return view($this->prefix . 'vehicles.create', compact('years', 'ports', 'categories', 'manufacturers', 'status'));
    }

    public function store(Request $request)
    {
        // Verifica permissão
        if(Gate::denies('create.vehicles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um veículo!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();
        $data['slug'] = Str::of($data['brand'] . ' ' . $data['model'])->slug('-');

        // Formatando as datas
        if(!empty($data['release_date'])):
            $d = explode('/', $data['release_date']);
            $data['release_date'] = $d[2] . '-' . $d[1] . '-' . $d[0];
        endif;

        if(!empty($data['promotion_date'])):
            $d = explode('/', $data['promotion_date']);
            $data['promotion_date'] = $d[2] . '-' . $d[1] . '-' . $d[0];
        endif;

        // Validando os dados
        $validator = $this->vehicle->validateCreate($data);
        if(!is_null($validator)) return $validator;

        // Cadastra veículo
        $vehicle = $this->vehicle->create($data);

        if($vehicle):
            // Cadastra imagens do veículo
            if($request->hasFile('images')):
                foreach($request->images as $image):
                    if($image->isValid()):
                        do{
                            $imageName = md5(uniqid() . rand(0, 999999) . $vehicle->id) . '.' . $image->extension();
                        }while(Storage::exists($vehicle->uploadDir . '/' . $imageName));

                        // UPLOAD
                        $image->storeAs($vehicle->uploadDir, $imageName);
                        $vehicle->images()->create(['image' => $vehicle->uploadDir . '/' . $imageName]);
                    endif;
                endforeach;
            endif;

            // Cadastrando categorias do veículo
            $vehicle->categories()->sync($data['categories']);

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

    public function edit(Vehicle $vehicle)
    {
        // Verifica permissão
        if(Gate::denies('edit.vehicles')) abort(404);

        $years = array_combine(range(1901, date('Y')), range(1901, date('Y')));
        $ports = range(1, 10);
        $status = ['D' => 'Disponível', 'I' => 'Indisponível'];
        $categories = Category::all()->pluck('name', 'id');
        $manufacturers = Manufacturer::all()->pluck('name', 'id');

        return view($this->prefix . 'vehicles.edit', compact('vehicle', 'years', 'ports', 'categories', 'manufacturers', 'status'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Verifica permissão
        if(Gate::denies('edit.vehicles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um veículo!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();
        $data['slug'] = Str::of($data['brand'] . ' ' . $data['model'])->slug('-');
        $request->vehicles_remove = explode(',', $request->vehicles_remove);

        // Formatando as datas
        if(!empty($data['release_date'])):
            $d = explode('/', $data['release_date']);
            $data['release_date'] = $d[2] . '-' . $d[1] . '-' . $d[0];
        endif;

        if(!empty($data['promotion_date'])):
            $d = explode('/', $data['promotion_date']);
            $data['promotion_date'] = $d[2] . '-' . $d[1] . '-' . $d[0];
        endif;

        // Validando os dados
        $validator = $vehicle->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Editando veículo
        if($vehicle->update($data)):
            // Deleta imagens selecionadas
            $images = $vehicle->images->whereIn('id', $request->vehicles_remove);

            foreach($images as $image):
                if(!empty($image->image) && Storage::exists($image->image)):
                    Storage::delete($image->image);
                endif;

                $image->delete();
            endforeach;

            // Cadastra novas imagens do veículo
            if($request->hasFile('images')):
                foreach($request->images as $image):
                    if($image->isValid()):
                        do{
                            $imageName = md5(uniqid() . rand(0, 999999) . $vehicle->id) . '.' . $image->extension();
                        }while(Storage::exists($vehicle->uploadDir . '/' . $imageName));

                        // UPLOAD
                        $image->storeAs($vehicle->uploadDir, $imageName);
                        $vehicle->images()->create(['image' => $vehicle->uploadDir . '/' . $imageName]);
                    endif;
                endforeach;
            endif;

            // Edita categorias do veículo
            $vehicle->categories()->sync($data['categories']);

            return json_encode([
                'success'   => true,
                'message'   => 'Veículo editado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Veículo não editado, Ocorreu um erro no processo de edição!'
        ]);
    }

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
