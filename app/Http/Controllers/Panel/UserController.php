<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    User,
    Role
};
use Gate;

class UserController extends Controller
{
    private $user;
    private $prefix = 'panel.';

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.users')) abort(404);

        // carregando view
        $title = 'Usuários';
        $columns = $this->user->columns;

        return view($this->prefix . 'users.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.users')) abort(404);

        // Carregando view
        $users = $this->user->search($search, $offset, $limit);

        $html = '';

        foreach($users as $user):
           $html .= view('components.users.userline', compact('user'));
        endforeach;

        if($users->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-users-body',
                'route'         => 'panel.users.load',
                'removeElement' => '#parentLoading',
                'offset'        => $users->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado algum usuário
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem usuários no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar usuários com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function edit(User $user)
    {
        // Verifica permissão        
        if(Gate::denies('edit.users')) abort(404);

        $roles = Role::all()->pluck('name', 'id');
        return view($this->prefix . 'users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Verifica permissão
        if(Gate::denies('edit.users')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um usuário!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();

        $data['cpf'] = str_ireplace(['.', '-', ' '], '', $data['cpf']);
        $data['phone'] = str_ireplace(['(', ')', ' ', '-'], '', $data['phone']);

        // Validando os dados
        $validator = $user->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Faz upload da imagem de perfil
        if($request->hasFile('image') && $request->file('image')->isValid()):
            do{
                $imageName = md5(uniqid() . rand(0, 999999) . $user->id) . '.' . $request->image->extension();
            }while(Storage::exists($user->uploadDir . '/' . $imageName));
            
            // DELETA IMAGEM ANTIGA
            if(!empty($user->image) && Storage::exists($user->image))
                Storage::delete($user->image);

            // UPLOAD
            $request->image->storeAs($user->uploadDir, $imageName);
            $data['image'] = $user->uploadDir . '/' . $imageName;
        endif;

        // Atualiza usuário
        if($user->update($data)):
            $user->roles()->sync($data['role']);

            return json_encode([
                'success'   => true,
                'message'   => 'Usuário editado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Usuário não editado, Ocorreu um erro no processo de edição!'
        ]);
    }

    public function destroy(User $user)
    {
        // Verifica permissão
        if(Gate::denies('delete.users')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar um usuário!'
            ]);
        endif;

        // Deletando um usuário
        if($user->delete()):
            return json_encode([
                'success'   => true,
                'message'   => 'Usuário deletado com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Usuário não deletado, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
