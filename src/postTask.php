<?php
    //Impostación de Cabeseras
    require('class/Cors.php');
    //Impostacion de conexion
    require('class/MySQL.php');
    //Instancias
    $conn = new MySQL();
    $response = array();
    $status = null;

    //Detecta si el metodo http es correcto
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //Resivo los datos en formato json y los combierto a un array.
        echo json_decode(file_get_contents('php://input'), true);
        

        //Compuevo si el cliente me manda los datos en formato json y si el cuerpo no esta basio
        if (count($date) < 0) {

        } else {
            //Establesco el status de la espuesta del servidor
            $status = 400;
            //Establesco la respuesta del servidor
            http_response_code($status);
            $response = array(
                "status" => $status,
                "message" => "The http request is invalid",
                "response" => false
            );
            echo "Entro";
        }
    } else {
        //Establesco el status de la espuesta del servidor
        $status = 400;
        //Establesco la respuesta del servidor
        http_response_code($status);
        $response = array(
            "status" => $status,
            "message" => "The http request is invalid",
            "response" => false
        );
    }

    $jsonString = json_encode($response);
    echo $jsonString;
