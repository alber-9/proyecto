<ul class="nav nav-tabs mb-5" id="myTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="panel boton active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="profile" aria-selected="true">Notas</button>
    </li>
    <li class="nav-item " role="presentation">
        <button class="panel boton" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="false">Riego</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel">
        <div class="dropdown color">
            <?php
            
                
                $sql = "SELECT IDNota, NombreUsuario, ContenidoNota, Leida FROM Notas  WHERE Leida != 0 ";
                $result = $conn->query($sql);
            ?>
            <h2>Notas</h2>
            <table id="notasTabla" class="table">
                <thead>
                    <tr>
                        <th scope="col">Contenido de la Nota</th>
                        <th scope="col">Leída</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class=".$row["NombreUsuario"].">";
                            echo "<td scope='row'>" . $row["ContenidoNota"] . "</td>";
                            echo "<td><input type='checkbox' class='boolean-checkbox' data-tabla='Notas' data-campo='Leida' data-clave='" . json_encode(['IDNota' => $row["IDNota"]]) . "' " . ($row["Leida"] ? "checked" : "") . "></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No hay notas disponibles</td></tr>";
                    }
                ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-8">
                    <nav id="notasTablaPage" aria-label="Page navigation example"></nav>
                </div>
                <div class="col-4">
                    <a class="btn btn-primary miParrafo" href="/paginas/nota/nota-insertar.php">Añadir</a>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="dropdown color">
            <?php
                $fecha_actual = date("Y-m-d");
                $sql = "SELECT Parcela, Abono, Cantidad, Riego, Hecho, Fecha FROM Abonado WHERE Fecha = '$fecha_actual';";
                $result = $conn->query($sql);
            ?>
            <h2>Riego</h2>
            <table id="riegoTabla" class="table">
                <thead>
                    <tr>
                        <th scope="col">Parcela</th>
                        <th scope="col">Hecho</th>
                        <th scope="col">Info</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["Fecha"] . "*" . $row["Parcela"];
                            echo "<tr>";
                            echo "<td scope='row'>" . $row["Parcela"] . "</td>";
                            echo "<td><input type='checkbox' class='boolean-checkbox' data-tabla='Abonado' data-campo='Hecho' data-clave='" . json_encode(['Parcela' => $row["Parcela"], 'Fecha' => $row["Fecha"]]) . "' " . ($row["Hecho"] ? "checked" : "") . "></td>";
                            echo "<td scope='row'>
                                <button id='$id' data-parcela='" . $row["Parcela"] . "' data-abono='" . $row["Abono"] . "' data-cantidad='" . $row["Cantidad"] . "' data-riego='" . $row["Riego"] . "' type='button' class='mt-2 me-2 btn btn-outline-info' onclick='abrirModal(this.id)'>INFO</button>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay datos disponibles</td></tr>";
                    }
                ?>
                </tbody>
            </table>
            <nav id="riegoTablaPage" aria-label="Page navigation example"></nav>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let checkboxes = document.querySelectorAll('.boolean-checkbox');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let tabla = this.getAttribute('data-tabla');
                let campo = this.getAttribute('data-campo');
                let clave = this.getAttribute('data-clave');
                let valor = this.checked;

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "/herramientas/update_hecho.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        if (xhr.responseText === "success") {
                            window.location.reload();
                        } else {
                            alert("Error actualizando la base de datos");
                            checkbox.checked = !valor; // Revertir el cambio si hay un error
                        }
                    }
                };

                xhr.send("tabla=" + tabla + "&campo=" + campo + "&clave=" + encodeURIComponent(clave) + "&valor=" + valor);
                
            });
        });
    });
</script>
