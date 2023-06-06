<link rel="stylesheet" href="assets/css/reservaPistaPadel.css">
<?php
if (isset($mensaje) && $mensaje != "") {
?>
<h2><?php echo isset($mensaje) ? $mensaje : "" ?></h2>
<?php
}
?>
<div class="opciones">
    <div>
        <label for="selecDia">DIA</label>
        <select name="selecDia" class="selecDia">
            <option <?php echo ($_GET['fechaVer']) == $fechaActual ? "selected" : "" ?> value="<?php echo $fechaActual ?>"><?php echo $fechaActual ?></option>
            <option <?php echo ($_GET['fechaVer']) == date('d-m-Y', strtotime('1 day', strtotime($fechaActual))) ? "selected" : "" ?> value="<?php echo date('d-m-Y', strtotime('1 day', strtotime($fechaActual))) ?>"><?php echo date('d-m-Y', strtotime('1 day', strtotime($fechaActual))) ?></option>
            <option <?php echo ($_GET['fechaVer']) == date('d-m-Y', strtotime('2 day', strtotime($fechaActual))) ? "selected" : "" ?> value="<?php echo date('d-m-Y', strtotime('2 day', strtotime($fechaActual))) ?>"><?php echo date('d-m-Y', strtotime('2 day', strtotime($fechaActual))) ?></option>
        </select>
    </div>
</div>
<div class="contenedorTabla">
    <table>
        <tr>
            <th>Hora</th>
            <th>Jugadores permitidos</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        <?php

        foreach ($opciones as $op){

        ?>
            <tr class="<?php echo $op['color']?>">
                <td><?php echo $op['hora'] ?></td>
                <td><?php echo $op['jugadores'] ?></td>
                <td><?php echo $op['estado'] ?></td>
                <td> <?php echo $op['reservar'] == true ? '<form method="post" action="reservarPistaPadel"><input name="fecha" type="text" hidden value="' . $op['fechaCompleta'] . '"/><input type="submit" class="botonReserva" value="Reservar"/></form>' : "" ?> </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<script src="assets/js/cambiarDiaPadel.js"></script>
<!--  -->