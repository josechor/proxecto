<link rel="stylesheet" href="assets/css/reservaPistaPadel.css">
<div class="opciones">
<div>
    <label for="selecDia">DIA</label>
    <select name="selecDia" id="selecDia">
        <option value=""><?php echo date('Y-m-d') ?></option>
        <option value=""><?php echo date('Y-m-d', strtotime('1 day', strtotime(date('Y-m-d')))) ?></option>
        <option value=""><?php echo date('Y-m-d', strtotime('2 day', strtotime(date('Y-m-d')))) ?></option>
    </select>
</div>
</div>
<div class="contenedorTabla">
    <table>
        <tr>
            <th>Hora</th>
            <th>Jugaores permitidos</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        <?php
        $fechaActual = date('Y-m-d');
        $fechaActual = date('Y-m-d H:i:s', strtotime('+8 hour', strtotime($fechaActual)));
        for ($i = 0; $i < 12; $i++) {
            $nuevaFecha = strtotime('+1 hour', strtotime($fechaActual));
            $fechaActual = date('H:i:s', $nuevaFecha);
        ?>
            <tr>
                <td><?php echo $fechaActual ?></td>
                <td>4</td>
                <td><?php echo date('Y-m-d H:i:s')>= $fechaActual ? 'Fuera de hora' : 'Disponible' ?></td>
                <td><?php echo date('Y-m-d H:i:s')>= $fechaActual ? '' : '<a class="botonReserva">Reservar</a>' ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>