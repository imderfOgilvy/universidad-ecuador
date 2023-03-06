<div class="main-content h-100" id="ranking-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>
    <div class="ui top attached h-30 px-0">
        <img class="ui fluid image" src="/assets/img/banner_rankings_min.png" />
    </div>
    
    <h1 id="module-ranking-title"></h1>
    <!-- START -->
    <?php if($perfil == 'Nestle Administrativos') { ?>
        <table class="ranking-table">
            <tr>
                <th>N°</th>
                <th>NOMBRE</th>
                <th>PUNTOS</th>
                <th>TOTAL PUNTOS ACUMULADOS</th>
            </tr>
            <tr class="modulo-1 primary-row">
                <td colspan="4">Administrativos</td>
            </tr>
            <?php foreach($rankingAdministrativos[$modulo] as $k => $puntaje): ?>
                <tr class="modulo-$modulo">
                    <td><?= $puntaje['posicion'] ?></td>
                    <td><?= $puntaje['nombre'] ?></td>
                    <td><?= $puntaje['normal'] ?></td>
                    <td><?= $puntaje['extra'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php } else if(isset($puntajes)) { ?>
        <table class="ranking-table">
        <?php $i = 1 ?>
        <?php foreach($puntajes as $k => $puntaje): ?>
                <?php if($puntaje['posicion'] == 1): ?>
                <tr class="modulo-<?= $puntaje['modulo'] ?> <?= ($puntaje['posicion'] == 1 ? "primary-row" : "") ?>">
                    <td colspan="4"><?= $puntaje['grupo_nestle'] ?></td>
                </tr>
                <?php endif; ?>
                <?php if($i == 1): ?>
                <tr>
                    <th>N°</th>
                    <th>NOMBRE</th>
                    <th>PUNTOS</th>
                    <th>PUNTOS EXTRA</th>
                </tr>
                <?php endif; ?>
                <tr class="modulo-<?= $puntaje['modulo'] ?>">
                    <td><?= $puntaje['posicion'] ?></td>
                    <td><?= $puntaje['nombre'] ?></td>
                    <td><?= $puntaje['normal'] ?></td>
                    <td><?= $puntaje['extra'] ?></td>
                </tr>
        
                <?php $i++; ?>
        <?php endforeach; ?>
        </table>
    
    <?php } else  { ?>
        <h2 style="text-align: center;">No hay datos disponibles</h2>
    <?php } ?>


    <!-- END -->
    <div class="ui top attached h-30 px-0">
        <img class="ui fluid image" src="/assets/img/fondo_rankings_min.png" />
    </div>

    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/noticias/" class="">Volver</a>
        </div>
    </div>

</div>
<style>
#ranking-page .ranking-table tr.primary-row td:nth-child(1) {
    background-color: #002469 !important;
    color: #fff;
    border-radius: 52px;
    padding: 16px 40px;
    display: flex;
    justify-content: center;
    max-width: 80%;
    align-items: center;
    margin: 0px auto 15px;
}
</style>
<script>
/*const isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
if(!isChrome){
    Swal.fire({
        title : "Información",
        icon  : "warning",
        html  : '<img scr="https://cdn.iconscout.com/icon/free/png-256/google-chrome-5-722700.png" style="max-width:150px;"><br/><p>Este sitio funciona mejor con Chrome, si tiene inconvenientes por favor siga esta guía para instalarlo y configurarlo.<br/><h1>Guía de Solución</h1><h2>Instalación de Google Chrome</h2><iframe width="280" height="480" src="https://www.youtube.com/embed/la2aaX6vEZM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><h2>Configurar como navegador predeterminado</h2><iframe width="280" height="500" src="https://www.youtube.com/embed/okfdGkpAY-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>'
    })
}*/
    
    $(document).ready(() => {
        $("#module-ranking-title").html("MÓDULO <?= $_GET['id'] ?>")
    })

    jQuery("#ayuda").click(function(e){
        e.preventDefault();
        e.stopPropagation();
          Swal.fire({
            title : "Ayuda de usuario",
            // icon  : "warning",
            html  : '<img src="<?= $site['base_url'] ?>/assets/img/google_chrome_icon.png" style="max-width:80px;"><br/><p>Este sitio funciona mejor con Google Chrome.<br><br>Si tiene inconvenientes para llenar las evaluaciones por favor siga esta guía para instalar Google Chrome y configurarlo.<br/><h1>Guía de Solución</h1><h2>Instalación de Google Chrome</h2><iframe width="280" height="480" src="https://www.youtube.com/embed/la2aaX6vEZM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><h2>Configurar como navegador predeterminado</h2><iframe width="280" height="500" src="https://www.youtube.com/embed/okfdGkpAY-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>'
        });
    })

</script>