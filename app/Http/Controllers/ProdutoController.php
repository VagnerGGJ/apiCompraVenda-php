<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Produto::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'pro_nome' => 'required|string|max:80',  // Nome do produto opcional, até 80 caracteres
            'pro_estoque' => 'nullable|numeric|min:0|max:99999999.9999',  // Quantidade em estoque com precisão de 4 casas decimais
            'pro_unidade' => 'nullable|string|max:5',  // Unidade de medida opcional, até 5 caracteres
            'pro_preco' => 'required|numeric|min:0|max:99999999.99',  // Preço de venda com precisão de 2 casas decimais
            'pro_custo' => 'nullable|numeric|min:0|max:99999999.99',  // Custo do produto com precisão de 2 casas decimais
            'pro_atacado' => 'nullable|numeric|min:0|max:99999999.99',  // Preço de atacado com precisão de 2 casas decimais
            'pro_min' => 'nullable|numeric|min:0|max:99999999.9999',  // Estoque mínimo com precisão de 4 casas decimais
            'pro_max' => 'nullable|numeric|min:0|max:99999999.9999',  // Estoque máximo com precisão de 4 casas decimais
            'pro_embalagem' => 'nullable|numeric|min:0|max:9999999.999',  // Tamanho da embalagem com precisão de 3 casas decimais
            'pro_peso' => 'nullable|numeric|min:0|max:99999999.9999',  // Peso do produto com precisão de 4 casas decimais
            'pro_dtcadastro' => 'nullable|date',  // Data de cadastro, deve ser uma data válida
            'pro_obs' => 'nullable|string',  // Observações opcionais, tipo de texto longo
            'pro_ativo' => 'required|in:0,1',  // Ativo opcional, apenas '1' (Sim) ou '0' (Não)
            'pro_tipo' => 'nullable|in:F,V',  // Tipo de produto opcional, apenas 'F' (Físico) ou 'V' (Virtual)
        ];

        $validatedData = $request->validate($validation);

        $data = new Produto();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = Produto::with([
            'CompraProdutos',
            'VendaProdutos'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'pro_nome' => 'nullable|string|max:80',  // Nome do produto opcional, até 80 caracteres
            'pro_estoque' => 'nullable|numeric|min:0|max:99999999.9999',  // Quantidade em estoque com precisão de 4 casas decimais
            'pro_unidade' => 'nullable|string|max:5',  // Unidade de medida opcional, até 5 caracteres
            'pro_preco' => 'nullable|numeric|min:0|max:99999999.99',  // Preço de venda com precisão de 2 casas decimais
            'pro_custo' => 'nullable|numeric|min:0|max:99999999.99',  // Custo do produto com precisão de 2 casas decimais
            'pro_atacado' => 'nullable|numeric|min:0|max:99999999.99',  // Preço de atacado com precisão de 2 casas decimais
            'pro_min' => 'nullable|numeric|min:0|max:99999999.9999',  // Estoque mínimo com precisão de 4 casas decimais
            'pro_max' => 'nullable|numeric|min:0|max:99999999.9999',  // Estoque máximo com precisão de 4 casas decimais
            'pro_embalagem' => 'nullable|numeric|min:0|max:9999999.999',  // Tamanho da embalagem com precisão de 3 casas decimais
            'pro_peso' => 'nullable|numeric|min:0|max:99999999.9999',  // Peso do produto com precisão de 4 casas decimais
            'pro_dtcadastro' => 'nullable|date',  // Data de cadastro, deve ser uma data válida
            'pro_obs' => 'nullable|string',  // Observações opcionais, tipo de texto longo
            'pro_ativo' => 'nullable|in:0,1',  // Ativo opcional, apenas '1' (Sim) ou '0' (Não)
            'pro_tipo' => 'nullable|in:F,V',  // Tipo de produto opcional, apenas 'F' (Físico) ou 'V' (Virtual)
        ];

        $validatedData = $request->validate($validation);

        $data = Produto::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = Produto::destroy($id);

        return $this->deletedResponse($data);
    }
}
