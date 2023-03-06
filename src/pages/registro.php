<div class="main-content h-100" id="registro-page">
    
    <div class="ui centered grid padded h-40">
        <div class="sixteen wide column pt-12">
            <img class="ui fluid image" src="<?= $site['base_url'] ?>/assets/img/login/bienvenido.png" alt="">
            <img class="ui fluid image login-logo pt-4" src="<?= $site['base_url'] ?>/assets/img/login/logouniversidad.png" alt="">
        </div>
    </div>
    <div class="ui centered grid padded h-50">
        <div class="fifteen wide column pb-6">
            <form method="POST" class="ui form unstackable" id="login-form" autocomplete="off" data-parsley-validate="">
            <div class="field w-100 ui icon input" id="input-cedula">
                <input class="brd-w2 brd-color-yellow" type="text" name="cedula" placeholder="Número de cédula" minlength="10" maxlength="13" autocomplete="off" data-parsley-required="true" data-parsley-type="digits">
                <i class="search icon"></i>
            </div>
            <div class="field">
                <div class="two fields">
                        <div class="field">
                            <input class="brd-w2 brd-color-yellow" type="text" name="nombre" placeholder="Nombre" maxlength="80" autocomplete="off" data-parsley-required="true">
                        </div>
                        <div class="field">
                            <input class="brd-w2 brd-color-yellow" type="text" name="apellido" placeholder="Apellido" maxlength="80" autocomplete="off" data-parsley-required="true">
                        </div>
                </div> 
            </div>
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" name="email" placeholder="Correo Electrónico" maxlength="250" autocomplete="off" data-parsley-required="true" data-parsley-type="email">
            </div>
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" name="celular" placeholder="Número de celular" minlength="7" maxlength="13" autocomplete="off" data-parsley-required="true" data-parsley-type="digits">
            </div>
            
            <div class="field">
                <div class="ui small icon input">
                    <input class="brd-w2 brd-color-yellow" id="password" minlength="8" maxlength="30" type="password" name="password" placeholder="Contraseña" autocomplete="off" data-parsley-required="true" data-parsley-errors-container="#error-password-1">
                    <i class="eye icon" id="revealer1"></i>
                    
                </div>
            </div>
            <div class="field" id="error-password-1">
                
            </div>
            
            <div class="field">
                <div class="ui small icon input">
                    <input class="brd-w2 brd-color-yellow" id="repear-password" type="password" placeholder="Confirmar contraseña" data-parsley-equalto="#password"  data-parsley-errors-container="#error-password-2" data-parsley-equalto-message="Las contraseñas no coinciden." autocomplete="off" data-parsley-required="true">
                    <i class="eye icon" id="revealer2"></i>
                </div>
            </div>
            <div class="field" id="error-password-2">
                
            </div>
            <div class="field ui center aligned container">
            <div class="ui checkbox">
                <input type="checkbox" name="opt_in" tabindex="0" class="hidden" value="1">
                <label class="text-light font-size-12">Acepto términos y condiciones. Autorizo a Nestlé Ecuador para que utilice, transfiera y realice cualquier tratamiento de mis datos personales para enviarme información relevante dentro de lo permitido por la normativa vigente. </label>
                </div>
            </div>
            <div class="ui center aligned container">
                <button class="mini ui button btn btn-bordered btn-white brd-w2 brd-color-yellow font-size-16" type="submit">Enviar</button>
            </div>
            </form>
        </div>
    </div>
    
    <div class="ui bottom attached h-10" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard ">
            <a class="text-dark" href="<?= $site['base_url'] ?>/login/" class="">Iniciar Sesión</a>
        </div>
    </div>

</div>
<script>
Parsley.on('form:submit', function() {
      
});

var toggle1 = "text";
var toggle2 = "text";

(function($){
    
    // LOGIN FUNCTIONS
    $( document ).ready(function(){

        $("#revealer1").mousedown(function(){
            
            jQuery("#password").attr("type", toggle1);
            if(toggle1 == "text"){ toggle1 = "password"; return null}
            if(toggle1 == "password"){ toggle1 = "text"; return null}

        });
        
        $("#revealer2").mousedown(function(){
            
            jQuery("#repear-password").attr("type", toggle2);
            if(toggle2 == "text"){ toggle2 = "password"; return null}
            if(toggle2 == "password"){ toggle2 = "text"; return null}

        });

    });

}(jQuery));

var canSearch = true;

jQuery("input[name='cedula']").on("keyup change", function(e){
    
    var value = jQuery(this).val();
    if(value.length < 10){
        jQuery("input[name='nombre']").val("");
        jQuery("input[name='apellido']").val("");
        jQuery("input[name='email']").val("");
        jQuery("input[name='celular']").val("");
    }
    
    if (value.length == 10 && canSearch){
        
        jQuery("input[name='cedula']").attr("readonly", "readonly");
        jQuery("input[name='cedula']").addClass("bg-grey");
        jQuery("#input-cedula").addClass("loading");

                
            setTimeout(function(){
                
                jQuery.ajax({
                    method : "GET",
                    url : "/universidad/src/ajax/",
                    data : {
                        fn : "getNestleUser",
                        cedula : value
                    },
                    success : function(data){
                        
                        let obj = data.data;
                        try {
                            
                            let nombre_completo = obj.nombre;
                            const array_nombre = nombre_completo.split(" ");
                            
                            jQuery("input[name='email']").val(obj.correo);
                            jQuery("input[name='celular']").val(obj.celular);
                            jQuery("input[name='nombre']").val(array_nombre[0] + " " + array_nombre[1]);
                            jQuery("input[name='apellido']").val(array_nombre[2] + " " + array_nombre[3]);
                        } catch (error) {
                            
                        }
                        
                        jQuery("#input-cedula").removeClass("loading");
                        jQuery("input[name='cedula']").removeAttr('readonly');
                        jQuery("input[name='cedula']").removeClass("bg-grey");
                    },
                    error : function(data){
                        jQuery("#input-cedula").removeClass("loading");
                        jQuery("input[name='cedula']").removeAttr('readonly');
                        jQuery("input[name='cedula']").removeClass("bg-grey");
                    }
                });
            },1000);
    }
    
});
</script>