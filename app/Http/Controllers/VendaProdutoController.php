<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\VendaProduto;
use Illuminate\Http\Request;

class VendaProdutoController extends Controller
{
    use RestControllerTrait;

    /**
     * Regras de validação para os métodos store e update.
     */
    private const VALIDATION_RULES = [
        'vep_qtde' => 'required|numeric|min:0|max:99999999.9999',  // Quantidade vendida obrigatório, deve ser numérica e não negativa, com precisão de 4 casas decimais
        'vep_preco' => 'required|numeric|min:0|max:99999999.99',  // Preço unitário obrigatório, deve ser numérico e não negativo, com precisão de 2 casas decimais
        'vep_desconto' => 'nullable|numeric|min:0|max:99999999.99',  // Desconto aplicado opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
        'vep_total' => 'required|numeric|min:0|max:99999999.99',  // Total da venda obrigatório, deve ser numérico e não negativo, com precisão de 2 casas decimais
        'vda_codigo' => 'required|exists:venda,vda_codigo',  // Chave estrangeira para venda obrigatória, deve existir na tabela 'venda'
        'pro_codigo' => 'required|exists:produto,pro_codigo',  // Chave estrangeira para produto obrigatória, deve existir na tabela 'produto'
    ];

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = VendaProduto::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = new VendaProduto();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = VendaProduto::with([
            'Produto',
            'Venda'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = VendaProduto::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = VendaProduto::destroy($id);

        return $this->deletedResponse($data);
    }
}
