<link rel="stylesheet" href="/assets/css/verInscripciones.css">
<div class="datos">
    <h2>Filtros</h2>
    <form action="/verInscripcionesGimnasio" method="get" class="filtros">
        <div>
            <label for="">Nombre usuario</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($_GET['nombre']) && !empty($_GET['nombre']) ? $_GET['nombre'] : "" ?>">
        </div>
        <div>
            <label for="">Correo usuario</label>
            <input type="text" name="correo" id="correo" value="<?php echo isset($_GET['correo']) && !empty($_GET['correo']) ? $_GET['correo'] : "" ?>">
        </div>
        <div>
            <label for="">Años usuario</label>
            <input type="number" name="años" id="años" value="<?php echo isset($_GET['años']) && !empty($_GET['años']) ? $_GET['años'] : "" ?>">
        </div>
        <div>
            <label for="">Dni usuario</label>
            <input type="text" name="dni" id="dni" value="<?php echo isset($_GET['dni']) && !empty($_GET['dni']) ? $_GET['dni'] : "" ?>">
        </div>
        <div>
            <label for="">Fecha final</label>
            <input type="datetime-local" name="fechaMax" id="fechaMax" value="<?php echo isset($_GET['fechaMax']) && !empty($_GET['fechaMax']) ? $_GET['fechaMax'] : "" ?>">
        </div>
        <div>
            <label for="">Fecha incial</label>
            <input type="datetime-local" name="fechaMin" id="fechaMin" value="<?php echo isset($_GET['fechaMin']) && !empty($_GET['fechaMin']) ? $_GET['fechaMin'] : "" ?>">
        </div>

        <div class="order">
            <div>
                <label for="fecha_desc">Fecha desc</label>
                <input type="radio" id="fecha_desc" name="order" value="fecha_desc" <?php echo isset($_GET['order']) && ($_GET['order']) == "fecha_desc" ? "checked" : "" ?> <?php echo !isset($_GET['order']) || (isset($_GET['order']) && empty($_GET['order'])) ? "checked" : "" ?>>
            </div>
            <div>
                <label for="fecha_asc">Fecha asc</label>
                <input type="radio" id="fecha_asc" name="order" value="fecha_asc" <?php echo isset($_GET['order']) && ($_GET['order']) == "fecha_asc" ? "checked" : "" ?>>
            </div>
        </div>
        <a href="/verInscripcionesGimnasio" class="reiniciar">Reiniciar filtros</a>
        <input type="submit" value="Filtrar">
    </form>
</div>
<div class="resultados">
    <div class="paginas">
        <h3>Página <?php echo $paginaActual ?> de <?php echo $nPaginas ?></h3>
    </div>
    <div class="contenedorTabla">
        <table>
            <tr>
                <th>
                    Nombre reserva
                </th>
                <th>
                    Correo reserva
                </th>
                <th>
                    Fecha reserva
                </th>
                <th>
                    Dni reserva
                </th>
                <th>
                    Años reserva
                </th>
                <th>
                    Numero cuenta
                </th>
            </tr>
            <?php
            foreach ($datos as $d) {
            ?>
                <tr>
                    <td><?php echo $d['nombreCompleto'] ?></td>
                    <td><?php echo $d['email'] ?></td>
                    <td><?php echo $d['fecha_inscripcion'] ?></td>
                    <td><?php echo $d['dni'] ?></td>
                    <td><?php echo $d['años'] ?></td>
                    <td><?php echo $d['ncuenta'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="paginacion">
        <label for="page">Página</label>
        <select name="page" id="page">
            <?php
            if ($nPaginas == 0) {
            ?>
                <option value="1">1</option>
                <?php
            } else {
                for ($i = 1; $i <= $nPaginas; $i++) {
                ?>
                    <option value="<?php echo $i ?>" <?php echo isset($_GET['page']) && $_GET['page'] == $i ? "selected" : "" ?>><?php echo $i ?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>
</div>
<script src="assets/js/cambiarPaginaGym"></script>