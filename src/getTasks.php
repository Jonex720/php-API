<?php
    //Importacion de cabeseras
    require('class/Cors.php');
    //Importacion de la conexion a la base de datos
    require('class/MySQL.php');
    //Intasncias
    $conn = new MySQL();
    $response = array();
    $status = null;

    //Ejecucion de la peticion GET
    if ($_SERVER['REQUEST_METHOD'] === "GET") {

        $sql = "SELECT * FROM tasks";
        $state = $conn->getConnection()->prepare($sql);

        if (!$state->execute()) {
            $status = 400;

            http_response_code($status);
            $response = array(
                "status" => $status,
                "response" => false,
                "message" => "The query is bad!!!",
            );
        } else {
            $json = array();
            while ($row = $state->fetch(PDO::FETCH_ASSOC)) {
                $json[] = array(
                    "idTask" => $row['idTask'],
                    "task" => $row['task'],
                    "description" => $row['description'],
                    "done" => $row['done'],
                    "date_finish" => $row['date_finish']
                );
            }

            $response = array(
                "response" => true,
                "message" => "The query is well",
                "body" => $json
            );
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