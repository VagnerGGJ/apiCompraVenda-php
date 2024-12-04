<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Compra::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'cpr_emissao' => 'required|date',  // Data de emissão opcional e no formato de data
            'cpr_valor' => 'required|numeric|min:0|max:99999999.99',  // Valor com precisão de 2 casas decimais
            'cpr_desconto' => 'nullable|numeric|min:0|max:99999999.99',  // Desconto com precisão de 2 casas decimais
            'cpr_total' => 'required|numeric|min:0|max:99999999.99',  // Total com precisão de 2 casas decimais
            'cpr_dtentrada' => 'nullable|date',  // Data de entrada opcional e no formato de data
            'cpr_obs' => 'nullable|string|max:65535',  // Campo de observação opcional, com limite de caracteres
            'usu_codigo' => 'required|exists:usuario,usu_codigo',  // Código de usuário, obrigatório e existente na tabela usuarios
            'for_codigo' => 'required|exists:fornecedor,for_codigo',  // Código de fornecedor, obrigatório e existente na tabela fornecedores
        ];

        $validatedData = $request->validate($validation);

        $data = new Compra();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = Compra::with([
            'fornecedor',
            'usuario',
            'compraProdutos'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'cpr_emissao' => 'nullable|date',  // Data de emissão opcional e no formato de data
            'cpr_valor' => 'nullable|numeric|min:0|max:99999999.99',  // Valor com precisão de 2 casas decimais
            'cpr_desconto' => 'nullable|numeric|min:0|max:99999999.99',  // Desconto com precisão de 2 casas decimais
            'cpr_total' => 'nullable|numeric|min:0|max:99999999.99',  // Total com precisão de 2 casas decimais
            'cpr_dtentrada' => 'nullable|date',  // Data de entrada opcional e no formato de data
            'cpr_obs' => 'nullable|string|max:65535',  // Campo de observação opcional, com limite de caracteres
            'usu_codigo' => 'nullable|exists:usuario,usu_codigo',  // Código de usuário, existente na tabela usuarios
            'for_codigo' => 'nullable|exists:fornecedor,for_codigo',  // Código de fornecedor, existente na tabela fornecedores
        ];

        $validatedData = $request->validate($validation);

        $data = Compra::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = Compra::destroy($id);

        return $this->deletedResponse($data);
    }
}
