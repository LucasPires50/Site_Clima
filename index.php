<?php
date_default_timezone_set('America/Sao_Paulo');
require './Classes/OpenWheatherApi.php';
$openWheater = new OpenWheatherApi();
$clima = $openWheater->getClima();
?>

<?php
//Como imprimir a temperatura
//echo $clima->temperatura; 
?>

<!-- Coloque seu HTML aqui -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tabuada</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Lincando o bootstrat a pagina-->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/container_back.css" rel="stylesheet" type="text/css">
        <link href="style/styleCss.css" rel="stylesheet" type="text/css"/>


    </head>
    <body class="corfundo">

        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                        <a class="navbar-brand" href="#"><h1>Previsão do tempo</h1></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
            </header>

            <div class="row mb-3">
                <div class="col-md-8 themed-grid-col">
                    <div class="pb-3 text-center">
                        <h1 class="cover-heading  ">Brusque,SC<img id="wicon" src="http://openweathermap.org/img/w/<?= $clima->icone ?>.png" alt="Weather icon"></h1>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-termômetro-maxima-48.png"><?php echo $clima->getTemperaturaCelsiusMaxima() . "ºC / " . $clima->getTemperaturaFahrenheitMaxima() . "ºF MAX" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-termômetro-minima-48.png"><?php echo $clima->getTemperaturaCelsiusMinima() . "ºC / " . $clima->getTemperaturaFahrenheitMinima() . "ºF MAX" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-vento-48.png"> <?php echo $clima->velocidadeVento . " Km/h" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-umidade-48.png"><?php echo $clima->humidade . "% UR" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-pressão-atmosférica-48.png"><?php echo $clima->pressao . " hPa" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-sensação-térmica-48.png"><?php echo $clima->getTemperaturaCelsiusSensacaoTermica() . "ºC / " . $clima->getTemperaturaFahrenheitSensacaoTermica() . "ºF Sensação Térmica" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-nascer-do-sol-48.png"><?php echo $clima->getNascerDoSol() . " Nascer do Sol" ?></div>
                        <div class="col-md-6 themed-grid-col "><img src="img/icons8-pôr-do-sol-48.png"><?php echo $clima->getPorDoSol() . " Pôr do Sol" ?></div>

                    </div>
                </div>
                <div class="col-md-4 themed-grid-col text-center grande "><?php echo $clima->getTemperaturaCelsius() . " ºC" . "<hr>" . $clima->getTemperaturaFahrenheit() . " ºF" ?></div>
            </div>
            <footer class="my-5 pt-5 text-muted text-center text-small">
                <hr>
                <p class="mb-1">© 2017-2020 Company Name</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Privacy</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">Support</a></li>
                    
                </ul>
                <ul class="list-inline">
                  <li a href="#">Contagem de acesso: <?php echo $clima->acessos ?></a></li>  
                </ul>
            </footer>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    </body>
</html>