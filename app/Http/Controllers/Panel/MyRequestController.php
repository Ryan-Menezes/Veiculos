<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Models\Vehicle;
use App\Classes\Payment;
use Gate;

class MyRequestController extends Controller
{
    private $payment;
    private $requestmodel;
    private $prefix = 'panel.';

    public function __construct(RequestModel $requestmodel){
        $this->payment = new Payment(config('payment.token.live'), config('payment.email'));
        $this->requestmodel = $requestmodel;
    }

    public function index()
    {
        // carregando view
        $title = 'Meus Pedidos';
        $columns = ['ID', 'Preço(R$)', 'Desconto(R$)', 'Status', 'Criado em', 'Ações'];

        return view($this->prefix . 'myrequests.index', compact('title', 'columns'));
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        // Carregando view
        $requests = $this->requestmodel->search($search, $offset, $limit, Auth::user()->id);

        $html = '';

        foreach($requests as $request):
           $html .= view('components.myrequests.myrequestline', compact('request'));
        endforeach;

        if($requests->count() >= 10 && !empty($html)):
            $html .= view('components.table.btnload', [
                'container'     => '.table-requests-body',
                'route'         => 'panel.myrequests.load',
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
                    'message' => 'Não há pedidos feitos por você!'
                ]);
            else
                $html = view('components.table.messageline', [
                    'message' => 'Não foi possível localizar pedidos com os dados relacionados há: ' . $search
                ]);
        }   

        return $html;
    }

    public function cancel(RequestModel $requestmodel)
    {
        // Verifica permissão
        if(Gate::denies('request-user', $requestmodel)):
            return json_encode([
                'success'   => false,
                'message'   => 'Você não tem permissão para cancelar este pedido!'
            ]);
        endif;

        if($this->payment->cancel($requestmodel->id)){
            $requestmodel->status = 'CA';

            if($requestmodel->save()):
                return json_encode([
                    'success'   => true,
                    'message'   => 'Pedido cancelado com sucesso!'
                ]);
            endif;
        }

        return json_encode([
            'success'   => false,
            'message'   => 'Pedido não cancelado, Ocorreu um erro no processo para cancelar!'
        ]);
    }
}
