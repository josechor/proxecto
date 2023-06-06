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
            <label for="fecha_desc">Fecha desc</label>
            <input type="radio" id="fecha_desc" name="order" value="fecha_desc" <?php echo isset($_GET['order']) && ($_GET['order']) == "fecha_desc" ? "checked": ""?> <?php echo !isset($_GET['order']) || (isset($_GET['order']) && empty($_GET['order'])) ? "checked": ""?>>
            <label for="fecha_asc">Fecha asc</label>
            <input type="radio" id="fecha_asc" name="order" value="fecha_asc" <?php echo isset($_GET['order']) && ($_GET['order']) == "fecha_asc" ? "checked": ""?>>
        </div>
        <input type="submit" value="Filtrar">
    </form>
</div>
<div class="resultados">
    <div class="paginas">

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

    </div>
</div>