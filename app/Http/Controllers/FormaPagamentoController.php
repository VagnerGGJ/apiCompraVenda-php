<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\FormaPagamento;
use Illuminate\Http\Request;

class FormaPagamentoController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        $data = FormaPagamento::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        /**
         * Regras de validação.
         */
        $validation = [
            'fpg_nome' => 'required|string|max:80',  // Nome obrigatório, até 80 caracteres
            'fpg_ativo' => 'required|in:1,0',  // Campo obrigatório, aceita apenas '1' ou '0'
        ];

        $validatedData = $request->validate($validation);

        $data = new FormaPagamento();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = FormaPagamento::findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        /**
         * Regras de validação.
         */
        $validation = [
            'fpg_nome' => 'nullable|string|max:80',  // Nome obrigatório, até 80 caracteres
            'fpg_ativo' => 'nullable|in:1,0',  // Campo obrigatório, aceita apenas '1' ou '0'
        ];

        $data = FormaPagamento::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = FormaPagamento::destroy($id);

        return $this->deletedResponse($data);
    }
}
