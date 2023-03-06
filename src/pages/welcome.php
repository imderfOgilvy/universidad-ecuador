<div class="main-content h-100 pt-10" id="login-page">
    
    <div class="ui centered grid padded h-55">
        <div class="sixteen wide column pt-10">
            <img class="ui fluid image" src="<?= $site['base_url'] ?>/assets/img/login/bienvenido.png" alt="">
            <img class="ui fluid image login-logo pt-4" src="<?= $site['base_url'] ?>/assets/img/login/logouniversidad.png" alt="">
        </div>
        <h3>FALTAN:</h3>
    </div>
    <div class="ui centered grid padded h-25">
        <div id="flipdown" class="flipdown"></div>
    </div>
    <div class="ui bottom attached h-10" id='bottom-menu'>
        <!-- <div class="bottom-menu-bar bg-mustard ">
            <a class="text-dark" href="<?= $site['base_url'] ?>/registro/" class="">No tengo una cuenta</a>
        </div> -->
    </div>

</div>


<script>
    const toTimestamp = (strDate) => {  
        const dt = Date.parse(strDate);  
        return dt / 1000;  
    }  

    var flipdown = new FlipDown(toTimestamp('02/15/2022 07:00:00'), 'flipdown', 
        { headings: ["Días", "Horas", "Minutos", "Segundos"], theme : 'light'}
    );
    flipdown.start();
    flipdown.ifEnded(() => {
        console.log('El día ha llegado.');
        });
</script>
<style>
    .flipdown.flipdown__theme-dark .rotor-group-heading:before {
    color: #fff !important;
}
.flipdown .rotor-group:last-child {
    padding-right: 0;
    display: none;
}
#flipdown .rotor-group:nth-child(3):after {
    display: none;
}
#flipdown .rotor-group:nth-child(3):before {
    display: none;
}
.flipdown.flipdown__theme-light {
    font-family: sans-serif;
    font-weight: bold;
    justify-content: center !important;
    align-items: center !important;
    display: flex !important;
}
div#flipdown {
    margin-left: 18px;
}
#login-page .login-logo{
        width: 80% !important;  
        max-width: 350px !important;  
        width: 70vw !important;      
    }
@media (max-width:768px){
    #login-page .login-logo{
        max-width: 70vw !important;  
        width: 70vw !important;      
    }
}
</style>