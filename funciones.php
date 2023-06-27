<?php
function lista_carreras($servername, $username, $password, $dbname)
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, nombre FROM carrera";
    $result = $conn->query($sql);
    $carreras = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($carreras, [
                "id" => $row["id"],
                "nombre" => $row["nombre"]
            ]);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $carreras;
}
function crear_estudiante(
    $servername,
    $username,
    $password,
    $dbname,
    $cedula,
    $nombre,
    $apellido,
    $correo,
    $id_carrera = 1
) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO estudiante (cedula,nombre, apellido, correo, id_carrera)
VALUES (" . $cedula . ", '" . $nombre . "', '"
        . $apellido . "','" . $correo . "'," . $id_carrera . ")";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
function obtiene_estudiante($servername, $username, $password, $dbname, $id)
{
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, cedula, nombre, apellido, correo, id_carrera FROM estudiante WHERE id = " . $id;
    $result = $conn->query($sql);
    $estudiante = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $estudiante = [
                "id" => $row["id"],
                "cedula" => $row["cedula"],
                "nombre" => $row["nombre"],
                "apellido" => $row["apellido"],
                "correo" => $row["correo"],
                "id_carrera" => $row["id_carrera"],
            ];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $estudiante;
}
