<link rel="stylesheet" href="/assets/css/verReservas.css">
<div class="datos">
    <h2>Filtros</h2>
    <form action="/verReservasPadel" method="get" class="filtros">
        <div>
            <label for="">Nombre usuario</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($_GET['nombre']) && !empty($_GET['nombre']) ? $_GET['nombre'] : "" ?>">
        </div>
        <div>
            <label for="">Correo usuario</label>
            <input type="text" name="correo" id="correo" value="<?php echo isset($_GET['correo']) && !empty($_GET['correo']) ? $_GET['correo'] : "" ?>">
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
                    Nombre usuario
                </th>
                <th>
                    Correo usuario
                </th>
                <th>
                    Fecha reserva
                </th>
            </tr>
            <?php
            foreach ($datos as $d) {
            ?>
                <tr>
                    <td><?php echo $d['nombre'] ?></td>
                    <td><?php echo $d['correo'] ?></td>
                    <td><?php echo $d['fecha_reserva'] ?></td>
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
<script src="assets/js/cambiarPaginaTenis"></script>