<div class="main-content h-100" id="home-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>
    <div class="ui centered grid h-75 pb-6">
    <embed src="/recursos/TOP_100_I_Trimestre_FFVV.pdf" type="application/pdf" width="100%" height="360px" />
    </div>

 
 
 
    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/puntaje/" class="">Mi puntaje</a>
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/perfil/" class="">Mi perfil</a>
        </div>
    </div>

</div>