<?php
    //Impostación de Cabeseras
    include 'class/Cors.php';
    //Impostacion de conexion
    include 'class/MySQL.php';
    //Instancias
    $conn = new MySQL();
    $response = array();
    $status = null;

    //Detecta si el metodo http es correcto
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //Resivo los datos en formato json y los combierto a un array.
        $body = json_decode(file_get_contents('php://input'), true);
        //Compuevo si el cliente me manda los datos en formato json y si el cuerpo no esta basio
        if (!empty($body)) {
            $sql = "INSERT INTO tasks(task, description, date_finish) VALUE(:task, :description, :date_finish);";
            $state = $conn->getConnection()->prepare($sql);

            $state->bindParam(':task', $body['task']);
            $state->bindParam(':description', $body['description']);
            $state->bindParam(':date_finish', $body['date_finish']);

            if ($state->execute()) {
                $status = 200;
                //Establesco la respuesta del servidor
                http_response_code($status);
                $response = array(
                    "status" => $status,
                    "message" => "The query is well!!!",
                    "response" => true,
                );
            } else {
                $status = 400;
                //Establesco la respuesta del servidor
                http_response_code($status);
                $response = array(
                "status" => $status,
                "message" => "The query is bad!!",
                "response" => false
            );
            }
        } else {
            //Establesco el status de la espuesta del servidor
            $status = 400;
            //Establesco la respuesta del servidor
            http_response_code($status);
            $response = array(
                "status" => $status,
                "message" => "The body is empty",
                "response" => false
            );
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
