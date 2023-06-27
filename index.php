<?php
include_once('conexion.php');

include('header.php');
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
                            echo "<td><a target='_blank' class='btn btn-success' href='form_estudiante.php?id=" . $row["id"] . "'>Editar</td></a>";
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

<?php
    include('footer.php');
?>