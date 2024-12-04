<?php

namespace App\Http\Controllers;

use App\Http\Traits\RestControllerTrait;
use App\Models\Cliente;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    use RestControllerTrait;

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Cliente::all();

        return $this->listResponse($data);
    }

    public function store(Request $request)
    {
        /**
         * Regras de validação.
         */
        $validation = [
            'pessoa.pes_nome' => 'required|string|max:80',  // Nome opcional, até 80 caracteres
            'pessoa.pes_fantasia' => 'nullable|string|max:80',  // Nome fantasia opcional, até 80 caracteres
            'pessoa.pes_fisica' => 'required|in:F,J',  // Opcional, apenas 'F' (Física) ou 'J' (Jurídica)
            'pessoa.pes_cpfcnpj' => 'nullable|string|max:20',  // CPF ou CNPJ opcional, até 20 caracteres
            'pessoa.pes_rgie' => 'nullable|string|max:20',  // RG ou IE opcional, até 20 caracteres
            'pessoa.pes_dtcadastro' => 'nullable|date',  // Data de cadastro opcional, deve ser uma data
            'pessoa.pes_endereco' => 'nullable|string|max:120',  // Endereço opcional, até 120 caracteres
            'pessoa.pes_numero' => 'nullable|string|max:10',  // Número opcional, até 10 caracteres
            'pessoa.pes_complemento' => 'nullable|string|max:30',  // Complemento opcional, até 30 caracteres
            'pessoa.pes_bairro' => 'nullable|string|max:50',  // Bairro opcional, até 50 caracteres
            'pessoa.pes_cidade' => 'nullable|string|max:80',  // Cidade opcional, até 80 caracteres
            'pessoa.pes_uf' => 'nullable|string|size:2',  // UF opcional, deve ter exatamente 2 caracteres
            'pessoa.pes_cep' => 'nullable|string|max:9',  // CEP opcional, até 9 caracteres
            'pessoa.pes_fone1' => 'nullable|string|max:15',  // Telefone 1 opcional, até 15 caracteres
            'pessoa.pes_fone2' => 'nullable|string|max:20',  // Telefone 2 opcional, até 20 caracteres
            'pessoa.pes_celular' => 'nullable|string|max:20',  // Celular opcional, até 20 caracteres
            'pessoa.pes_site' => 'nullable|url|max:200',  // Site opcional, deve ser uma URL válida, até 200 caracteres
            'pessoa.pes_email' => 'nullable|email|max:200',  // E-mail opcional, deve ser um e-mail válido, até 200 caracteres
            'pessoa.pes_ativo' => 'nullable|in:0,1',  // Ativo opcional, apenas '1' (Sim) ou '0' (Não)
            'cliente.cli_limitecred' => 'nullable|numeric|min:0|max:99999999.99',
        ];

        $validatedData = $request->validate($validation);

        /**
         * Cria objeto pessoa com os dados somente de pessoa enviados pela requisição
         */
        $dataPessoa = new Pessoa();
        $dataPessoa->fill($request->input('pessoa'));
        $dataPessoa->save();

        /**
         * Cria objeto cliente com os dados somente de cliente enviados pela requisição
         * Associa a pessoa criada com o cliente (relacionamento) através de:
         *      $dataCliente->pessoa()->associate($dataPessoa);
         */
        $dataCliente = new Cliente();
        $dataCliente->fill($request->input('cliente'));
        $dataCliente->pessoa()->associate($dataPessoa);
        $dataCliente->save();

        return $this->createdResponse($dataCliente);
    }

    public function show($id)
    {
        $data = Cliente::with([
            'pessoa',
            'vendas'
        ])->findOrFail($id);

        return $this->showResponse($data);
    }

    public function update(Request $request, $id)
    {
        /**
         * Regras de validação.
         */
        $validation = [
            'pessoa.pes_nome' => 'required|string|max:80',  // Nome opcional, até 80 caracteres
            'pessoa.pes_fantasia' => 'nullable|string|max:80',  // Nome fantasia opcional, até 80 caracteres
            'pessoa.pes_fisica' => 'required|in:F,J',  // Opcional, apenas 'F' (Física) ou 'J' (Jurídica)
            'pessoa.pes_cpfcnpj' => 'nullable|string|max:20',  // CPF ou CNPJ opcional, até 20 caracteres
            'pessoa.pes_rgie' => 'nullable|string|max:20',  // RG ou IE opcional, até 20 caracteres
            'pessoa.pes_dtcadastro' => 'nullable|date',  // Data de cadastro opcional, deve ser uma data
            'pessoa.pes_endereco' => 'nullable|string|max:120',  // Endereço opcional, até 120 caracteres
            'pessoa.pes_numero' => 'nullable|string|max:10',  // Número opcional, até 10 caracteres
            'pessoa.pes_complemento' => 'nullable|string|max:30',  // Complemento opcional, até 30 caracteres
            'pessoa.pes_bairro' => 'nullable|string|max:50',  // Bairro opcional, até 50 caracteres
            'pessoa.pes_cidade' => 'nullable|string|max:80',  // Cidade opcional, até 80 caracteres
            'pessoa.pes_uf' => 'nullable|string|size:2',  // UF opcional, deve ter exatamente 2 caracteres
            'pessoa.pes_cep' => 'nullable|string|max:9',  // CEP opcional, até 9 caracteres
            'pessoa.pes_fone1' => 'nullable|string|max:15',  // Telefone 1 opcional, até 15 caracteres
            'pessoa.pes_fone2' => 'nullable|string|max:20',  // Telefone 2 opcional, até 20 caracteres
            'pessoa.pes_celular' => 'nullable|string|max:20',  // Celular opcional, até 20 caracteres
            'pessoa.pes_site' => 'nullable|url|max:200',  // Site opcional, deve ser uma URL válida, até 200 caracteres
            'pessoa.pes_email' => 'nullable|email|max:200',  // E-mail opcional, deve ser um e-mail válido, até 200 caracteres
            'pessoa.pes_ativo' => 'nullable|in:0,1',  // Ativo opcional, apenas '1' (Sim) ou '0' (Não)
            'cliente.cli_limitecred' => 'nullable|numeric|min:0|max:99999999.99',
        ];
        $validatedData = $request->validate($validation);

        /**
         * Busca a pessoa através da chave secundária de cliente, e atualiza os dados de pessoa
         */
        $dataCliente = Cliente::findOrFail($id);
        $pesCodigo = $dataCliente->pes_codigo;

        $dataPessoa = Pessoa::findOrFail($pesCodigo);
        $dataPessoa->update($request->input('pessoa'));
        $dataPessoa->save();

        $dataCliente = Cliente::findOrFail($id);
        $dataCliente->update($request->input('cliente'));

        return $this->showResponse($dataCliente);
    }

    public function destroy($id)
    {
        $dataCliente = Cliente::findOrFail($id);
        $dataPessoa = $dataCliente->pessoa;
        
        $dataCliente = Cliente::destroy($id);
        $dataPessoa->delete();

        return $this->deletedResponse($dataCliente);
    }
}
