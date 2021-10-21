<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    Role,
    Permission
};
use Gate;

class RoleController extends Controller
{
    private $role;
    private $prefix = 'panel.';

    public function __construct(Role $role){
        $this->role = $role;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.roles')) abort(404);

        // carregando view
        $title = 'Funções';
        $columns = $this->role->columns;

        return view($this->prefix . 'roles.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.roles')) abort(404);

        // Carregando view
        $roles = $this->role->search($search, $offset, $limit);

        $html = '';

        foreach($roles as $role):
           $html .= view('components.roles.roleline', compact('role'));
        endforeach;

        if($roles->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-roles-body',
                'route'         => 'panel.roles.load',
                'removeElement' => '#parentLoading',
                'offset'        => $roles->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado alguma categoria
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem funções no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar funções com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function create(){
        // Verifica permissão        
        if(Gate::denies('create.roles')) abort(404);

        $permissions = Permission::all()->pluck('name', 'id');

        return view($this->prefix . 'roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Verifica permissão
        if(Gate::denies('create.roles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para cadastrar uma função!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        $validator = $this->role->validateCreate($data);
        if(!is_null($validator)) return $validator;

        // Cadastra função
        $role = $this->role->create($data);

        if($role):
            if(!empty($data['permissions'])):
                $role->permissions()->sync($data['permissions']);
            endif;

            return json_encode([
                'success'   => true,
                'message'   => 'Função cadastrada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Função não cadastrada, Ocorreu um erro no processo de cadastro!'
        ]);
    }

    public function edit(Role $role)
    {
        // Verifica permissão        
        if(Gate::denies('edit.roles')) abort(404);

        $permissions = Permission::all()->pluck('name', 'id');

        return view($this->prefix . 'roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // Verifica permissão
        if(Gate::denies('edit.roles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar uma função!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        $validator = $role->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Edita função
        if($role->update($data)):
            if(!empty($data['permissions'])):
                $role->permissions()->sync($data['permissions']);
            else:
                $role->permissions()->detach();
            endif;

            return json_encode([
                'success'   => true,
                'message'   => 'Função editada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Função não editada, Ocorreu um erro no processo de edição!'
        ]);
    }

    public function destroy(Role $role)
    {
        // Verifica permissão
        if(Gate::denies('delete.roles')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar uma função!'
            ]);
        endif;

        // Deletando uma função
        if($role->delete()):
            return json_encode([
                'success'   => true,
                'message'   => 'Função deletada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Função não deletada, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
