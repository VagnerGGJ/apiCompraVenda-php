<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\VendaFormaPagamento;
use Illuminate\Http\Request;

class VendaFormaPagamentoController extends Controller
{
    use RestControllerTrait;

    /**
     * Regras de validação para os métodos store e update.
     */
    private const VALIDATION_RULES = [
        'vdp_valor' => 'required|numeric|min:0|max:99999999.99',  // Valor do pagamento obrigatório, deve ser numérico e positivo, com precisão de 2 casas decimais
        'vda_codigo' => 'required|exists:venda,vda_codigo',  // Chave estrangeira para venda obrigatória, deve existir na tabela 'venda'
        'fpg_codigo' => 'required|exists:formapagamento,fpg_codigo',  // Chave estrangeira para forma de pagamento obrigatória, deve existir na tabela 'formapagto'
    ];

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = VendaFormaPagamento::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = new VendaFormaPagamento();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = VendaFormaPagamento::with([
            'Formapagto',
            'Venda'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = VendaFormaPagamento::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = VendaFormaPagamento::destroy($id);

        return $this->deletedResponse($data);
    }
}
