<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Gate;

class PerfilController extends Controller
{
    public function index(){
    	$title = 'Perfil';
    	$user = Auth::user();

    	return view('panel.perfil.index', compact('title', 'user'));
    }

    public function updateUser(Request $request)
    {
    	$user = Auth::user();

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
            return json_encode([
                'success'   => true,
                'message'   => 'Dados atualizados com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Dados não atualizados, Ocorreu um erro no processo de atualização!'
        ]);
    }

    public function updateUserPassword(Request $request)
    {
    	$user = Auth::user();

        // Dados do formulário
        $data = $request->all();

        // Validando os dados
        $validator = $user->validateUpdatePassword($data);
        if(!is_null($validator)) return $validator;

        // Verificando senha
        if(!Hash::check($data['password'], $user->password)):
            return json_encode([
                'success'   => false,
                'message'   => 'A senha atual digitada está incorreta!'
            ]);
        endif;

        // Verifica se a nova senha digitada é igual a senha repetida
        if($data['newpassword'] != $data['rnewpassword']):
        	return json_encode([
                'success'   => false,
                'message'   => 'A senha repetida é diferente da nova senha!'
            ]);
        endif;

        // Atualiza senha do usuário
        if($user->update(['password' => Hash::make($data['newpassword'])])):
            return json_encode([
                'success'   => true,
                'message'   => 'Senha atualizada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Senha não atualizada, Ocorreu um erro no processo de atualização!'
        ]);
    }
}
