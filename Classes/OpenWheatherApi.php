<?php

require 'vendor/autoload.php';
require 'Modelo/Clima.php';
require 'acessos.php';

use GuzzleHttp\Client;
use Classes\Modelo\Clima;

class OpenWheatherApi {

    private $url;
    private $id;
    private $appid;

    public function __construct() {
        //Inicializa as variáveis globais
        $this->url = "http://api.openweathermap.org/data/2.5/weather";
        $this->id = "3468879";
        $this->appid = "3af5f0dc0b125a773f61ff688a6c14e1";
    }

    /**
     * Vai no site openweathermap.org e captura informações de clima
     */
    private function getDataWheather(): object {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);

        $urlCompleta = $this->url . "?id=" . $this->id . "&appid=" . $this->appid;

        $request = $client->request('GET', $urlCompleta);

        $clima = $request->getBody();

        //Converter para objeto
        $objClima = json_decode($clima);

        //objeto serializado, transfomado em um string, para gravação no disco
        $objSerializado = serialize($objClima);

        $caminhoArquivo = "./cache/clima.txt";

        //comando para gravaçãdo arquivo serilializado para o disco
        file_put_contents($caminhoArquivo, $objSerializado);

        return $objClima;
    }

    public function getClima(): Clima {
        $acesso = new acesso();
        $acesso->newAcesso();
        //$objGenerico = $this->getDataWheather();
        //Recuperando os dados de atualização
        $conteudoAtualização = file_get_contents("./cache/controle_cache.txt");

        //transforma a string em array
        $arrayAtualização = explode("#", $conteudoAtualização);

        $dataAtualização = $arrayAtualização[0];

        $dataAtual = time();

        if ($dataAtual - $dataAtualização >= 300) {
            //atualiza o cache 
            $objGenerico = $this->getDataWheather();
            $arrayAtualização [0] = time();
            $dadosArquivo = $arrayAtualização[0] . "#" . $arrayAtualização[1];
            file_put_contents("./cache/controle_cache.txt", $dadosArquivo);
        } else {
            // se não busca a partir do chace
            //os dados do disco
            $conteudoAtualização = file_get_contents("./cache/controle_cache.txt");

            //deserializa os dados
            $objGenerico = unserialize($conteudoArquivo);
        }

        //ler o arquivo no disco de desearilizar o arquivo e mandar para a tela
        $conteudoArquivo = file_get_contents("./cache/clima.txt");

        // deserialazando o arquivo, e agora está lendo o arqivo direto do disco do pc
        $objGenerico = unserialize($conteudoArquivo);

        $cli = new Clima();

        $cli->temperatura = $objGenerico->main->temp;
        $cli->temperaturaMaxima = $objGenerico->main->temp_max;
        $cli->temperaturaMinima = $objGenerico->main->temp_min;
        $cli->codCidade = $objGenerico->id;
        $cli->cidade = $objGenerico->name;
        $cli->velocidadeVento = $objGenerico->wind->speed;
        $cli->nascerDoSol = $objGenerico->sys->sunrise;
        $cli->porDoSol = $objGenerico->sys->sunset;
        $cli->humidade = $objGenerico->main->humidity;
        $cli->pressao = $objGenerico->main->pressure;
        $cli->sensacaoTermica = $objGenerico->main->feels_like;
        $cli->descricao = $objGenerico->weather[0]->description;
        $cli->icone = $objGenerico->weather[0]->icon;
        $cli->acessos = $acesso->getAcessos();

        return $cli;
    }

}

?>