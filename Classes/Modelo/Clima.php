<?php

namespace Classes\Modelo;

date_default_timezone_set("America/Sao_Paulo");

class Clima {

    public $codCidade;
    public $cidade;
    public $temperatura;
    public $velocidadeVento;
    public $nascerDoSol; //está em formato timestamp
    public $porDoSol; //está em formato timestamp
    public $humidade;
    public $pressao;
    public $temperaturaMaxima;
    public $temperaturaMinima;
    public $sensacaoTermica;
    public $descricao;
    public $icone;

    //Converte de kelvin para celsius
    public function getTemperaturaCelsius(): float {
        return $this->temperatura - 273;
    }

    public function getTemperaturaCelsiusMaxima(): float {
        return $this->temperaturaMaxima - 273;
    }

    public function getTemperaturaCelsiusMinima(): float {
        return $this->temperaturaMinima - 273;
    }

    public function getTemperaturaCelsiusSensacaoTermica(): float {
        return $this->sensacaoTermica - 273;
    }

    //Convete de kelvin para fahrenheit
    public function getTemperaturaFahrenheit(): float {
        return ($this->temperatura - 273) * 1.8 + 32;
    }

    public function getTemperaturaFahrenheitMaxima(): float {
        return ($this->temperaturaMaxima - 273) * 1.8 + 32;
    }

    public function getTemperaturaFahrenheitMinima(): float {
        return ($this->temperaturaMinima - 273) * 1.8 + 32;
    }

    public function getTemperaturaFahrenheitSensacaoTermica(): float {
        return ($this->sensacaoTermica - 273) * 1.8 + 32;
    }

    //Converte timestamp para hora normal
    public function getNascerDoSol() {
        $timestamp = $this->nascerDoSol;
        return date('H:i', $timestamp);
    }

    public function getPorDoSol() {
        $timestamp = $this->porDoSol;
        return date('H:i', $timestamp);
    }

}

?>