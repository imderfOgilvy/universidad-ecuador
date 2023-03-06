<div class="main-content h-100" id="evaluar-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>

    <?php if($intento > 0){ ?>
        <div class="ui centered grid h-5 mt-6 pb-2" id="titulo-principal">
            <?php if($tipo == 'modulo'){ ?>
                    <div class="twelve wide column mb-2 px-6 py-2 bg-mustard rounded modulo-header page-rating">
                        <h2 class="font-size-16">EVALUACIÓN MÓDULO <?= $modulo ?></h2>
                    </div>
                <?php } ?>
                <?php if($tipo == 'puntos_extra'){ ?>
                    <div class="twelve wide column mb-2 px-6 py-2 bg-red rounded modulo-header page-rating">
                        <h2 class="font-size-16">PUNTOS EXTRA - MÓDULO <?= $modulo ?></h2>
                    </div>
                <?php } ?>
        </div>
        <div class="ui centered grid h-20 padded">
            <div class="sixteen wide column pt-5 pb-3 pt-1">
                <h3><center>Tienes <?= $intento ?> intento<?= ($intento > 1 ? "s" : "") ?></center></h3>
            </div>
        </div>
        <div class="ui centered grid h-5 pb-6">
            <a href="<?= $site['base_url'] ?>/quiz/?state=ready&modulo=<?= $modulo ?>&tipo=<?= $tipo ?>" class="btn btn-transparent btn-big py-1 px-4 color-white rounded">Iniciar evaluación</a>
        </div>
    <?php }else{ ?>
        <div class="ui centered grid h-40 padded">
            <div class="sixteen wide column pt-5 pb-3 pt-1">
                <h3>Lo sentimos, has gastado todos tus intentos para esta evaluación.</h3>
            </div>
        </div>
        <div class="ui centered grid h-5 pb-12">
            <a href="<?= $site['base_url'] ?>/modulo/?id=<?= $modulo ?>" class="btn btn-transparent btn-big py-1 px-4 color-white rounded">Regresar al módulo</a>
        </div>
    <?php } ?>
</div>