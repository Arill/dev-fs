<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cep', function () {
    return view('cep');
});

Route::get('/pedidos', function () {
    return view('pedidos');
});

Route::get('/retrieveCEP/{cep}', function($cep) {
    $cURL = curl_init(); //Inicializa a sessão
    curl_setopt_array($cURL, array(
        CURLOPT_URL => "https://viacep.com.br/ws/" . $cep . "/json", //URL de requisição + CEP
        CURLOPT_TIMEOUT => 30, //30s timeout
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_NONE,
        CURLOPT_RETURNTRANSFER => true, //Retorna o resultado em curl_exec()
        CURLOPT_SSL_VERIFYPEER => true)); //Usar certificado SSL
    $DadosCEP = curl_exec($cURL);
    $Erro = curl_error($cURL);
    curl_close($cURL); //Fecha a sessão
    
    if ($Erro != "") { //Fallback para a API POSTMON
        $cURL = curl_init(); //Inicializa a sessão
        curl_setopt_array($cURL, array(
            CURLOPT_URL => "https://api.postmon.com.br/v1/cep/" . $cep, //URL de requisição + CEP
            CURLOPT_TIMEOUT => 30, //30s timeout
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_NONE,
            CURLOPT_RETURNTRANSFER => true, //Retorna o resultado em curl_exec()
            CURLOPT_SSL_VERIFYPEER => true)); //Usar certificado SSL
        $DadosCEP = curl_exec($cURL);
        $Erro = curl_error($cURL);
        curl_close($cURL); //Fecha a sessão
        
        //Compatibilizar a resposta JSON com a API ViaCEP
        $DadosCEP = json_decode($DadosCEP, true);
        $DadosCEP["localidade"] = $DadosCEP["cidade"];
        $DadosCEP["uf"] = $DadosCEP["estado"];
        unset($DadosCEP["cidade"]);
        unset($DadosCEP["estado"]);
        $DadosCEP = json_encode($DadosCEP);
        
        //Retorna a string JSON
        return $DadosCEP;
    }

    //Retorna a string JSON
    return $DadosCEP;
});

Route::get('/tabelaPedidos', 'App\Http\Controllers\Controller@CreateTableSimpleSelect');

Route::post('/submitPedido', 'App\Http\Controllers\Controller@PostPedido');