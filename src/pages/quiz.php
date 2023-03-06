<div class="main-content h-100" id="quiz-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>

    <!-- QUIZ -->
    <div class="ui centered grid h-5 mt-6 pb-2" id="titulo-principal">
        
        
        <?php if($tipo == 'modulo'){ ?>
                <div class="twelve wide column mb-2 px-6 py-2 bg-mustard rounded modulo-header page-rating">
                    <h2 class="font-size-16">EVALUACIÓN MÓDULO <?= $modulo ?></h2>
                </div>
            <?php } ?>
            <?php if($tipo == 'puntos_extra'){ ?>
                <div class="twelve wide column mb-2 px-6 py-2 bg-red rounded modulo-header page-rating">
                    <h2 class="font-size-16">PUNTOS EXTRA - MÓDULO <?= $modulo ?></h2>
                </div>
            <?php } ?>
    </div>
    <div class="ui centered grid h-5 my-0" id="contador">
        <div class="twelve wide column p-0 modulo-header page-rating">
            <h3 class="text-center m-0">Tiempo restante:</h3>
            <h1 class="text-center m-0" id="count-down-timer"></h1>
        </div>
    </div>
    
    <div class="ui centered grid h-60 d-flex justify-content-center align-items-center my-0 hidden" id="timeout-screen">
        <div class="twelve wide column p-0 modulo-header page-rating">
            <h1 class="text-center m-0">¡Lo sentimos!</h1>
            <h3 class="text-center m-0">Se te ha terminado el tiempo, has perdido 1 intento.</h3>
        </div>
    </div>

    <div class="ui centered grid h-60 mt-2 mb-2 pb-2 quiz-container">
        <div class="thirteen wide column">
            <div class="ui segment quiz-wrapper">
                <div class="ui centered grid m-0 p-0">
                    <div class="sixteen wide column bg-white  h-50 mb-0 px-2 pt-2 modulo-quiz-title">
                    <h2></h2>    
                    <h3></h3>
                    </div>
                    <div class="sixteen wide column bg-white h-50 mt-0 px-6 pt-2 pb-2 modulo-rating modulo-evaluacion modulo-preguntas">
                        <ul class="evaluacion" id="set-preguntas">
                            
                        </ul>
                    </div>
                    <div class="ui dimmer" id="loader">
                        <div class="ui loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui centered grid h-60 mt-2 mb-2 pt-4 pb-2 quiz-result">
        <div class="twelve wide column mb-2 px-6 py-2 bg-mustard rounded modulo-header page-rating">
            <h2 class="font-size-16">FELICITACIONES</h2>
        </div>
        <div class="fifteen wide column">
            <div class="ui segment quiz-wrapper">
                <div class="ui centered grid m-0 p-0">
                    <div class="block-background">
                        <img class="ui fluid image" src="<?= $site['base_url'] ?>/assets/img/quiz/iconoconseguiste.png" alt="">
                        <img class="ui fluid image" style="margin-left:-3px;" src="<?= $site['base_url'] ?>/assets/img/quiz/iconopuntaje.png" alt="">
                    </div>
                    <div class="absolute-container h-100 w-100 d-flex flex-column justify-content-center align-items-center">
                        <h1 class="font-size-68 m-0" id="quiz-result"></h1>
                        <h4 class="font-size-30 m-0" id="quiz-puntos">PUNTOS</h4>
                        <h3 class="font-size-28 m-0" id="quiz-time"></h3>
                    </div>
                    <div class="ui dimmer" id="loader">
                        <div class="ui loader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="ui centered grid h-5 pb-12" id="btn-continuar-wrapper">
        <div class="btn btn-transparent btn-big mt-2 py-1 px-5 color-white rounded" id="btn-continuar-quiz">Continuar</div>
    </div>


    <div class="ui centered grid h-60 d-flex justify-content-center align-items-center my-0 hidden" id="btn-reintentar-quiz">
        <div class="twelve wide column p-0 modulo-header page-rating">
        <h1 class="text-light text-center"><?= ($intentos > 0 ? "Vas por buen camino." : "Lo sentimos, se han acabado todos tus intentos disponibles.") ?></h1>
        <h2 class="text-light text-center"><?= ($intentos > 0 ? "Inténtalo nuevamente." : "") ?></h2>
        <h3 class="text-light text-center">Te quedan <?= $intentos ?> intentos.</h3>
        <a href="<?= $site['base_url'] ?>/modulo/?id=<?= $modulo ?>" class="btn btn-mustard btn-big mt-2 py-1 px-5 color-white rounded">Volver al Módulo</a>
        </div>
    </div>


    <div class="ui centered grid h-5 pb-12 hidden" id="btn-evaluar-quiz">
        <a href="<?= $site['base_url'] ?>/evaluar/?modulo=<?= $modulo ?>" class="btn btn-mustard btn-big mt-2 py-1 px-5 color-white rounded">Calificar Módulo</a>
    </div>
    

    <!-- <div class="ui bottom attached h-5" id='bottom-menu'> -->
        <!-- <div class="bottom-menu-bar bg-mustard user-menu-links"> -->
            <!-- <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/puntaje/" class="">Mi puntaje</a>
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/perfil/" class="">Mi perfil</a> -->
        <!-- </div> -->
    <!-- </div> -->

