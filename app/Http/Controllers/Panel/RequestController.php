<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Models\Vehicle;
use Gate;

class RequestController extends Controller
{
    private $requestmodel;
    private $prefix = 'panel.';

    public function __construct(RequestModel $requestmodel){
        $this->requestmodel = $requestmodel;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.requests')) abort(404);

        // carregando view
        $title = 'Pedidos';
        $columns = $this->requestmodel->columns;

        return view($this->prefix . 'requests.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.requests')) abort(404);

        // Carregando view
        $requests = $this->requestmodel->search($search, $offset, $limit);

        $html = '';

        foreach($requests as $request):
           $html .= view('components.requests.requestline', compact('request'));
        endforeach;

        if($requests->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-requests-body',
                'route'         => 'panel.requests.load',
                'removeElement' => '#parentLoading',
                'offset'        => $requests->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado alguma categoria
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem pedidos no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar pedidos com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function show(RequestModel $requestmodel){
        // Verifica permissão        
        if(Gate::denies('view.requests')) abort(404);

        return view($this->prefix . 'requests.show', compact('requestmodel'));
    }

    public function edit(RequestModel $requestmodel)
    {
        // Verifica permissão        
        if(Gate::denies('edit.requests')) abort(404);

        return view($this->prefix . 'requests.edit', compact('requestmodel'));
    }

    public function update(RequestModel $requestmodel, Request $request)
    {
        // Verifica permissão
        if(Gate::denies('edit.requests')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um pedido!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        $validator = $requestmodel->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Edita pedido
        if($requestmodel->update($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Pedido editado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Pedido não editado, Ocorreu um erro no processo de edição!'
        ]);
    }

    public function destroy(RequestModel $requestmodel)
    {
        // Verifica permissão
        if(Gate::denies('delete.requests')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar um pedido!'
            ]);
        endif;

        // Deletando um pedido
        if($requestmodel->delete()):
            return json_encode([
                'success'   => true,
                'message'   => 'Pedido deletado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Pedido não deletada, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
