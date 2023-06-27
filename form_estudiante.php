<?php
include_once("conexion.php");

include_once("funciones.php");

include('header.php');
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
$nombre = isset($estudiante["nombre"]) ? $estudiante["nombre"] : "";
$apellido = isset($estudiante["apellido"]) ? $estudiante["apellido"] : "";
?>

<form method="post" action="form_estudiante.php">
    <div class="container">
        <h2>Ingresos de Estudiante U</h2>
        <label for="cedula">Cedula</label>
        <input required id="cedula" class="form-control" name="cedula" /><br>

        <label for="nombre">Nombre</label>
        <input id="nombre" class="form-control" value="<?php echo $nombre; ?>" name="nombre" /><br>

        <label for="apellido">Apellido</label>
        <input id="apellido" class="form-control" name="apellido"  value="<?php echo $apellido; ?>"/><br>

        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" /><br>

        <label for="carrera">Carrera</label>
        <select id="carrera" name="carrera" class="form-control">
            <?php
            foreach ($carreras as $elemento) {
                echo "<option value='" . $elemento['id'] . "'>" . $elemento['nombre'] . "</option>";
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