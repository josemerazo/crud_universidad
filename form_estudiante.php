<?php
include_once("conexion.php");

include_once("funciones.php");

include('header.php');
$carreras = lista_carreras($servername, $username, $password, $dbname);


if (isset($_POST["grabar"])) {

    if (isset($_GET["id"])) {
        //actualizar
        actualizar_estudiante(
            $servername,
            $username,
            $password,
            $dbname,
            $_GET["id"],
            $_POST["cedula"],
            $_POST["nombre"],
            $_POST["apellido"],
            $_POST["correo"],
            $_POST["carrera"]
        );
    } else {
        //insertar nuevo registro
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
}
$estudiante = [];
if (isset($_GET["id"])) {
    $estudiante = obtiene_estudiante(
        $servername,
        $username,
        $password,
        $dbname,
        $_GET["id"]
    );
}

$cedula = isset($estudiante["cedula"]) ? $estudiante["cedula"] : "";
$nombre = isset($estudiante["nombre"]) ? $estudiante["nombre"] : "";
$apellido = isset($estudiante["apellido"]) ? $estudiante["apellido"] : "";
$correo = isset($estudiante["correo"]) ? $estudiante["correo"] : "";

$id_carrera = isset($estudiante["id_carrera"]) ? $estudiante["id_carrera"] : "";
?>

<form method="post" action="form_estudiante.php<?php echo isset($_GET["id"]) ? "?id=" . $_GET["id"] : "" ?>">
    <div class="container">
        <h2>Ingresos de Estudiante U</h2>
        <label for="cedula">Cedula</label>
        <input required id="cedula" class="form-control" name="cedula" value="<?php echo $cedula; ?>" /><br>

        <label for="nombre">Nombre</label>
        <input id="nombre" class="form-control" value="<?php echo $nombre; ?>" name="nombre" /><br>

        <label for="apellido">Apellido</label>
        <input id="apellido" class="form-control" name="apellido" value="<?php echo $apellido; ?>" /><br>

        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>" /><br>

        <label for="carrera">Carrera</label>
        <select id="carrera" name="carrera" class="form-control">
            <?php
            foreach ($carreras as $elemento) {
                echo "<option value='" . $elemento['id'] . "' " .
                    ($elemento['id'] == $id_carrera ? "selected='true'" : "") . ">" . $elemento['nombre'] . "</option>";
            }

            ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Grabar" class="btn btn-success" name="grabar"></input>
    </div>
</form>
<?php
include('footer.php');
?>