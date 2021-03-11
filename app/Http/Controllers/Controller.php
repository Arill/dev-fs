<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Cria a tabela pedidos
    function CreateTablePedidos() {
        Schema::create('pedidos', function(Blueprint $table) {
            $table->id();
            //Usuário
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('email');
            //Endereço
            $table->string('cep');
            $table->string('logradouro');
            $table->string('complemento')->nullable();
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
        });
    }

    //Insere um novo pedido na tabela pedidos
    function InsertIntoPedidos($formData) {
        DB::table('pedidos')->insert([
            //Usuário
            'nome' => $formData['nome'],
            'sobrenome' => $formData['sobrenome'],
            'email' => $formData['email'],
            //Endereço
            'cep' => $formData['cep'],
            'logradouro' => $formData['logra'],
            'numero' => $formData['numero'],
            'complemento' => $formData['complemento'],
            'bairro' => $formData['bairro'],
            'cidade' => $formData['cidade'],
            'uf' => $formData['uf']
        ]);
    }

    public function PostPedido(Request $request)
    {
        //Cria a tabela pedidos se a mesma não existir
        if (!Schema::hasTable('pedidos'))
            $this->CreateTablePedidos();

        //Recupera informações do formulário
        $form = $request->all();
        $this->InsertIntoPedidos($form);
        //Retorna à página de pedido concluído
        return view('pedidoCompleto');
    }

    public function CreateTableSimpleSelect() {
        //Cria uma tabela símples para apresentar os resultados da query select na tabela pedidos
        $table = "";
        $query = DB::table('pedidos')->select()->get();
        //Header da tabela
        $table .= "<thead><tr>";
        $table .= "<th scope=\"col\">Nome</th>";
        $table .= "<th scope=\"col\">Sobrenome</th>";
        $table .= "<th scope=\"col\">Email</th>";
        $table .= "<th scope=\"col\">CEP</th>";
        $table .= "<th scope=\"col\">Logradouro</th>";
        $table .= "<th scope=\"col\">Complemento</th>";
        $table .= "<th scope=\"col\">Numero</th>";
        $table .= "<th scope=\"col\">Cidade</th>";
        $table .= "<th scope=\"col\">UF</th>";
        $table .= "</tr></thead><tbody>";
        //Adicionar as linhas
        for ($i = 0; $i < count($query); $i++)
        {
            $table .= "<tr>";
            $table .= "<td>" . $query[$i]->nome . "</td>";
            $table .= "<td>" . $query[$i]->sobrenome . "</td>";
            $table .= "<td>" . $query[$i]->email . "</td>";
            $table .= "<td>" . $query[$i]->cep . "</td>";
            $table .= "<td>" . $query[$i]->logradouro . "</td>";
            $table .= "<td>" . $query[$i]->complemento . "</td>";
            $table .= "<td>" . $query[$i]->numero . "</td>";
            $table .= "<td>" . $query[$i]->cidade . "</td>";
            $table .= "<td>" . $query[$i]->uf . "</td>";
            $table .= "</tr>";
        }
        $table .= "</tbody>";
        return $table;
    }
}
