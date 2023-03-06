<div class="main-content h-100" id="cerointentos-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>

    <!-- QUIZ -->
    <div class="ui centered grid h-60 d-flex justify-content-center align-items-center my-0" id="timeout-screen">
        <div class="twelve wide column p-0 modulo-header page-rating">
            <h1 class="text-center m-0">¡Lo sentimos!</h1>
            <h3 class="text-center m-0">Ya no te queda ningún intento para resolver esta Evaluación.</h3>
        </div>
    </div>

    
    <div class="ui centered grid h-5 pb-12">
        <a href="<?= $site['base_url'] ?>/modulo/?id=<?= $modulo ?>" class="btn btn-mustard btn-big mt-2 py-1 px-5 color-white rounded">Regresar al módulo</a>
    </div>
    

    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/puntaje/" class="">Mi puntaje</a>
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/perfil/" class="">Mi perfil</a>
        </div>
    </div>

</div>