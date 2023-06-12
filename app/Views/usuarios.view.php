<link rel="stylesheet" href="/assets/css/verReservas.css">
<div class="datos">
    <h2>Filtros</h2>
    <form action="/verUsuarios" method="get" class="filtros">
        <div>
            <label for="">Nombre usuario</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($_GET['nombre']) && !empty($_GET['nombre']) ? $_GET['nombre'] : "" ?>">
        </div>
        <div>
            <label for="">Correo usuario</label>
            <input type="text" name="correo" id="correo" value="<?php echo isset($_GET['correo']) && !empty($_GET['correo']) ? $_GET['correo'] : "" ?>">
        </div>
        <div class="order">
            <div>
                <label for="desc">Nombre desc</label>
                <input type="radio" id="desc" name="order" value="desc" <?php echo isset($_GET['order']) && ($_GET['order']) == "desc" ? "checked" : "" ?> <?php echo !isset($_GET['order']) || (isset($_GET['order']) && empty($_GET['order'])) ? "checked" : "" ?>>
            </div>
            <div>
                <label for="adc">Nombre asc</label>
                <input type="radio" id="asc" name="order" value="asc" <?php echo isset($_GET['order']) && ($_GET['order']) == "asc" ? "checked" : "" ?>>
            </div>
        </div>
        <a href="/verUsuarios" class="reiniciar">Reiniciar filtros</a>
        <input type="submit" value="Filtrar">
    </form>
</div>
<?php 
if(isset($mensaje) && !empty($mensaje)){
    ?>
    <div class="mensaje">
        <?php echo $mensaje?>
    </div>
    <?php
}
?> 
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
                    Cambio rol
                </th>
                <th>
                    Eliminar
                </th>
            </tr>
            <?php
            foreach ($datos as $d) {
            ?>
                <tr>
                    <td><?php echo $d['nombre'] ?></td>
                    <td><?php echo $d['correo'] ?></td>
                    <td><a href="cambiarRol?rol=<?php echo $d['rol'] == 1 ? "2" : "1" ?>&id=<?php echo $d['id']?>"><?php echo $d['rol'] == 1 ? "Hacer user normal" : "Hacer admin" ?></a></td>
                    <td><a href="borrarUser?id=<?php echo $d['id']?>"><i class="fas fa-trash" style="color: #f90606;"></a></i></td>
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
<script src="assets/js/cambiarPaginaUsuarios"></script>