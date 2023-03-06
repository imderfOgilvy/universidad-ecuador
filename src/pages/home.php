<div class="main-content h-100" id="home-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('src/layout/navbar.php'); ?>
    </div>

    <!-- BIENVENIDA Y VIDEO -->
    <div class="ui centered grid h-30 pb-4">
        <div class="sixteen wide column px-6 pt-4">
            <?php $primerNombre = implode(" ", array_slice(explode(" ", $_SESSION['user']['nombre']), 0, 1));?>
            <h1 class="font-size-22">Hola, <?= $primerNombre ?>.</h1>
        </div>
        
        <!-- https://youtu.be/W_vo_HeHovY -->
        <div class="sixteen wide column bg-mustard px-6 pt-2">
            <div class="ui embed video-modulo" data-autoplay="true" data-source="youtube" data-id="W_vo_HeHovY" ></div>
        </div>
    </div>
    
    
    <?php $sups = [1=>'ro',2=>'do',3=>'ro',4=>'to',5=>'to',6=>'to',7=>'mo',8=>'vo',9=>'no',10=>'mo'] ?>

    <?php if(isset($puntajes) && (1 == 2)){ ?>
    <?php $pos = 1; ?>
    <div class="ui centered grid h-10 padded">
        <div class="eight wide column">
            <a class="btn text-light py-1 btn-ranking active" href="#" class="" id="btn-ranking-distribuidoras"><?= $perfil ?></a>
        </div>
    </div>
    </div>
    <div class="ui centered grid h-20 pb-4 slider-ranking active" id="slider-ranking-vendedores">
        <div class="sixteen wide column bg-grey-light px-2 pt-2">
            <!-- Slider main container -->
            <div class="swiper slider-ranking-sweeper slider-ranking-vendedores px-6">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php foreach($puntajes as $k => $person){ ?>
                    <div class="swiper-slide slide-vendedores-<?= $k ?>">
                        <div class="ui card">
                            <div class="image">
                                <div class="position-label"><?= $pos ?><sup><?= $sups[$pos] ?></sup></div>
                                <?php $avatar = App::getPhoto($person['ID']); ?>
                                <?php if($avatar !== ""){ ?>
                                    <!--<img src="<?php //$avatar ?>">-->
                                <?php } ?>
                            </div>
                            <div class="content">
                                <h4 class="header font-size-14 mb-0"><?= $person['nombre'] ?></h4>
                                <!--<div class="meta">-->
                                <!--    <a>Vendedor</a>-->
                                <!--</div>-->
                                <div class="description font-size-18">
                                    <?= $person['puntaje'] ?> pts.
                                </div>
                                
                                <div class="text-mustard font-size-14 mt-1" style="line-height: 14px;">
                                <b>Tiempo acumulado: </b> <?= gmdate("i:s", $person['segundos']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $pos++; ?>
                <?php } ?>
                
                
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            </div>
        </div>
    </div>
    <?php } ?>

    <!-- BOTONES DE RANKING -->
    <?php /*
    <?php if($perfil == "Distribuidora"){ ?>
    <div class="ui centered grid h-10 padded">
        <div class="eight wide column">
            <a class="btn text-light py-1 btn-ranking active" href="#" class="" id="btn-ranking-distribuidoras">Ranking distribuidoras</a>
        </div>

        <div class="eight wide column">
            <a class="btn text-light py-1 btn-ranking" href="#" class="" id="btn-ranking-vendedores">Ranking vendedores</a>
        </div>
    </div>
    </div>
    <?PHP } ?>

    
    <!-- TOP 10 -->
    <div class="ui centered grid h-10 mt-4 titulo-ranking <?= ($perfil == "Distribuidora" ? "active" : "") ?>" id="titulo-ranking-distribuidoras">
        <div class="ten wide column bg-red round-title pb-1 pt-1">
            <h1 class="text-light text-center">TOP 10<br> Distribuidoras</h1>
        </div>
    </div>
    <div class="ui centered grid h-10 mt-4 titulo-ranking <?= ($perfil !== "Distribuidora" ? "active" : "") ?>" id="titulo-ranking-vendedores">
        <div class="ten wide column bg-red round-title pb-1 pt-1">
            <h1 class="text-light text-center">TOP 10<br> <?= ($perfil !== "Distribuidora" ? $perfil : "Venderores") ?></h1>
        </div>
    </div>

    <?php $disPuntajes = [4500, 4200, 4100, 3800, 3200, 2700, 2100, 1700, 1500, 800] ?>

    <?php if($perfil == "Distribuidora"){ ?>
    <!-- Slider Ranking Distribuidores -->
    <div class="ui centered grid h-20 pb-4 slider-ranking active" id="slider-ranking-distribuidoras">
        <div class="sixteen wide column bg-grey-light px-2 pt-2">
            <!-- Slider main container -->
            <div class="swiper slider-ranking-sweeper slider-ranking-distribuidoras px-6">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php for($i=1;$i<=10;$i++){ ?>
                    <div class="swiper-slide slide-distribuidoras-<?= $i ?>">
                        <div class="ui card">
                            <div class="image">
                                <div class="position-label"><?= $i ?><sup><?= $sups[$i] ?></sup></div>
                                <!-- <img src="<?= $site['base_url'] ?>/assets/img/avatar/daniel.jpg"> -->
                            </div>
                            <div class="content">
                                <h4 class="header font-size-14 mb-0">Distribuidora <?= $i ?></h4>
                                <div class="meta">
                                    <a>Distribuidora</a>
                                </div>
                                <div class="description font-size-18">
                                    <?= $disPuntajes[$i - 1] ?> pts
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
                
            </div>

        </div>
    </div>
    <?PHP } ?>
    
    
    <?php $vendPuntajes = [3500, 3400, 2700, 2300, 1900, 1500, 1200, 700, 500, 200] ?>
    <?php $vendNombres = ["Carlos Mats", "Paula Ribs", "Camilo Mibs", "Rubi Seik", "Marlon Struart", "July Mai", "Byron Rea", "Samuel Beltrán", "Mayra Coba", "Saúl Briones"] ?>

    <!-- Slider Ranking Vendedores -->
    <div class="ui centered grid h-20 pb-4 slider-ranking <?= ($perfil !== "Distribuidora" ? "active" : "") ?>" id="slider-ranking-vendedores">
        <div class="sixteen wide column bg-grey-light px-2 pt-2">
            <!-- Slider main container -->
            <div class="swiper slider-ranking-sweeper slider-ranking-vendedores px-6">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php for($i=1;$i<=10;$i++){ ?>
                    <div class="swiper-slide slide-vendedores-<?= $i ?>">
                        <div class="ui card">
                            <div class="image">
                                <div class="position-label"><?= $i ?><sup><?= $sups[$i] ?></sup></div>
                                <!-- <img src="<?= $site['base_url'] ?>/assets/img/avatar/daniel.jpg"> -->
                            </div>
                            <div class="content">
                                <h4 class="header font-size-14 mb-0"><?= $vendNombres[$i - 1] ?></h4>
                                <div class="meta">
                                    <a>Vendedor</a>
                                </div>
                                <div class="description font-size-18">
                                    <?= $vendPuntajes[$i - 1] ?> pts
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
                
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            </div>
        </div>
    </div>
    */ ?>
    <!-- PUNTOS EXTRA -->
    <!-- <div class="ui centered grid h-5">
        <div class="fourteen wide column bg-mustard rounded px-0 py-1 puntos-extra">
            <h1 class="text-light text-center m-0">Gana puntos extra</h1>
            <h3 class="text-red text-center m-0 bg-white">Disponible en 12 días</h3>
        </div>
    </div> -->

    <!-- MODULOS -->
    <div class="ui centered grid padded h-5">
        <div class="sixteen wide column pb-1 pt-4">
            <h1 class="text-light font-size-32">Módulos</h1>
        </div>
    </div>

    <!-- MODULOS -->
    <div style="display: none;"><?php print_r($user_session) ?></div>
    <div class="ui centered grid h-15 pb-6">
        <!-- Slider main container -->
        <div class="swiper slider-modulos px-6">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php foreach($modulosNestle as $k => $v){ ?>
                    <?php 
                    //echo $perfil;
                    //echo $v['id'];
                    if($perfil == 'Nestle Administrativos' && $v['id'] == 7){
                        $v['state'] = "locked";
                    }?>
                    
                    <?php //if($perfil == 'Nestle Administrativos' && $v['id'] == 3){ $v['state'] = 'locked'; }?>
                    
                    <?php // $lockedClass = $v['state'] == "locked" || $bloquearModulo ? "locked" : "open"; ?>
                    <?php // $href = ($v['state'] == "open" && !$bloquearModulo ? $site['base_url'] . "/modulo/?id=" . $v['id'] : "#") ?>
                    <?php $href = $site['base_url'] . "/modulo/?id=" . $v['id']  ?> 
                    <div class="swiper-slide">
                        <h2 class="text-light font-size-14">Módulo <?= $v['id'] ?></h2>
                        <a class="modulo <?= $v['state'] ?> bg-red py-2 px-3" href="<?= $href ?>">
                        <div class="image"><img class="ui fluid image login-logo" src="<?= $site['base_url'] ?><?= $v['image'] ?>" alt=""></div>
                        <div class="boton mt-1"><div class="btn btn-transparent brd-w2 rounded">Ingresar</div></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    
    <!-- PROGRESO TOTAL -->
    <div class="ui centered grid padded h-5">
        <div class="sixteen wide column pb-1 pt-4">
            <h1 class="text-light font-size-32"><center>Avance total</center></h1>
        </div>
    </div>

    <div class="ui centered grid padded h-5 px-4">
        
        <div class="eight wide column py-0 d-flex align-items-center justify-content-center">
            <!-- TODO CAMBIAR puntaje_total por el procedimiento de avance -->
            <h1 class="text-light text-right font-size-32"><?= (isset($avance) ? $avance : 0)  ?> %</h1>
        </div>
    </div>
    
    <div class="ui centered grid padded h-5 pb-12 px-4">
        <div class="sixteen wide column pb-1 pt-1">
        <div class="ui yellow progress" data-percent="<?= (isset($avance) ? $avance : 0)  ?>" id="progress-bar" >
            <div class="bar"></div>
        </div>
        </div>
    </div>
    
    <div class="ui centered grid padded h-5 pb-12 px-4">
        <div class="sixteen wide column pb-1 pt-1">
            <a class="btn btn-mustard rounded py-3 font-size-18" id="ayuda">Ayuda de usuario</a>
        </div>
    </div>

    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/puntaje/" class="">Mi puntaje</a>
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/perfil/" class="">Mi perfil</a>
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

</script>