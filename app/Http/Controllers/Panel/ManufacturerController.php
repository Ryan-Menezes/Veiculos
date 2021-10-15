<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Manufacturer;
use Gate;

class ManufacturerController extends Controller
{
    private $manufacturer;
    private $prefix = 'panel.';

    public function __construct(Manufacturer $manufacturer){
        $this->manufacturer = $manufacturer;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.manufacturers')) abort(404);

        // carregando view
        $title = 'Fabricantes';
        $columns = $this->manufacturer->columns;

        return view($this->prefix . 'manufacturers.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.manufacturers')) abort(404);

        // Carregando view
        $manufacturers = $this->manufacturer->search($search, $offset, $limit);

        $html = '';

        foreach($manufacturers as $manufacturer):
           $html .= view('components.manufacturers.manufacturerline', compact('manufacturer'));
        endforeach;

        if($manufacturers->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-manufacturers-body',
                'route'         => 'panel.manufacturers.load',
                'removeElement' => '#parentLoading',
                'offset'        => $manufacturers->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado algum fabricante
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem fabricantes no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar fabricantes com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function create()
    {
        // Verifica permissão        
        if(Gate::denies('create.manufacturers')) abort(404);

        return view($this->prefix . 'manufacturers.create');
    }

    public function store(Request $request)
    {
        // Verifica permissão
        if(Gate::denies('create.manufacturers')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para cadastrar um fabricante!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        $validator = $this->manufacturer->validateCreate($data);
        if(!is_null($validator)) return $validator;

        // Cadastra fabricante
        $manufacturer = $this->manufacturer->create($data);

        if($manufacturer):
            // Cadastra imagem do fabricante
            if($request->hasFile('image') && $request->image->isValid()):
                do{
                    $imageName = md5(uniqid() . rand(0, 999999) . $manufacturer->id) . '.' . $request->image->extension();
                }while(Storage::exists($manufacturer->uploadDir . '/' . $imageName));

                // UPLOAD
                $request->image->storeAs($manufacturer->uploadDir, $imageName);
                $data['image'] = $manufacturer->uploadDir . '/' . $imageName;
                $manufacturer->update($data);
            endif;

            return json_encode([
                'success'   => true,
                'message'   => 'Fabricante cadastrado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Fabricante não cadastrado, Ocorreu um erro no processo de cadastro!'
        ]);
    }

    public function edit(Manufacturer $manufacturer)
    {
        // Verifica permissão        
        if(Gate::denies('edit.manufacturers')) abort(404);

        return view($this->prefix . 'manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, Manufacturer $manufacturer)
    {
        // Verifica permissão
        if(Gate::denies('edit.manufacturers')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um fabricante!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        // Validando os dados
        $validator = $manufacturer->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Atualiza imagem do fabricante
        if($request->hasFile('image') && $request->image->isValid()):
            do{
                $imageName = md5(uniqid() . rand(0, 999999) . $manufacturer->id) . '.' . $request->image->extension();
            }while(Storage::exists($manufacturer->uploadDir . '/' . $imageName));

            // DELETA IMAGEM DO FABRICANTE
            if(!empty($manufacturer->image) && Storage::exists($manufacturer->image))
                Storage::delete($manufacturer->image);

            // UPLOAD
            $request->image->storeAs($manufacturer->uploadDir, $imageName);
            $data['image'] = $manufacturer->uploadDir . '/' . $imageName;
            $manufacturer->update($data);
        endif;

        // Edita fabricante
        if($manufacturer->update($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Fabricante editado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Fabricante não editado, Ocorreu um erro no processo de edição!'
        ]);
    }

    public function destroy(Manufacturer $manufacturer)
    {
        // Verifica permissão
        if(Gate::denies('delete.manufacturers')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar um fabricante!'
            ]);
        endif;

        // Deletando um fabricante
        if($manufacturer->delete()):
            // DELETA IMAGEM DO FABRICANTE
            if(!empty($manufacturer->image) && Storage::exists($manufacturer->image))
                Storage::delete($manufacturer->image);

            return json_encode([
                'success'   => true,
                'message'   => 'Fabricante deletado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Fabricante não deletado, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
