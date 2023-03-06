var siteurl = "";

(function(jQuery){
    $(document).ready(function(){
        // Crear Checkbox
        $('.ui.checkbox')
        .checkbox();
    
        // Crear Radio Buttons
        $('.ui.radio.checkbox')
        .checkbox();

        // Cerrar Mensajes
        $('.message .close')
        .on('click', function() {
            $(this)
            .closest('.message')
            .transition('fade')
            ;
        });

        //  Load Videos
        $('.ui.embed').embed();

        // Progress Bar
        $('#progress-bar').progress();

        // Mobile Menu
        $('#mobile-menu')
        .on('click', function(e) {
            $('#nav-menu').toggleClass("open");
        });
        $('.close-nav')
        .on('click', function(e) {
            $('#nav-menu').removeClass("open");
        });

        // Rating
        $('.rating')
        .rating({
            initialRating: 0,
            maxRating: 5
        })
        ;

        // Btn login
        /*$('#btn-login')
        .on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var data = $('#login-form').serializeArray();
            data.push({name: "fn", value: 'login'});

            $('#login-form').addClass('loading');

            $("#result-message").removeClass("warning");
            $("#result-message").removeClass("negative");
            $('#result-text').html(); 
            $('#result-title').html(); 
            setTimeout(function(){
                $.ajax({
                    url : siteurl + '/src/ajax/',
                    method : 'post',
                    data : data,
                    success : function(data){
                        console.log(data);
                        if(data.status !== 'success'){
                            $("#result-message").addClass(data.status);
                            $('#result-header').html(data.title); 
                            $('#result-text').html(data.message); 
                            $("#result-message").removeClass("hidden");
                        }
                        if(data.status == 'success'){
                            window.location.replace( siteurl + '/');
                        }
                    }
                })
                .always(function(){
                    $('#login-form').removeClass('loading');
                });
            }, 1200);
        });*/

        // Puntos Extra

        $('#puntos-extra').click(function(){
          Swal.fire({
            'title' : "Puntos extra",
            'icon' : "info",
            'text' : "El cuestionario para ganar puntos extra estará disponible después de 12 días." 
          })
        });

        // Intercambiar Sliders
        $("#btn-ranking-distribuidoras").click(function(){
          $(".slider-ranking").removeClass("active");
          $(".titulo-ranking").removeClass("active");
          $(".btn-ranking").removeClass("active");
          $("#slider-ranking-distribuidoras").addClass("active");
          $("#titulo-ranking-distribuidoras").addClass("active");
          $("#btn-ranking-distribuidoras").addClass("active");
        })

        $("#btn-ranking-vendedores").click(function(){
          $(".slider-ranking").removeClass("active");
          $(".titulo-ranking").removeClass("active");
          $(".btn-ranking").removeClass("active");
          $("#slider-ranking-vendedores").addClass("active");
          $("#titulo-ranking-vendedores").addClass("active");
          $("#btn-ranking-vendedores").addClass("active");
        })

        // Slider Ranking
        var swiper = new Swiper(".slider-ranking-sweeper", {
            slidesPerView: 2,
            spaceBetween: 10,
            slidesPerGroup: 2,
            initialSlide : 1,
            loop: false,
            loopFillGroupWithBlank: false,
            breakpoints: {
                // when window width is >= 320px
                320: {
                  slidesPerView: 2,
                  slidesPerGroup: 2,
                  spaceBetween: 5
                },
                // when window width is >= 480px
                480: {
                  slidesPerView: 2,
                  slidesPerGroup: 2,
                  spaceBetween: 5
                },
                // when window width is >= 640px
                640: {
                  slidesPerView: 3,
                  slidesPerGroup: 3,
                  spaceBetween: 10
                }
              },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });

          // Slider Modulos
          var swiperModulos = new Swiper(".slider-modulos", {
            slidesPerView: 2,
            spaceBetween: 20,
            slidesPerGroup: 2,
            centeredSlides: false,
            initialSlide : 0,
            loop: false,
            loopFillGroupWithBlank: true,
            breakpoints: {
                // when window width is >= 320px
                320: {
                  slidesPerView: 2,
                  slidesPerGroup: 1,
                  spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                  slidesPerView: 3,
                  slidesPerGroup: 3,
                  spaceBetween: 20
                },
                // when window width is >= 640px
                640: {
                  slidesPerView: 4,
                  slidesPerGroup: 4,
                  spaceBetween: 30
                }
              },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });

    });
    
}(jQuery));