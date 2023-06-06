<link rel="stylesheet" href="assets/css/cambiarTarifasAdmin.css">
<div class="contenedorGeneral">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Nuevo Precio</th>
            <th>Cambiar</th>
        </tr>

        <?php
        foreach ($tarifas as $t) {
        ?>
        <form action="administrarTarifas" method="post">
            <tr>
                <td><?php echo $t['nombre']?></td>
                <td><?php echo $t['precio']?></td>
                <td><input type="number" name="precio" id="precio" value='<?php echo $t["precio"]?>'><input type="text" name="nombre" id="nombre" hidden value="<?php echo $t['nombre'] ?>"></td>
                <td><input type="submit" value="Cambiar"></td>
            </tr>
        </form>
        <?php
        }
        ?>

    </table>
</div>