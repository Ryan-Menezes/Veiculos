<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                'offset'        => $users->count(),
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('panel.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Verifica permissão
        if(Gate::denies('edit.users')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar um usuário!'
            ]);
        endif;

        // Atualiza usuário
        if($user->update($request->all())):
            $user->roles()->sync($request->role);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
