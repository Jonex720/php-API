<?php
    //Impostación de Cabeseras
    include 'class/Cors.php';
    //Impostacion de conexion
    include 'class/MySQL.php';
    //Instancias
    $conn = new MySQL();
    $response = array();
    $status = null;

    if($_SERVER['REQUEST_METHOD'] === "PUT") {
        $body = json_decode(file_get_contents('php://input'), true);

        if(!empty($body)) {
            
        }
    } else {
        $status = 400;

        http_response_code($status);
        $response = array(
            "status" => $status,
            "response" => false,
            "message" => "HTTP Method is invalid!"
        );
    }

    $jsonString = json_encode($response);
    echo $jsonString;