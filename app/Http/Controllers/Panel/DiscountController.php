<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Discount;
use Gate;

class DiscountController extends Controller
{
    private $discount;
    private $prefix = 'panel.';

    public function __construct(Discount $discount){
        $this->discount = $discount;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.discounts')) abort(404);

        // carregando view
        $title = 'Descontos';
        $columns = $this->discount->columns;

        return view($this->prefix . 'discounts.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.discounts')) abort(404);

        // Carregando view
        $discounts = $this->discount->search($search, $offset, $limit);

        $html = '';

        foreach($discounts as $discount):
           $html .= view('components.discounts.discountline', compact('discount'));
        endforeach;

        if($discounts->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-discounts-body',
                'route'         => 'panel.discounts.load',
                'removeElement' => '#parentLoading',
                'offset'        => $discounts->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado algum desconto
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem descontos no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar descontos com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function create()
    {
        // Verifica permissão        
        if(Gate::denies('create.discounts')) abort(404);

        return view($this->prefix . 'discounts.create');
    }

    public function store(Request $request)
    {
        // Verifica permissão
        if(Gate::denies('create.discounts')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para cadastrar um desconto!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();
        $data['code'] = strtoupper(Str::of($data['code'])->slug('-'));

        // Formatando datas
        if(!empty($data['expiration_date'])):
            $d = explode('/', $data['expiration_date']);
            $data['expiration_date'] = $d[2] . '-' . $d[1] . '-' . $d[0];
        endif;

        // Validando os dados
        $validator = $this->discount->validateCreate($data);
        if(!is_null($validator)) return $validator;

        // Cadastra desconto
        if($this->discount->create($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Desconto cadastrado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Desconto não cadastrado, Ocorreu um erro no processo de cadastro!'
        ]);
    }

    public function edit(Discount $discount)
    {
        // Verifica permissão        
        if(Gate::denies('edit.discounts')) abort(404);

        return view($this->prefix . 'discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        // Verifica permissão
        if(Gate::denies('edit.discounts')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um desconto!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();
        $data['code'] = strtoupper(Str::of($data['code'])->slug('-'));

        // Formatando datas
        if(!empty($data['expiration_date'])):
            $d = explode('/', $data['expiration_date']);
            $data['expiration_date'] = $d[2] . '-' . $d[1] . '-' . $d[0];
        endif;

        // Validando os dados
        $validator = $discount->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Edita desconto
        if($discount->update($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Desconto editado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Desconto não editado, Ocorreu um erro no processo de edição!'
        ]);
    }

    public function destroy(Discount $discount)
    {
        // Verifica permissão
        if(Gate::denies('delete.discounts')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar um desconto!'
            ]);
        endif;

        // Deletando um desconto
        if($discount->delete()):
            return json_encode([
                'success'   => true,
                'message'   => 'Desconto deletado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Desconto não deletado, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
