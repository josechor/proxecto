<link rel="stylesheet" href="assets/css/tarifas.css">
<section class="hero-section">
    <div class="card-grid">
        <?php
        $cont = 1;
        foreach ($tarifas as $t) {
        ?>
            <a class="cardPersonalizada " href="#">
                <div class="card__background" style="background-image: url(assets/img/<?php echo $t['nombre'] ?>.jpg)"></div>
                <div class="card__content">
                    <?php $nombre = ucfirst($t['nombre']); ?>
                    <h3 class="card__heading"><?php echo $nombre ?></h3>
                    <?php
                    if ($nombre == "Tenis" || $nombre == "Padel") {
                    ?>
                        <p class="card_description">Desde solo <?php echo $t['precio'] ?>€ a la hora</p>
                    <?php
                    } else {
                    ?>
                        <p class="card_description">Desde solo <?php echo $t['precio'] ?>€ al mes</p>
                    <?php
                    }
                    ?>
                    <p class="card_info <?php echo "carta" . $cont ?>">Para ver mas haz click</p>
                </div>
            </a>
        <?php
            $cont++;
        }
        ?>
    </div>
</section>