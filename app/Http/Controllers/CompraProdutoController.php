<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\CompraProduto;
use Illuminate\Http\Request;

class CompraProdutoController extends Controller
{
    use RestControllerTrait;

    /**
     * Regras de validação para os métodos store e update.
     */
    private const VALIDATION_RULES = [
        'cpr_qtde' => 'required|numeric|min:0|max:99999999.9999',  // Quantidade com precisão de 4 casas decimais
        'cpr_preco' => 'required|numeric|min:0|max:99999999.99',  // Preço com precisão de 2 casas decimais
        'cpr_desconto' => 'nullable|numeric|min:0|max:99999999.99', // Desconto com precisão de 2 casas decimais
        'cpr_total' => 'required|numeric|min:0|max:99999999.99', // Total com precisão de 2 casas decimais
        'cpr_codigo' => 'required|exists:compra,cpr_codigo', // Verifica se cpr_codigo existe na tabela compras
        'pro_codigo' => 'required|exists:produto,pro_codigo', // Verifica se pro_codigo existe na tabela produtos
    ];

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = CompraProduto::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = new CompraProduto();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = CompraProduto::with([
            'Compra',
            'Produto'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = CompraProduto::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = CompraProduto::destroy($id);

        return $this->deletedResponse($data);
    }
}
