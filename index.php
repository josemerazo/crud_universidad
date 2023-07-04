<?php
include_once('conexion.php');

include('header.php');

if(isset($_GET["tipo"])){

}
?>


<div class="container">
    <div class="row">
        <h1>Listado de estudiantes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Carrera</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "
                    SELECT 
                        est.id, est.cedula, est.nombre, est.apellido, est.correo, 
                        car.nombre as carrera
                    FROM estudiante est, carrera car
                    WHERE est.id_carrera = car.id
                    ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";

                        echo "<tr>";
                        echo "<td scope='row'>" . $row["cedula"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["apellido"] . "</td>";
                        echo "<td>" . $row["correo"] . "</td>";
                        echo "<td>" . $row["carrera"] . "</td>";
                        echo "<td>
                                    <a target='_blank' class='btn btn-success' href='form_estudiante.php?id=" . $row["id"] . "'>Editar</a>
                                    <button type='button' class='btn btn-danger' onclick='showModal(" . $row["id"] . ")'>Eliminar</button>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="index.php?tipo=E">
                <div class="modal-header">
                    <input type="hidden" id="idOculto" name="idOculto" />
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Atención</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-danger" value="Eliminar"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let showModal = (e) => {
        console.log("hola", e);
        const myModal = new bootstrap.Modal("#exampleModal");
        myModal.show();
        const idControl = document.getElementById("idOculto");
        idControl.value = e;
    }
</script>
<?php
include('footer.php');
?>