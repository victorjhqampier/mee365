<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Inicio de sesión</title>
  <link href="public/resources/css/login.boostrap4.min.css" rel="stylesheet" id="bootstrap-css">
<script defer src="public/resources/js/login.boostrap4.min.js"></script>
<!--<link rel="shortcut icon" href="<?php echo base_url('arixmee/img/arixmee.ico');?>">-->
<script src="public/resources/js/login.arixcore.js"></script>
<script src="public/resources/js/jquery.validate.min.js"></script>
<script src="public/resources/js/localization/messages_es_PE.js"></script>
<script src="public/resources/js/jquery.cryptojs.min.js"></script>
</head>
<body>
<style type="text/css">
    body {
    padding-top: 15px;
    font-size: 12px
    margin-bottom: 15px;
    background-color: grey;
  }
  .main {
    max-width: 320px;
    margin: 0 auto;
  }
  .login-or {
    position: relative;
    font-size: 18px;
    color: #aaa;
    margin-top: 10px;
            margin-bottom: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .span-or {
    display: block;
    position: absolute;
    left: 50%;
    top: -2px;
    margin-left: -25px;
    background-color: #fff;
    width: 50px;
    text-align: center;
  }
  .hr-or {
    background-color: #cdcdcd;
    height: 1px;
    margin-top: 0px !important;
    margin-bottom: 0px !important;
  }
  h3 {
    text-align: center;
    line-height: 300%;
  }
  footer{
      margin: 15px;
  }
</style>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-md-4">
                  <h6 class="text-muted text-center">MUNICIPALIDAD PROVINCIAL DE PUNO</h6>
                  <hr>
                  <div class="row">
                        <div class="col-xs-6 col-sm-12 col-md-12 text-center">                          
                          <img class="img-thumbnail" src="public/images/puno.jpg" width="105px">
                        </div>
                  </div>
                  <hr>
                  <form role="form" id="formuserloginarixmee">
                     <div class="form-group">
                        <label for="inputUsernameEmail" class="label">Usuario</label>
                        <input type="text" class="form-control" name="txtinputUsernameEmail" id="inputUsernameEmail" placeholder="Email ...">
                     </div>
                     <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" name="txtinputPassword" id="inputPassword" placeholder="Contraseña">
                     </div>
                  </form>
                  <div class="alert alert-danger" role="alert" style="display: none;"></div>
                  <button class="btn btn btn-info btn-sm" id="btnformuserloginarixmee">Iniciar Sesión</button>                  
               </div>
               <div class="col-md-8">
                  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item">
                        <img src="public/images/one.jpg" alt="Primero">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>Biblioteca Municipal Gamaliel Churata</h5>
                          <p>Arix mee - Todos los derechos reservados</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="public/images/one.jpg" alt="Primero">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>Biblioteca Municipal Gamaliel Churata</h5>
                          <p>Arix mee - Todos los derechos reservados</p>
                        </div>
                      </div>
                      <div class="carousel-item active">
                        <img src="public/images/two.jpg" alt="Primero">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>Biblioteca Municipal Gamaliel Churata</h5>
                          <p>Arix mee - Todos los derechos reservados</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="public/images/three.jpg" alt="Primero">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>Biblioteca Municipal Gamaliel Churata</h5>
                          <p>Arix mee - Todos los derechos reservados</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="public/images/four.jpg" alt="Primero">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>Biblioteca Municipal Gamaliel Churata</h5>
                          <p>Arix mee - Todos los derechos reservados</p>
                        </div>
                      </div>
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $("#formuserloginarixmee").validate({
    errorClass: "text-danger",
    rules: {
      txtinputUsernameEmail: {
        required: !0,
        email: !0
      },
      txtinputPassword: {
        required: !0,
        maxlength: 32,
        minlength: 7
      }
    }
  })
});
$(document).keypress(function (a) {
  13 == a.which && $("#btnformuserloginarixmee").click()
});

$("#btnformuserloginarixmee").click(function () {
  return !!$("#formuserloginarixmee").valid() && void $.ajax({
    type: "POST",
    url: "arixapi/arixapi_iniciar_sesion",
    async: !0,
    dataType: "json",
    data: {
      user: $("#inputUsernameEmail").val(),
      pass: $.md5($("#inputPassword").val()).substring(3, 29)
    },
    success: function (a) {
    	if (a.status == true) {
    		$("#formuserloginarixmee")[0].reset();
    		window.location.replace('inicio');
    	}else{
    		$("#formuserloginarixmee")[0].reset(), $(".alert-danger").html('El servidor a rechazado su petición').fadeIn().delay(4e3).fadeOut("slow");
    	}
    },
    error: function () {
      //window.location.replace('inicio');
      //console.log(window.location.href);
      console.log('Arix MEE dice: Error del servidor');
    }
  })
});


</script>
</body>
</html>