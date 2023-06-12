<link rel="stylesheet" href="assets/css/tarifas.css">
<section class="hero-section">
    <div class="card-grid">
        <?php
        $cont = 1;
        foreach ($tarifas as $t) {
        ?>
            <a class="cardPersonalizada">
                <div class="card__background" style="background-image: url(assets/img/<?php echo $t['nombre'] ?>.jpg)"></div>
                <div class="card__content">
                    <?php $nombre = ucfirst($t['nombre']); ?>
                    <?php if ($nombre == "Padel/tenis") {
                        $partes = explode("/", $nombre);
                        $partes[1] = ucfirst($partes[1]);
                    }
                    if ($nombre == "Padel/tenis") {
                    ?>
                        <h3 class="card__heading"><?php echo $partes[0] ?><br><?php echo $partes[1] ?></h3>
                    <?php
                    } else {
                    ?>
                        <h3 class="card__heading"><?php echo $nombre == "Pareja" ? "Bono premium" : $nombre ?><br></h3>
                    <?php
                    }
                    ?>


                    <?php
                    if ($nombre == "Tenis" || $nombre == "Padel") {
                    ?>
                        <p class="card_description">Desde solo <?php echo $t['precio'] ?>€ a la hora</p>
                    <?php
                    } else if ($nombre == "Pareja") {
                    ?>
                        <p class="card_description">Tu y un compañero desde solo <?php echo $t['precio'] ?>€ al mes</p>
                    <?php
                    } else {
                    ?>
                        <p class="card_description">Desde solo <?php echo $t['precio'] ?>€ al mes</p>
                    <?php
                    }
                    ?>
                    <?php
                    if ($nombre == "Gimnasio") {
                    ?>
                        <p class="card_info <?php echo "carta" . $cont ?>">Para más informacion de actividades y horarios contacta con nosotros</p>
                    <?php
                    }else if($nombre == "Pareja"){
                        ?>
                        <p class="card_info <?php echo "carta" . $cont ?>">Para más informacion contacta con nosotros</p>
                        <?php
                    } else {
                    ?>
                        <p class="card_info <?php echo "carta" . $cont ?>">Para más informacion de horarios y cursos contacta con nosotros</p>
                    <?php
                    }
                    ?>

                </div>
            </a>
        <?php
            $cont++;
        }
        ?>
    </div>
</section>