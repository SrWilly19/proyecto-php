<?php

const API_URL = "https://dev.whenisthenextmcufilm.com/api";
#Inicializamos una nueva sesión de cURL es necesario para hacer solicitudes HTTP; ch = cURL handle
$ch = curl_init(API_URL);
// Indicasr que queremos recibir el resultado de la peticion y no mostrarla en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
/* Ejecutar la peticion
    y guardamos el resultado
*/
$result = curl_exec($ch);

// Una alternatica seria utilizar file_get_contents
// Es una forma de llamar a la API, hacer un GET y quedarte con el json
// $result = file_get_contents(API_URL); // si solo quieres hacer un GET de una API

$data = json_decode($result, true);

#Cerramos la conexion de curl
curl_close($ch);

?>


<head>
    <meta charset="UTF-8" />
    <title>La próxima pelicula de Marvel</title>
    <meta name="description" content="La próxima pelicula de Marvel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>

<main>
    <h1><?= $data["title"]; ?>.</h1>
    <section>    
        <img src="<?= $data["poster_url"]; ?>"  width="300" alt="Poster de <?= $data["title"]?>"  style="border-radius: 16px;"/>
    </section>

    <hgroup>
        <h3>Solo quedan <?= $data["days_until"];?> dias.</h3>
        <p>Fecha de estreno: <?= $data["release_date"];?>
        <p>Proxima pelicula: <?= $data["following_production"]["title"];?>
    </hgroup>
</main>



<style>
    :root {
        color-scheme: light dark;
    }

    body {
        display: grid;
        place-content: center;
    }
    section{
        display: block;
        justify-content: center;
    }
    img{
        margin: 0;
        margin-left: 50px;
    }
    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
</style>