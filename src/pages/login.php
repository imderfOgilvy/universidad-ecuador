<div class="main-content h-100" id="login-page">
    
    <div class="ui centered grid padded h-45">
        <div class="sixteen wide column pt-12">
            <img class="ui fluid image" src="<?= $site['base_url'] ?>/assets/img/login/bienvenido.png" alt="">
            <img class="ui fluid image login-logo pt-4" src="<?= $site['base_url'] ?>/assets/img/login/logouniversidad.png" alt="">
        </div>
    </div>
    <div class="ui centered grid padded h-45">
        <div class="twelve wide column">
            <!-- MENSAJE -->
            <div class="ui transition hidden message" id="result-message">
            <i class="close icon"></i>
              <div class="header" id="result-header">
                    
                </div>
                <p id="result-text"></p>
            </div>
            <!-- FORULARIO LOGIN -->
            <form class="ui form" method="post" id="login-form" autocomplete="off">
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" name="username" placeholder="Número de cédula" autocomplete="off">
            </div>
            <!--<div class="field">-->
            <!--    <div class="ui small icon input">-->
            <!--        <input id="revealed" class="brd-w2 brd-color-yellow" type="password" name="password" placeholder="Contraseña" autocomplete="off">-->
            <!--        <i class="eye icon" id="revealer"></i>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="field ui center aligned container">-->
            <!--<div class="ui checkbox">-->
            <!--    <input type="checkbox" tabindex="0" class="hidden">-->
            <!--    <label class="text-light">Recordarme</label>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="ui center aligned container">
                <button class="mini ui button btn btn-bordered btn-white brd-w2 brd-color-yellow font-size-16" type="submit" id="btn-login">Ingresar</button>
            </div>
            </form>
        </div>
    </div>
    <div class="ui bottom attached h-10" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard ">
            <!--<a class="text-dark" href="<?= $site['base_url'] ?>/registro/" class="">No tengo una cuenta</a>-->
        </div>
    </div>

</div>

<script>
var toggle = "text";

(function($){
    
    // LOGIN FUNCTIONS
    $( document ).ready(function(){

        $("#revealer").mousedown(function(){
            
            jQuery("#revealed").attr("type", toggle);
            if(toggle == "text"){ toggle = "password"; return null}
            if(toggle == "password"){ toggle = "text"; return null}

        });

        // $("#revealer").mousedown(function(){
        //     $("#revealed").attr("type", "text");
        //     console.log("DOWN");
        // });
        // $("#revealer").mouseup(function(){
        //     $("#revealed").attr("type", "password");
        //     console.log("UP");
        // });
    });

}(jQuery));

</script>