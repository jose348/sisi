<?php

require_once("../../config/conexion.php");
if (isset($_SESSION["id"])) { 
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    require_once("../Head/MainHead.php");
    ?>
    <title>SISE::MPCH</title>


  </head>

  <body>

    <?php
       require_once("../Header/MainHeader.php");
   

    ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <?php 
    require_once("../Menu/menu.php");
    ?>
    <!-- ########## END: HEAD PANEL ########## -->


    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">

        <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
        <span class="breadcrumb-item active">Home</span>

      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">

        <section class="card">
          <header class="card-header">
            <strong class="d-block d-sm-inline-block-force text text-primary">Bienvenido</strong>
          </header>
          <br>
          <br>
          <div class="ht-80v   align-items-center justify-content-center">
            <div class="wd-lg-70p wd-xl-p tx-right pd-x-50">
              <h1 class="tx-80 tx-xs-50 tx-normal tx-inverse tx-roboto ">Sistema de Servicios Internos.!</h1>
              <h3 class="tx-xs-25  tx-normal tx-info mg-b-30 lh-5"><?php echo strtoupper($_SESSION["acce_nombre"] . " " . $_SESSION["acce_apellidos"]) ; ?></h3>
              <p class="tx-20 mg-b-30"><?php   echo $_SESSION["acce_dni"];  ?></p>

              <div class="d-flex justify-content-right">




                  <a href="../Logout/logout.php"><button type="" class="btn btn-outline-danger ">Regresar al Inicio de Session..!</button></a>
                  <br>
                  <br>
                  <!-- input-group-btn -->
                
                <!-- input-group -->
              </div>
              <br>
              <!-- d-flex -->
            </div>
          </div>

        </section>



      </div>
    </div>








    <!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <?php

    require_once("../Js/MainJs.php");

    ?>
    <script type="text/javascript" src="usuhome.js"></script>

  </body>

  </html>
<?php

} else {
  header("Location:" . Conectar::ruta() . "view/404/404.php");
} 

?>