<link rel="stylesheet" href="<?= $site['base_url'] ?>/assets/libs/croppie/croppie.css" />
<script src="<?= $site['base_url'] ?>/assets/libs/croppie/croppie.js"></script>

<div class="main-content h-100" id="perfil-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>

    <div class="ui centered grid h-10 pb-2">
        <div class="sixteen wide column px-6 pt-4">
            <h1>Mi Perfil</h1>
        </div>
    </div>
    <div class="ui centered grid h-20 pb-4">
        <div class="ten wide column px-6 pt-4" id="update-photo">
            <img class="ui small circular image m-auto w-50" id="avatar-image" src="<?= ($avatar ? $avatar : $site['base_url'] . "/assets/img/avatar.png") ?>">
            <div class="take-photo text-right font-size-30"><i class="camera icon"></i></div>

            
           
            <div class="upload-actions">
                    <input class="hidden" type="file" id="upload" value="Choose a file" accept="image/*" />
            </div>
        </div>
    </div>
    <div class="ui centered grid h-5 pb-0">
        <div class="sixteen wide column px-6 pt-0">
            <h3 class="text-center text-blue bg-white rounded py-1 px-4"><?= $_SESSION['user']['nombre'] ?></h3>
        </div>
    </div>
    <div class="ui centered grid h-5 pt-0 pb-4">
        <div class="fourteen wide column px-6 pt-0">
            <h4 class="text-center font-size-14 text-white bg-red rounded py-1 px-4 user-meta-grupo"><?= $_SESSION['user']['grupo'] ?></h4>
        </div>
    </div>

    <div class="ui centered grid padded h-50">
        <div class="fifteen wide column pb-6">
            <form method="POST" class="ui form unstackable" id="login-form" autocomplete="off" data-parsley-validate="">
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" value="<?= $_SESSION['user']['cedula'] ?>" name="cedula" placeholder="Número de cédula" minlength="10" maxlength="13" autocomplete="off" data-parsley-required="true" data-parsley-type="digits">
            </div>
            <div class="field">
                <div class="two fields">
                        <div class="field">
                            <input class="brd-w2 brd-color-yellow" type="text" value="<?= $_SESSION['user']['nombre'] ?>" name="nombre" placeholder="Nombre" maxlength="80" autocomplete="off" data-parsley-required="true">
                        </div>
                        <div class="field">
                            <input class="brd-w2 brd-color-yellow" type="text" value="<?= $_SESSION['user']['apellido'] ?>" name="apellido" placeholder="Apellido" maxlength="80" autocomplete="off" data-parsley-required="true">
                        </div>
                </div> 
            </div>
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" name="email" value="<?= $_SESSION['user']['email'] ?>" placeholder="Correo Electrónico" maxlength="250" autocomplete="off" data-parsley-required="true" data-parsley-type="email">
            </div>
            <div class="field">
                <input class="brd-w2 brd-color-yellow" type="text" name="celular" value="<?= $_SESSION['user']['celular'] ?>" placeholder="Número de celular" minlength="7" maxlength="13" autocomplete="off" data-parsley-required="true" data-parsley-type="digits">
            </div>
            
            <div class="ui center aligned container pb-8">
                <button class="mini ui button btn btn-bordered btn-white brd-w2 brd-color-yellow font-size-16" type="submit">Actualizar</button>
            </div>
            </form>
        </div>
    </div>

    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/" class="">VOLVER</a>
        </div>
    </div>


<div class="ui modal">
  <div class="header">Cortar Imagen</div>
  <div class="content" id="photo-edit-wrapper">
    <div id="photo-edit"></div>
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Cancelar
    </div>
    <div class="ui positive right labeled icon button upload-result">
      Actualizar Foto
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
</div>

<script>
(function($){
    
    // INICIAR QUIZ
    $( document ).ready(function(){
        $(".take-photo").click(function(){
            $("#upload").trigger("click");
            $('.ui.modal')
            .modal('show')
            ;
        });
        // $uploadCrop = $('#user-photo').croppie({
        //     enableExif: true,
        //     viewport: {
        //         width: 200,
        //         height: 200,
        //         type: 'square'
        //     },
        //     boundary: {
        //         width: 300,
        //         height: 300
        //     }
        // });

    });

}(jQuery));


function upload() {
		var $uploadCrop;

		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('#photo-edit-wrapper').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});
	            	
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}

		$uploadCrop = $('#photo-edit').croppie({
			viewport: {
				width: 150,
				height: 150,
				type: 'square'
			}
		});

		$('#upload').on('change', function () { readFile(this); });
		$('.upload-result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				// popupResult({
					// src: resp
				// });
                $.ajax({
                    url : '<?= $site['base_url'] ?>/src/ajax/',
                    method : "POST",
                    data : {
                        'fn' : 'updatePhoto',
                        'imagen' : resp,
                        'id' : <?= $id ?>
                    },
                    success : function(data){
                        if(data){
                            Swal.fire({
                                title:  "¡Foto actualizada exitosamente!",
                                icon : 'success'
                            })
                        }else{

                        }
                    }
                });
                $("#avatar-image").attr("src", resp)
			});
		});
	}



    upload();
</script>