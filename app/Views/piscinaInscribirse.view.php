<link rel="stylesheet" href="assets/css/inscripcionesPaginas.css">

<div class="contenedor">
    <?php
    if ($inscripciones == 0) {
    ?>
        <div class="info">
            Disfruta de nuestra zona de spa y piscina libre despues de rellenar nuestro formulario de pre-inscripcion
        </div>
        <form action="inscribirsePiscina" method="post">
            <h1> Datos </h1>

            <fieldset>
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($input['nombre']) && !empty($input['nombre']) ? $input['nombre'] : "" ?>">
                <p class="error"><?php echo isset($errores['nombre']) ? $errores['nombre'] : "" ?> </p>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($input['email']) && !empty($input['email']) ? $input['email'] : "" ?>">
                <p class="error"><?php echo isset($errores['email']) ? $errores['email'] : "" ?> </p>

                <label for="dni">Dni:</label>
                <input type="text" id="dni" name="dni" value="<?php echo isset($input['dni']) && !empty($input['dni']) ? $input['dni'] : "" ?>">
                <p class="error"><?php echo isset($errores['dni']) ? $errores['dni'] : "" ?> </p>

                <label>Años:</label>
                <input type="number" id="años" name="años" value="<?php echo isset($input['años']) && !empty($input['años']) ? $input['años'] : "" ?>">
                <p class="error"><?php echo isset($errores['años']) ? $errores['años'] : "" ?> </p>

                <label>Numero Cuenta:</label>
                <input type="text" id="ncuenta" name="ncuenta" value="<?php echo isset($input['ncuenta']) && !empty($input['ncuenta']) ? $input['ncuenta'] : "" ?>">
                <p class="error"><?php echo isset($errores['ncuenta']) ? $errores['ncuenta'] : "" ?> </p>

            </fieldset>
            <button type="submit">Enviar</button>
        </form>
    <?php
    } else {
    ?>
        <div class="info">
            Para borrar la inscipcion tienes que confirmar tu dni darle al boton
        </div>
        <form action="borrarInscribirsePiscina" method="post">
            <h1> Datos </h1>

            <fieldset>
                <label for="dni">Dni:</label>
                <input type="text" id="dni" name="dni" value="<?php echo isset($input['dni']) && !empty($input['dni']) ? $input['dni'] : "" ?>">
                <p class="error"><?php echo isset($errores['dni']) ? $errores['dni'] : "" ?> </p>

            </fieldset>
            <button type="submit">Borrar inscripcion</button>
        </form>
    <?php
    }
    ?>