</div>

<script>

var tipoEncuesta = "<?= $tipo ?>";
var preguntas = <?= $setPreguntas ?>;
var moduloId = <?= $modulo ?>;

</script>



<script>

var pregunta_actual = 1;
var numero_preguntas = Object.keys(preguntas).length;
var puntajeTotal = 0;
var tiempoLogrado = 0;
var puntajeReal = 0;
var respuesta_actual = null;
var intento_actual = <?= $intento ?>;
var numeroAciertos = 0;

function cleanText(text){
    const regexp = /(<\s*br\s*\/?>|\s|&nbsp;)/ig;
    const sanitised = text.replaceAll(regexp, ' ');
    return sanitised;
}


function loadQuestion(questionNumber = 0){
    
    console.log("Cargando Pregunta " + questionNumber);
    respuesta_actual = null;
    $("#loader").addClass("active");

    setTimeout(function(){
        $(".modulo-quiz-title h2").html("Pregunta " + questionNumber);
        $(".modulo-quiz-title h3").html(cleanText(preguntas[pregunta_actual]['pregunta']));


        var html = "";
        const setRespuestas = preguntas[pregunta_actual]['respuestas'];
        const tipo = preguntas[pregunta_actual]['tipo'];

        Object.keys(setRespuestas).forEach(function(key) {
            if(tipo == 'texto'){
                html += '<li data-pregunta="' + questionNumber + '" data-respuesta="' + key + '" class="seleccion-respuesta"><span>' + key + ')</span>' + cleanText(setRespuestas[key]) + "</li>";
            }
            if(tipo == 'imagen'){
                html += '<li data-pregunta="' + questionNumber + '" data-respuesta="' + key + '" class="seleccion-respuesta"><span>' + key + ')</span><img src="<?= $site['base_url'] ?>/assets/img/quiz' + cleanText(setRespuestas[key]) + '" /></li>';
            }
        });

        $("#set-preguntas").html(html);

        $("#loader").removeClass("active");
    }, 1000);
}

function validarPuntaje(){
    jQuery('html, body').animate({
        scrollTop: jQuery("#quiz-page").offset().top
    }, 500);
    var correcta = preguntas[pregunta_actual]['respuesta_correcta'];
    
    //console.log("RESPUESTA ELEGIDA: " + respuesta_actual);
    //console.log("RESPUESTA CORRECTA: " + correcta);
    
    
    if(respuesta_actual == correcta){
        numeroAciertos += 1;
        Swal.fire({
            title : "Respuesta Correcta",
            icon : "success"
        });
        if(moduloId == 7){
            puntajeTotal += 5;
        }else{
            puntajeTotal += 20;
        }
        
    }else{
        Swal.fire({
            title : "Respuesta Incorrecta",
            icon : "error"
        });
    }
    console.log("PUNTOS: " + puntajeTotal);
}

function tiempoFallido(){
    var pregunta_actual = null;
    puntajeTotal = 0;
    numero_preguntas = 0;
    $(".quiz-container").addClass("completed");

    $("#btn-finalizar-quiz").removeClass("hidden");
    $("#timeout-screen").removeClass("hidden");

    $("#btn-continuar-quiz").addClass("hidden");
    $("#titulo-principal").addClass("hidden");
    $("#contador").addClass("hidden");

}

