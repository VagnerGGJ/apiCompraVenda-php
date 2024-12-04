<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    use RestControllerTrait;

    /**
     * Regras de validação para os métodos store e update.
     */
    private const VALIDATION_RULES = [
        'pes_nome' => 'required|string|max:80',  // Nome opcional, até 80 caracteres
        'pes_fantasia' => 'nullable|string|max:80',  // Nome fantasia opcional, até 80 caracteres
        'pes_fisica' => 'required|in:F,J',  // Opcional, apenas 'F' (Física) ou 'J' (Jurídica)
        'pes_cpfcnpj' => 'nullable|string|max:20',  // CPF ou CNPJ opcional, até 20 caracteres
        'pes_rgie' => 'nullable|string|max:20',  // RG ou IE opcional, até 20 caracteres
        'pes_dtcadastro' => 'nullable|date',  // Data de cadastro opcional, deve ser uma data
        'pes_endereco' => 'nullable|string|max:120',  // Endereço opcional, até 120 caracteres
        'pes_numero' => 'nullable|string|max:10',  // Número opcional, até 10 caracteres
        'pes_complemento' => 'nullable|string|max:30',  // Complemento opcional, até 30 caracteres
        'pes_bairro' => 'nullable|string|max:50',  // Bairro opcional, até 50 caracteres
        'pes_cidade' => 'nullable|string|max:80',  // Cidade opcional, até 80 caracteres
        'pes_uf' => 'nullable|string|size:2',  // UF opcional, deve ter exatamente 2 caracteres
        'pes_cep' => 'nullable|string|max:9',  // CEP opcional, até 9 caracteres
        'pes_fone1' => 'nullable|string|max:15',  // Telefone 1 opcional, até 15 caracteres
        'pes_fone2' => 'nullable|string|max:20',  // Telefone 2 opcional, até 20 caracteres
        'pes_celular' => 'nullable|string|max:20',  // Celular opcional, até 20 caracteres
        'pes_site' => 'nullable|url|max:200',  // Site opcional, deve ser uma URL válida, até 200 caracteres
        'pes_email' => 'nullable|email|max:200',  // E-mail opcional, deve ser um e-mail válido, até 200 caracteres
        'pes_ativo' => 'nullable|in:0,1',  // Ativo opcional, apenas '1' (Sim) ou '0' (Não)
    ];

    public function __construct()
    {
        //        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Pessoa::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = new Pessoa();
        $data->fill($request->all());
        $data->save();

        return $this->createdResponse($data);
    }

    public function show($id)
    {
        $data = Pessoa::with([
            'Fornecedor',
            'Cliente'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(self::VALIDATION_RULES);

        $data = Pessoa::findOrFail($id);
        $data->update($request->all());

        return $this->showResponse($data);
    }

    public function destroy($id)
    {
        $data = Pessoa::destroy($id);

        return $this->deletedResponse($data);
    }
}
