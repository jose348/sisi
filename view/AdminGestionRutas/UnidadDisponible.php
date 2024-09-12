<?php

require_once("../../config/conexion.php");
if (isset($_SESSION["id"])) { //para validar si cerre session y no abrir el url copiado antes que ingrese 
  //por url------esta linea 
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    require_once("../Head/MainHead.php");
    ?>
    <title>ADMIN::Unidades</title>


  </head>

  <body>

    <?php
    require_once("../Menu/menu.php");

    ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <?php
    require_once("../Header/MainHeader.php");

    ?>
    <!-- ########## END: HEAD PANEL ########## -->


    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">

        <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
        <span class="breadcrumb-item active">Registro</span>

      </div><!-- br-pageheader -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">

          <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
            <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-30">UNIDADES DISPONIBLES</h6>
            <div class="media-list">
              <div class="media align-items-center pd-b-10">
                <img src="http://via.placeholder.com/280x280" class="wd-45 rounded-circle" alt="">
                <div class="media-body mg-x-15 mg-xs-x-20">
                  <h6 class="mg-b-2 tx-inverse tx-14">Marilyn Tarter</h6>
                  <p class="mg-b-0 tx-12">@marilyntarter</p>
                </div><!-- media-body -->
                <a href="#" class="btn btn-outline-secondary btn-icon rounded-circle mg-r-5">
                  <div><i class="fa fa-car add tx-16"></i></div>
                </a>
              </div><!-- media -->



            </div><!-- media-list -->
          </div><!-- card -->

        </div>
      </div>




    </div>

    <?php

    require_once("../Js/MainJs.php");
    require_once("AdminTipoModal.php");


    ?>
    <script type="text/javascript" src="adminTipo.js"></script>
  </body>

  </html>
<?php

} else {

  /* sino a iniciado session entonces lo redireccionara a la ruta principal */
  //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
  header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>