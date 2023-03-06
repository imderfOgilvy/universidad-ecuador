<style>
#menu-noticias{
    display:none;
}
#menu-noticias.active{
    display:flex;
}
.seccion-rankings{
    display:none;
}
.seccion-rankings.active{
    display:block;
}
li.menu-rankings{
  list-style:none;
}
.title-rankings,
li.menu-rankings{
  margin-bottom:40px;
  margin-left:-80px;
  background:#ee3;
  padding: 20px 66px 20px 62px;
  font-size:18px;
background: rgb(232,161,6);
background: -moz-linear-gradient(117deg, rgba(232,161,6,1) 0%, rgba(249,183,39,1) 100%);
background: -webkit-linear-gradient(117deg, rgba(232,161,6,1) 0%, rgba(249,183,39,1) 100%);
background: linear-gradient(117deg, rgba(232,161,6,1) 0%, rgba(249,183,39,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e8a106",endColorstr="#f9b727",GradientType=1);
  position:relative;
  cursor:pointer;
}
ul.menu-rankings {
    max-width: 87vw;
}
.title-rankings .imagen-menu-rankings,
li.menu-rankings .imagen-menu-rankings{
  position:absolute;
  background:#fe0c1c;
  width:80px;
  height:80px;
  right:-40px;
  top:-10px;
  border-radius:100%;
  display:flex;
  justify-content:center;
  align-items:center;
  overflow:hidden;
}
.title-rankings .imagen-menu-rankings{
   background: #003C60;
}
.title-rankings .imagen-menu-rankings img,
li.menu-rankings .imagen-menu-rankings img{
  width:80%;
}

/** NOTICIAS **/
.video-ranking {
  position:relative;
  height:120px;
}

.video-ranking .video-container {
  position:absolute;
  left:0px;
  top:7px;
  width:200px;
  max-width:35vw;
  height:114px;
  max-height:114px;
  min-height:114px;
  z-index:2;
  overflow:hidden;
  border-radius:15px !important;
  padding-bottom:0px !important;
}
.video-ranking .video-container iframe {
  height:114px;
}
.video-ranking h3 {
    position: absolute;
    height: 80px;
    left: 0px;
    padding-top: 30px;
    padding-left: 35vw;
    text-align: center;
    width: 100%;    
    font-size: 1.2em;
    z-index: 1;
    border-radius: 0px 25px 25px 0px;
    background: rgb(232,161,6);
    background: -moz-linear-gradient(117deg, rgba(232,161,6,1) 0%, rgba(249,183,39,1) 100%);
    background: -webkit-linear-gradient(117deg, rgba(232,161,6,1) 0%, rgba(249,183,39,1) 100%);
    background: linear-gradient(117deg, rgba(232,161,6,1) 0%, rgba(249,183,39,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#e8a106",endColorstr="#f9b727",GradientType=1);
}

.video-ranking .video-imagen {
  position:absolute;
  height:60px;
  width:60px;
  max-height:60px;
  max-width:60px;
  min-height:60px;
  min-width:60px;
  top:-10px;
  right:19%;
  background:#aaa;
  z-index:5;
  border-radius:100%;
  overflow:hidden;
}
.video-ranking .video-imagen img{
  max-width:104%;
  margin-left:-2%;
}
</style>
<div class="main-content h-10">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>
</div>
<div class="main-content h-100 active" id="menu-noticias">
    <ul class="menu-rankings">
        <li class="menu-rankings" data-target="ranking-universidad">Rankings Universidad Nestlé<div class="imagen-menu-rankings"><img src="/assets/img/icon/rankings_universidad.png"></div></li>
        <?php //if(in_array($perfil, $perfilesTitanes)): ?>
        <?php if($perfil == 'Nestle Administrativos' || $perfil == 'Staff Comercial' || $perfil == 'CDT' || $perfil == 'Fuerza de Ventas DSD'): ?>
            <li class="menu-rankings" data-target="ranking-titanes">Rankings Titanes<div class="imagen-menu-rankings"><img src="/assets/img/icon/rankings_titanes.png"></div></li>
        <?php endif; ?>
        <li class="menu-rankings" data-target="ranking-noticias">Noticias<div class="imagen-menu-rankings"><img src="/assets/img/icon/rankings_noticias.png"></div></li>
    </ul>
</div>

<div class="seccion-rankings h-100" id="ranking-universidad">

    <!-- START -->
    <div class="ui centered grid padded h-5">
        <div class="thirteen wide column pb-1 pt-4">
            <div class="title-rankings">Rankings Universidad Nestlé<div class="imagen-menu-rankings"><img src="/assets/img/icon/rankings_universidad.png"></div></div>
        </div>
    </div>
    
    <!-- MODULOS -->
    <div class="ui centered grid padded h-5">
        <div class="sixteen wide column pb-1 pt-4">
            <center><h1 class="text-light font-size-32">RANKING</h1></center>
        </div>
    </div>

    <!-- MODULOS -->
    <div class="ui centered grid h-15 pb-6">
        <!-- Slider main container -->
        <div class="swiper slider-modulos px-6">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php foreach($modulosNestle as $k => $v){ ?>
                    <?php $bloquearModulo = $perfil == 'Nestle Administrativos' && $v['id'] > 4 ;?>
                    <?php $lockedClass = $v['state'] == "locked" || $bloquearModulo ? "locked" : "open"; ?>
                    <?php $href = ($v['state'] == "open" && !$bloquearModulo ? $site['base_url'] . "/ranking/?id=" . $v['id'] : "#") ?> 
                    <div class="swiper-slide">
                        <h2 class="text-light font-size-14">Módulo <?= $v['id'] ?></h2>
                            <div class="modulo <?= $lockedClass ?> bg-red py-2 px-3">
                            <div class="image"><img class="ui fluid image login-logo" src="<?= $site['base_url'] ?><?= $v['image'] ?>" alt=""></div>
                            <div class="boton mt-1"><div class="btn btn-transparent brd-w2 rounded"><a style="color: #fff;" href="<?= $href ?>">Ver puntajes</a></div></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>


    <!-- END -->
    
    <div class="ui centered grid h-5 pb-12" id="btn-continuar-wrapper">
        <a class="font-size-16 btn btn-transparent btn-min mt-2 py-1 px-5 color-white rounded" href="/top100">Top 100 - 1er Trimestre</a>
    </div>

</div>

<div class="seccion-rankings mb-12 h-100" id="ranking-titanes">
    <!-- START -->
    <div class="ui centered grid padded h-5">
        <div class="thirteen wide column pb-1 pt-4">
            <div class="title-rankings">Rankings Titanes<div class="imagen-menu-rankings"><img src="/assets/img/icon/rankings_titanes.png"></div></div>
        </div>
    </div>
    
    <div class="ui centered grid padded h-5">
        <div class="sixteen wide column pb-1 pt-4">
            <?php /* ?>
            <?php if($perfil == 'Nestle Administrativos' || $perfil == 'Staff Comercial' || $perfil == 'CDT'): ?>
                <center><h1 class="text-light font-size-32">Ganadores batalla 10<br/>2 al 8 de mayo</h1></center>
            <?php endif; ?>
            
            <?php if($perfil == 'Fuerza de Ventas DSD'): ?>
                <center><h1 class="text-light font-size-32">Ganadores DSD batalla 9<br/>2 al 8 de mayo</h1></center>
            <?php endif; ?>
            <?php if($perfil == 'Nestle Administrativos' || $perfil == 'Staff Comercial' || $perfil == 'CDT'): ?>
                <center><h1 class="text-light font-size-32">Ganadores batalla 11<br/>16 al 22 de mayo</h1></center>
            <?php endif; ?>
            
            <?php if($perfil == 'Fuerza de Ventas DSD'): ?>
                <center><h1 class="text-light font-size-32">Ganadores DSD batalla 12<br/>16 al 22 de mayo</h1></center>
            <?php endif; ?>
            <?php */ ?>
        </div>
    </div>
    
        
            
    <?php if($perfil == 'Nestle Administrativos' || $perfil == 'Staff Comercial' || $perfil == 'CDT'): ?>
        <!-- https://youtu.be/e9jKl_F6tAw -->
        <!-- https://youtu.be/H4FG9ByeNMo -->
        <div class="sixteen wide column bg-mustard px-6 pt-2 pb-6">
            <div class="ui embed video-modulo" data-autoplay="true" data-source="youtube" data-id="hgBkvnbNhcI" ></div>
        </div>
    <?php endif; ?>
    
    <?php if($perfil == 'Fuerza de Ventas DSD'): ?>
        <!-- https://youtube.com/shorts/HdnjLlhG8ck?feature=share -->
        <!-- https://youtu.be/kc-5Z7h9iWg -->
        <div class="sixteen wide column bg-mustard px-6 pt-2 pb-6">
            <div class="ui embed video-modulo" data-autoplay="true" data-source="youtube" data-id="rtgAFqj7lsA" ></div>
        </div>
    <?php endif; ?>
            
            
</div>

<div class="seccion-rankings mb-12 h-100" id="ranking-noticias">
    <!-- START -->
    <div class="ui centered grid padded h-5">
        <div class="thirteen wide column pb-1 pt-4">
            <div class="title-rankings">Noticias<div class="imagen-menu-rankings"><img src="/assets/img/icon/rankings_noticias.png"></div></div>
        </div>
    </div>
    <?php 
        
        /*['id'=>'1', 'title'=>'Argumentos de la venta', 'img'=>'argumento_nestle.png', 'video'=> 'qGrzzvpn55c' ],
        ['id'=>'2', 'title'=>'Argumentos de la venta', 'img'=>'argumento_maggi.png', 'video'=> 'pxrA-HV4EL0' ],
        ['id'=>'3', 'title'=>'Argumentos de la venta', 'img'=>'argumento_nescafe.png', 'video'=> 'v3h2l6MaIuc' ],
        ['id'=>'4', 'title'=>'Argumentos de la venta', 'img'=>'argumento_amor.png', 'video'=> 'KiNizKyAJbY' ],
        ['id'=>'5', 'title'=>'Argumentos de la venta', 'img'=>'argumento_maggi.png', 'video'=> '1L2XG5OQuD0' ],
        ['id'=>'6', 'title'=>'Argumentos de la venta', 'img'=>'argumento_maggi.png', 'video'=> 'I_nJVMMwY1c' ],
        ['id'=>'7', 'title'=>'Argumentos de la venta', 'img'=>'argumento_lechera.png', 'video'=> '7IgV4Vdt1VQ' ],*/
        $videos = [
        
        ['id'=>'1', 'title'=>'Purina One', 'img'=>'argumento_nestle.png', 'video'=> 'JhcTSw4NPgo' ],
        ['id'=>'2', 'title'=>'Tips de seguridad<br>(Asaltos en la calle)', 'img'=>'argumento_nestle.png', 'video'=> 'Qc3wUrg680I' ],
        ['id'=>'3', 'title'=>'Tips de seguridad<br>(Asaltos en los semáforos)', 'img'=>'argumento_nestle.png', 'video'=> 'ryWZRORIw4w' ],
        ['id'=>'4', 'title'=>'Tips de seguridad<br>(Asaltos en cajeros)', 'img'=>'argumento_nestle.png', 'video'=> 'Keo4TCD37Qo' ],
        ['id'=>'6', 'title'=>'Más de lo que tu crees', 'img'=>'argumento_nestle.png', 'video'=> 'yRwGVBt09Kk' ],
        ['id'=>'8', 'title'=>'Cubos Maggi', 'img'=>'argumento_nestle.png', 'video'=> 'Yb63drUwKi4' ],
        ['id'=>'9', 'title'=>'Criollita Maggi', 'img'=>'argumento_nestle.png', 'video'=> 'QBz3IhtEBKg' ],
        
    ]; ?>
    
    <?php foreach($videos as $key => $video): ?>
        <div class="ui centered grid padded h-5">
            <div class="sixteen wide column px-6 pt-2 pb-6">
                <div class="video-ranking">
                    <div class="ui embed video-container" data-autoplay="true" data-source="youtube" data-id="<?= $video['video'] ?>" ></div>
                    <h3><?= $video['title'] ?></h3>
                    <div class="video-imagen"><img src="/assets/img/argumentos/<?= $video['img'] ?>"></div>
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
</div>


<div class="main-content h-10">
   <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="JavaScript:Void(0);" onclick="showMenu()" class="">Volver</a>
        </div>
    </div>
</div>
<script>
/*const isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
if(!isChrome){
    Swal.fire({
        title : "Información",
        icon  : "warning",
        html  : '<img scr="https://cdn.iconscout.com/icon/free/png-256/google-chrome-5-722700.png" style="max-width:150px;"><br/><p>Este sitio funciona mejor con Chrome, si tiene inconvenientes por favor siga esta guía para instalarlo y configurarlo.<br/><h1>Guía de Solución</h1><h2>Instalación de Google Chrome</h2><iframe width="280" height="480" src="https://www.youtube.com/embed/la2aaX6vEZM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><h2>Configurar como navegador predeterminado</h2><iframe width="280" height="500" src="https://www.youtube.com/embed/okfdGkpAY-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>'
    })
}*/
    

    jQuery("#ayuda").click(function(e){
        e.preventDefault();
        e.stopPropagation();
          Swal.fire({
            title : "Ayuda de usuario",
            // icon  : "warning",
            html  : '<img src="<?= $site['base_url'] ?>/assets/img/google_chrome_icon.png" style="max-width:80px;"><br/><p>Este sitio funciona mejor con Google Chrome.<br><br>Si tiene inconvenientes para llenar las evaluaciones por favor siga esta guía para instalar Google Chrome y configurarlo.<br/><h1>Guía de Solución</h1><h2>Instalación de Google Chrome</h2><iframe width="280" height="480" src="https://www.youtube.com/embed/la2aaX6vEZM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><h2>Configurar como navegador predeterminado</h2><iframe width="280" height="500" src="https://www.youtube.com/embed/okfdGkpAY-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>'
        });
    })


    jQuery( document ).on("mouseup", ".menu-rankings", async function(){
        const id = await jQuery( this ).data("target");
        jQuery(".seccion-rankings").removeClass("active");
        jQuery("#menu-noticias").removeClass("active");
        const elm = await document.getElementById(id);
        if(elm){
            elm.classList.add("active");
        }
    })
    
    function showMenu(){
        jQuery(".seccion-rankings").removeClass("active");
        jQuery("#menu-noticias").addClass("active");
    }
</script>