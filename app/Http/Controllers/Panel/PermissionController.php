<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Gate;

class PermissionController extends Controller
{
    private $permission;
    private $prefix = 'panel.';

    public function __construct(Permission $permission){
        $this->permission = $permission;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.permissions')) abort(404);

        // carregando view
        $title = 'Permissões';
        $columns = $this->permission->columns;

        return view($this->prefix . 'permissions.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.permissions')) abort(404);

        // Carregando view
        $permissions = $this->permission->search($search, $offset, $limit);

        $html = '';

        foreach($permissions as $permission):
           $html .= view('components.permissions.permissionline', compact('permission'));
        endforeach;

        if($permissions->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-permissions-body',
                'route'         => 'panel.permissions.load',
                'removeElement' => '#parentLoading',
                'offset'        => $permissions->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado alguma permissão
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem permissões no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar permissões com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function edit(Permission $permission)
    {
        // Verifica permissão        
        if(Gate::denies('edit.permissions')) abort(404);

        return view($this->prefix . 'permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        // Verifica permissão
        if(Gate::denies('edit.permissions')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar uma permissão!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        $validator = $permission->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Edita função
        if($permission->update($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Permissão editada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Permissão não editada, Ocorreu um erro no processo de edição!'
        ]);
    }
}
