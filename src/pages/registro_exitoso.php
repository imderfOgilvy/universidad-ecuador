<div class="main-content h-100" id="registro-page">
<div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>
    
    <!-- RESULTADO -->
    <div class="ui centered grid h-85 d-flex justify-content-center align-items-center my-0" id="timeout-screen">
        <div class="twelve wide column p-0 modulo-header page-rating">
            <h1 class="text-center bg-blue rounded m-0 px-2 py-1">¡Registro exitoso!</h1>
            <h3 class="text-center my-4 mx-0">Ya te encuentras registrado en el sistema, ahora puedes ingresar con tu cédula y password.</h3>
            <a href="<?= $site['base_url'] ?>/login/" class="btn btn-mustard btn-big mt-2 py-1 px-5 color-white rounded">Ir al login</a>
        </div>
    </div>
    

    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/login/" class="">Iniciar Sesión</a>
        </div>
    </div>

</div>