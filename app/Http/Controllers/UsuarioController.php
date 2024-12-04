<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\RestControllerTrait;
use App\Http\Traits\ValidationControllerTrait;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    use RestControllerTrait;

    /**
     * Regras de validação para os métodos store e update.
     */
    private const VALIDATION_RULES_STORE = [
        'usu_nome' => 'required|string|max:80',  // Nome do usuário opcional, até 80 caracteres
        'usu_login' => 'required|string|max:20|unique:usuario,usu_login',  // Login do usuário obrigatório, único, até 20 caracteres
        'usu_senha' => 'required|string|min:8|max:80',  // Senha do usuário obrigatória, entre 8 e 80 caracteres
        'usu_cadastro' => 'nullable|date',  // Data de cadastro opcional, deve ser uma data válida
        'usu_ativo' => 'nullable|in:0,1',  // Usuário ativo opcional, apenas '1' (Sim) ou '0' (Não)
    ];

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Usuario::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'usu_nome' => 'required|string|max:80',  // Nome do usuário opcional, até 80 caracteres
            'usu_login' => 'required|string|max:20|unique:usuario,usu_login',  // Login do usuário obrigatório, único, até 20 caracteres
            'usu_senha' => 'required|string|min:8|max:80',  // Senha do usuário obrigatória, entre 8 e 80 caracteres
            'usu_cadastro' => 'nullable|date',  // Data de cadastro opcional, deve ser uma data válida
            'usu_ativo' => 'nullable|in:0,1',  // Usuário ativo opcional, apenas '1' (Sim) ou '0' (Não)
        ];

        $validatedData = $request->validate($validation);

        $data = new Usuario();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = Usuario::with([
            'compras',
            'vendas'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        /**
         * Regras de validação
         */
        $validation = [
            'usu_nome' => 'nullable|string|max:80',  // Nome do usuário opcional, até 80 caracteres
            'usu_login' => 'nullable|string|max:20|unique:usuario,usu_login',  // Login do usuário, único, até 20 caracteres
            'usu_senha' => 'nullable|string|min:8|max:80',  // Senha do usuário, entre 8 e 80 caracteres
            'usu_cadastro' => 'nullable|date',  // Data de cadastro opcional, deve ser uma data válida
            'usu_ativo' => 'nullable|in:0,1',  // Usuário ativo opcional, apenas '1' (Sim) ou '0' (Não)
        ];

        $validatedData = $request->validate($validation);

        $data = Usuario::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = Usuario::destroy($id);

        return $this->deletedResponse($data);
    }
}
