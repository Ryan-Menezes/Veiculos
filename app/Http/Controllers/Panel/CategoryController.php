<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Gate;

class CategoryController extends Controller
{
    private $category;
    private $prefix = 'panel.';

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function index()
    {
        // Verifica permissão        
        if(Gate::denies('view.categories')) abort(404);

        // carregando view
        $title = 'Categorias';
        $columns = $this->category->columns;

        return view($this->prefix . 'categories.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Verifica permissão
        if(Gate::denies('view.categories')) abort(404);

        // Carregando view
        $categories = $this->category->search($search, $offset, $limit);

        $html = '';

        foreach($categories as $category):
           $html .= view('components.categories.categoryline', compact('category'));
        endforeach;

        if($categories->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-categories-body',
                'route'         => 'panel.categories.load',
                'removeElement' => '#parentLoading',
                'offset'        => $categories->count() + $offset,
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        // Verificando se foi encontrado alguma categoria
        if(empty($html)){
            if(empty($search))
                $html = view('components.table.messageline', [
                    'message' => 'Sem categorias no sistema!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar categorias com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function create()
    {
        // Verifica permissão        
        if(Gate::denies('create.categories')) abort(404);

        return view($this->prefix . 'categories.create');
    }

    public function store(Request $request)
    {
        // Verifica permissão
        if(Gate::denies('create.categories')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para cadastrar uma categoria!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();
        $data['slug'] = Str::of($data['name'] )->slug('-');

        // Validando os dados
        $validator = $this->category->validateCreate($data);
        if(!is_null($validator)) return $validator;

        // Cadastra categoria
        if($this->category->create($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Categoria cadastrada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Categoria não cadastrada, Ocorreu um erro no processo de cadastro!'
        ]);
    }

    public function edit(Category $category)
    {
        // Verifica permissão        
        if(Gate::denies('edit.categories')) abort(404);

        return view($this->prefix . 'categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Verifica permissão
        if(Gate::denies('edit.categories')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para editar uma categoria!'
            ]);
        endif;

        // Dados do formulário
        $data = $request->all();
        $data['slug'] = Str::of($data['name'] )->slug('-');

        // Validando os dados
        $validator = $category->validateUpdate($data);
        if(!is_null($validator)) return $validator;

        // Edita categoria
        if($category->update($data)):
            return json_encode([
                'success'   => true,
                'message'   => 'Categoria editada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Categoria não editada, Ocorreu um erro no processo de edição!'
        ]);
    }

    public function destroy(Category $category)
    {
        // Verifica permissão
        if(Gate::denies('delete.categories')):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para deletar uma categoria!'
            ]);
        endif;

        // Deletando uma categoria
        if($category->delete()):
            return json_encode([
                'success'   => true,
                'message'   => 'Categoria deletada com sucesso!'
            ]);
        endif;

        return json_encode([
            'success'   => false,
            'message'   => 'Categoria não deletada, Ocorreu um erro no processo de exclusão!'
        ]);
    }
}