(function($){
    
    // INICIAR QUIZ
    $( document ).ready(function(){
        loadQuestion(pregunta_actual);
        console.log("Iniciando QUIZ");
    });

    // CONTINUAR SIGUIENTE PREGUNTA
    $("#btn-continuar-quiz").click(async function(){
        if(respuesta_actual == null){
            Swal.fire({
                title : "Alerta",
                icon : "warning",
                text : "Para continuar debe seleccionar una respuesta."
            });
            return null;
        }
        if(pregunta_actual == numero_preguntas){
            // validando respuesta anterior
            await validarPuntaje();

            await jQuery.ajax({
                url : '<?= $site['base_url'] ?>/src/ajax/',
                method : 'post',
                data : {
                    fn : 'registrarPuntaje',
                    usuario : <?= $usuario ?>,
                    modulo : <?= $modulo ?>,
                    puntaje : puntajeTotal,
                    intento : intento_actual,
                    tipo : tipoEncuesta,
                    tiempo : tiempoLogrado,
                    puntajeReal : puntajeReal,
                    numeroAciertos : numeroAciertos
                },
                success : function(data){
                    console.log(data);
                    console.log("Registrando puntaje.");
                }
            });

            $(".quiz-container").addClass("completed");
            $("#btn-continuar-quiz").addClass("hidden");
            $("#titulo-principal").addClass("hidden");
            $("#contador").addClass("hidden");
            
            var puntajeEvaluado = 100;
            
            if(moduloId == 7){
                puntajeEvaluado = 75;
            }
            
            if(intento_actual == 3 && puntajeTotal >= puntajeEvaluado){
                puntajeReal = 100;
            }

            if(intento_actual == 2 && puntajeTotal >= puntajeEvaluado){
                puntajeReal = 80;
            }

            if(intento_actual == 1 && puntajeTotal >= puntajeEvaluado){
                puntajeReal = 60;
            }

            $("#btn-continuar-wrapper").addClass("hidden");

            if(puntajeTotal >= puntajeEvaluado){
                $(".quiz-result").addClass("active");
                $("#btn-evaluar-quiz").removeClass("hidden");
                $("#quiz-result").html(puntajeReal);
                $("#quiz-time").html(tiempoLogrado);
            }else{
                $("#btn-reintentar-quiz").removeClass("hidden");
            }
            clearInterval(countInterval) 
        }
        if(pregunta_actual < numero_preguntas){
            // validando respuesta anterior
            validarPuntaje();

            // Incrementando número de respuesta
            pregunta_actual += 1;
            loadQuestion(pregunta_actual);
        }
    });

    
    // ESCOGER RESPUESTA
    $(document).on("click", ".seleccion-respuesta", function(e){
        $( ".seleccion-respuesta" ).removeClass("selected");
        $( this ).addClass("selected");

        console.log("Respuesta seleccionada: " + $( this ).data("respuesta"));

        respuesta_actual = $( this ).data("respuesta");
        
    });

}(jQuery));


function registrarPuntaje(puntaje_value){

}


// TEMPORIZADOR
function paddedFormat(num) {
    return num < 10 ? "0" + num : num; 
}

function startCountDown(duration, element) {

    let secondsRemaining = duration;
    let min = 0;
    let sec = 0;

    let countInterval = setInterval(function () {

        min = parseInt(secondsRemaining / 60);
        sec = parseInt(secondsRemaining % 60);

        element.textContent = `${paddedFormat(min)}:${paddedFormat(sec)}`;

        tiempoLogrado = `${paddedFormat(min)}:${paddedFormat(sec)}`;

        secondsRemaining = secondsRemaining - 1;
        if (secondsRemaining < 0) { 
            tiempoFallido();
            clearInterval(countInterval) 
        
        };

    }, 1000);
}

window.onload = function () {
    var realTime = 8;
     
    if(moduloId == 7){
        realTime = 30;
    }
    
    let time_minutes = realTime; // Value in minutes
    let time_seconds = 00; // Value in seconds

    let duration = time_minutes * 60 + time_seconds;

    element = document.querySelector('#count-down-timer');
    element.textContent = `${paddedFormat(time_minutes)}:${paddedFormat(time_seconds)}`;

    startCountDown(--duration, element);
};
</script>