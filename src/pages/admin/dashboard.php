<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<div class="nav-menu" id="nav-menu">
    <ul>
        <li class="nav-links"><a href="<?= $site['base_url'] ?>/" class="">Inicio</a></li>
        <li class="nav-links"><a href="<?= $site['base_url'] ?>/admin/puntaje/" class="">Reiniciar Intentos</a></li>
        <li class="nav-links"><a href="<?= $site['base_url'] ?>/admin/logout/" class="">Salir</a></li>
    </ul>
    <div class="close-nav"><i class="window close icon"></i></div>
</div>-->
<style>
th, td{
  font-size:12px;
}
.stats .stat {
    padding: 13px;
    font-size: 3em;
    text-align: center;
    color: #676767;
}
a {
    cursor: pointer;
}
</style>
<div class="main-content h-100" id="dashboard-page">

    <div class="ui centered grid padded h-45" id="header">
        <div class="sixteen wide column">
            <div id="mobile-menu"><i class="fa-solid fa-bars color-white" style="color:#fff;"></i></div>
            <img class="ui fluid image universidad-logo" style="max-width:100px; margin:0px auto;" src="<?= $site['base_url'] ?>/assets/img/login/logouniversidad.png" alt="">
            <h1 class="color-white" style="text-align:center; color:#fff;">Dashboard</h1>
        </div>
    </div>
    <div class="ui centered grid padded h-45" style="margin-top:40px !important;">
        <div class="sixteen wide mobile sixteen wide tablet twelve wide computer column">
            
            <div class="ui centered grid padded h-45" style="margin-top:40px !important;">
                <div class="sixteen wide mobile sixteen wide tablet twelve wide computer column stats">
                    <h2>Búsqueda por cédula</h2>
                    <div class="stat">
                    <div class="field">
                        <input class="brd-w2 brd-color-yellow" type="text" name="cedula" id="cedula" placeholder="Cédula" autocomplete="off">
                    </div>
                    <div class="field">
                        <a class="btn" id="buscar">Buscar</a>
                    </div>
                    <div id="resultado">
                        
                    </div>
                    </div>
                </div>
            </div>
            

</div>
<script>
var toggle = "text";

