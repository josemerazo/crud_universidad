<?php
include_once("conexion.php");

include_once("funciones.php");

$carreras = lista_carreras($servername, $username, $password, $dbname);


if (isset($_POST["grabar"])) {
    crear_estudiante(
        $servername,
        $username,
        $password,
        $dbname,
        $_POST["cedula"],
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["correo"],
        $_POST["carrera"]
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Ingresos de Estudiante U</h2>
    <form method="post" action="form_estudiante.php">
        <label for="cedula">Cedula</label> <input required id="cedula" name="cedula" /><br>
        <label for="nombre">Nombre</label> <input id="nombre" name="nombre" /><br>
        <label for="apellido">Apellido</label> <input id="apellido" name="apellido" /><br>


        <label for="correo">Correo</label> <input type="email" id="correo" name="correo" /><br>

        <label for="carrera">Carrera</label>
        <select id="carrera" name="carrera">
            <?php
            foreach ($carreras as $elemento) {
                echo "<option value='" . $elemento['id'] . "'>" . $elemento['nombre'] . "</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Grabar" name="grabar"></input>
    </form>
</body>

</html>