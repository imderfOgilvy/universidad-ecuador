<div class="main-content h-100" id="evaluar-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>

    <!-- BIENVENIDA Y VIDEO -->
    <?php if( !$app->isRated($usuario, $modulo) ){ ?>
        <div class="ui centered grid h-30 mt-6 pb-4">
            <div class="twelve wide column mb-6 px-6 py-2 bg-mustard rounded modulo-header page-rating">
                <h2 class="font-size-17">Tu opinión nos importa</h2>
            </div>

            <div class="twelve wide column bg-white px-6 pt-4 pb-4 modulo-rating">
                <h3>¿Te gustó el contenido de la capacitación?</h3>
                <div class="ui massive star rating" id="ratingA"></div>

                <h3>¿Qué tal te pareció la duración de la capacitación?</h3>
                <div class="ui massive star rating" id="ratingB"></div>

                <h3>¿El entrenador conoce y domina los temas de ventas?</h3>
                <div class="ui massive star rating" id="ratingC"></div>
            </div>
        </div>
        
        <div class="ui centered grid h-5 pb-12">
            <form method="POST" id="form-evaluar">
            <input type="hidden" name="modulo" value="<?= $modulo ?>" />
            <input type="hidden" name="rating" value="true" />
            <input type="hidden" name="ratingA" value="0" />
            <input type="hidden" name="ratingB" value="0" />
            <input type="hidden" name="ratingC" value="0" />
            <a href="javascript:void(0)" class="btn btn-transparent btn-big mt-2 py-1 px-5 color-white rounded" id="btn-evaluar-modulo">Evaluar</a>
            </form>
        </div>
    <?php }else if( !isset($_REQUEST['rating']) &&  $app->isRated($usuario, $modulo) ){ ?>
        <div class="ui centered grid h-60 d-flex align-items-center justify-content-center pb-2">
            <div class="twelve wide column px-6 pt-4 pb-4">
                <h1 class="text-light text-center">Ya has calificado este módulo.</h1>
                <a href="<?= $site['base_url'] ?>/modulo/?id=<?= $modulo ?>" class="btn btn-transparent btn-big py-1 px-0 color-white rounded">Volver al módulo</a>
            </div>
        </div>
    <?php } ?>
    
    <?php if( isset($_REQUEST['rating']) ){  ?>
        <div class="ui centered grid h-60 d-flex align-items-center justify-content-center pb-2">
            <div class="twelve wide column px-6 pt-4 pb-4">
                <h1 class="text-light text-center">Gracias por calificar este módulo.</h1>
                <a href="<?= $site['base_url'] ?>/modulo/?id=<?= $modulo ?>" class="btn btn-transparent btn-big py-1 px-0 color-white rounded">Volver al módulo</a>
            </div>
        </div>
    <?php } ?>

    <div class="ui centered grid h-10 padded">
    </div>

    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/puntaje/" class="">Mi puntaje</a>
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/perfil/" class="">Mi perfil</a>
        </div>
    </div>

</div>
<script>
(function($){
    
    // INICIAR EVALUACION
    $( document ).ready(function(){
        $("#btn-evaluar-modulo").click(async function(){
            await jQuery("input[name='ratingA']").val(jQuery("#ratingA").rating("get rating"));
            await jQuery("input[name='ratingB']").val(jQuery("#ratingB").rating("get rating"));
            await jQuery("input[name='ratingC']").val(jQuery("#ratingC").rating("get rating"));
            jQuery("#form-evaluar").submit();
        });
    });
}(jQuery));
</script>