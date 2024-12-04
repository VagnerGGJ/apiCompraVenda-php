<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Venda::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'vda_data' => 'required|date',  // Data da venda opcional, deve ser uma data válida
            'vda_valor' => 'required|numeric|min:0|max:99999999.99',  // Valor total da venda opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
            'vda_desconto' => 'nullable|numeric|min:0|max:99999999.99',  // Desconto aplicado opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
            'vda_total' => 'required|numeric|min:0|max:99999999.99',  // Total após desconto opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
            'vda_obs' => 'nullable|string|max:500',  // Observações sobre a venda opcionais, deve ser uma string e pode ter até 500 caracteres
            'usu_codigo' => 'required|exists:usuario,usu_codigo',  // Chave estrangeira para usuário obrigatória, deve existir na tabela 'usuario'
            'cli_codigo' => 'required|exists:cliente,cli_codigo',  // Chave estrangeira para cliente obrigatória, deve existir na tabela 'cliente'
        ];

        $validatedData = $request->validate($validation);

        $data = new Venda();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = Venda::with([
            'cliente',
            'usuario',
            'vendaProdutos',
            'vendaFormaPagamentos'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'vda_data' => 'nullable|date',  // Data da venda opcional, deve ser uma data válida
            'vda_valor' => 'nullable|numeric|min:0|max:99999999.99',  // Valor total da venda opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
            'vda_desconto' => 'nullable|numeric|min:0|max:99999999.99',  // Desconto aplicado opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
            'vda_total' => 'nullable|numeric|min:0|max:99999999.99',  // Total após desconto opcional, deve ser numérico e não negativo, com precisão de 2 casas decimais
            'vda_obs' => 'nullable|string|max:500',  // Observações sobre a venda opcional, deve ser uma string e pode ter até 500 caracteres
            'usu_codigo' => 'nullable|exists:usuario,usu_codigo',  // Chave estrangeira para usuário obrigatória, deve existir na tabela 'usuario'
            'cli_codigo' => 'nullable|exists:cliente,cli_codigo',  // Chave estrangeira para cliente obrigatória, deve existir na tabela 'cliente'
        ];

        $validatedData = $request->validate($validation);

        $data = Venda::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = Venda::destroy($id);

        return $this->deletedResponse($data);
    }
}
