<div class="main-content h-100" id="login-page">
    
    <div class="ui centered grid padded h-45">
        <div class="sixteen wide column pt-12"></div>
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
            <?php if($status == 'error'){ ?>
                <div class="ui negative message">
                  <i class="close icon"></i>
                  <div class="header">
                   Error de acceso.
                  </div>
                  <p>Nombre de usuario o contraseña incorrecta
                </p></div>
            <?php } ?>
            <form class="ui form" method="post" id="login-form" autocomplete="off">
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" name="username" placeholder="Nombre de usuario" autocomplete="off">
            </div>
            <div class="field">
                <div class="ui small icon input">
                    <input id="revealed" class="brd-w2 brd-color-yellow" type="password" name="password" placeholder="Contraseña" autocomplete="off">
                    <i class="eye icon" id="revealer"></i>
                </div>
            </div>
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