(function($){
    
    // LOGIN FUNCTIONS
    $( document ).ready(function(){

        $("#mobile-menu").click(function(){
            
            jQuery("#revealed").attr("type", toggle);
            if(toggle == "text"){ toggle = "password"; return null}
            if(toggle == "password"){ toggle = "text"; return null}

        });
        
        $("#buscar").click(function(e){
            
            const data = {
                  fn : 'getUser',
                  cedula : document.getElementById('cedula').value
              };
            
            fetch("/admin/ajax/",{
                method : "POST",
                body : JSON.stringify(data)
            })
            .then((data) => data.json())
            .then((data) => {
                console.log(data);
                const content =  document.createElement('div');
                content.classList.add('mt-2');
                let html = `
                    <h1 class="ui header">Datos del usuario</h1>
                    <div class="ui two column stackable grid">
                      <div class="column">
                        <div class="ui segment">ID: ${data.result.user.id}</div>
                      </div>
                      <div class="column">
                        <div class="ui segment">Cédula: ${data.result.user.cedula}</div>
                      </div>
                      <div class="three column row">
                        <div class="column">
                          <div class="ui segment">Nombre: ${data.result.user.nombre}</div>
                        </div>
                        <div class="column">
                          <div class="ui segment">Apellido: ${data.result.user.apellido}</div>
                        </div>
                        <div class="column">
                          <div class="ui segment">Celular: ${data.result.user.celular}</div>
                        </div>
                      </div>
                      <div class="ten wide column">
                        <div class="ui segment">Grupo: ${data.result.user.grupo}</div>
                      </div>
                      <div class="six wide column">
                        <div class="ui segment">Cargo: ${data.result.user.cargo}</div>
                      </div>
                    </div>`;
                    
                    
                html += `<h1 class="ui header">Intentos</h1>`;
                    
                if(Object.keys(data.result.intentos).length > 0){
                    html += `<table class="ui celled table unstackable">
                      <thead>
                        <tr><th>Módulo</th>
                        <th>Intentos</th>
                        <th>Tipo</th>
                      </tr></thead>
                      <tbody>
                    ${Object.keys(data.result.intentos).map(function (key) {
                        return '<tr>' + 
                            '<td data-label="Módulo">' + data.result.intentos[key].modulo_id + "</td>" +
                            '<td data-label="Intentos"><span class="label-for-intentos" data-id="'  + data.result.intentos[key].id +  '">' + data.result.intentos[key].intentos + "</span><div class='mini ui right floated button primary restablecer-intentos' data-id='" + data.result.intentos[key].id + "'>Restablecer</div>" + "</td>" +
                            '<td data-label="Tipo">' + data.result.intentos[key].tipo + "</td>" +
                        "</tr>"           
                    }).join("")}`;
                }
                    
                html += `<h1 class="ui header">Puntaje</h1>`;
                
                
                if(Object.keys(data.result.puntaje).length > 0){
                    html += `<table class="ui celled table unstackable mb-12">
                      <thead>
                        <tr><th>Módulo</th>
                        <th>Puntaje</th>
                        <th>Tipo</th>
                        <th>Tiempo</th>
                        <th>Fecha</th>
                      </tr></thead>
                      <tbody>
                    ${Object.keys(data.result.puntaje).map(function (key) {
                        return '<tr>' + 
                            '<td data-label="Módulo">' + data.result.puntaje[key].modulo_id + "</td>" +
                            '<td data-label="Intentos">' + data.result.puntaje[key].puntaje + "</td>" +
                            '<td data-label="Tipo">' + data.result.puntaje[key].tipo + "</td>" +
                            '<td data-label="Tiempo">' + data.result.puntaje[key].tiempo + "</td>" +
                            '<td data-label="Tipo">' + data.result.puntaje[key].fecha_registro + "</td>" +
                        "</tr>"           
                    }).join("")}
                      </tbody>
                    </table>
                    `;
                }
                
                content.innerHTML = html;
                
                document.getElementById('resultado').innerHTML = '';
                document.getElementById('resultado').appendChild(content);
            }
            );
            
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
    
    
    $(document).on("click", ".restablecer-intentos", async function(){
        const id = await $(this).data("id");
        console.log(`ID: ${id}`);
        
        Swal.fire({
          title: 'Restablecer intentos',
          input: 'select',
          inputOptions: {
            0 : "0",
            1 : "1",
            2 : "2",
            3 : "3"
          },
          inputPlaceholder: 'Seleccione un número',
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Restablecer',
          showLoaderOnConfirm: true,
          preConfirm: async () => {
            const intentos = await jQuery(document).find(".swal2-select").val();
            const data = {
                'fn' : 'updateIntentos',
                'id' : id,
                'intentos' : intentos
            }
            return fetch(`/admin/ajax/`,{
                method : "POST",
                body : JSON.stringify(data)
            })
              .then(response => {
                return response.json()
              })
              .catch(error => {
                Swal.showValidationMessage(
                  `Request failed: ${error}`
                )
              })
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.isConfirmed) {
            const intentos = parseInt(jQuery(document).find(".swal2-select").val());
            
            if(result.value.result == true){
                console.log(`%c TRUE `, "background: green; color: #fff");
                if(parseInt(intentos) >= 0){
                    $(`.label-for-intentos[data-id="${id}"]`).text(intentos);
                }
                Swal.fire({
                  title: `Operación exitosa`,
                  icon: 'success',
                  text: `Los intentos han sido reestablecidos.`
                })
            }
            if(result.value.result != true){
                console.log(`%c FALSE `, "background: red; color: #fff");
                Swal.fire({
                  title: `Error de actualización`,
                  icon: 'error',
                  text: `Por favor vuelva a intentarlo.`
                })
            }
          }
        })
    });

}(jQuery));

</script>