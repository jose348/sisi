<?php

require_once("../../config/conexion.php");
if(isset($_SESSION["usu_id"])) {


?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    require_once("../Head/MainHead.php");
    ?>
    <title>Certificados::Home</title>


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
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="../UsuHome/index.php">Inicio</a>
          <span class="breadcrumb-item active">Home</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <strong class="d-block d-sm-inline-block-force text text-primary">PRINCIPAL</strong>

     
        <!-- TABLA PARA IMPLEMENTACION CON JS  -->
        <!-- TABLA PARA IMPLEMENTACION CON JS  -->



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

}else{
  header("Location:".Conectar::ruta()."view/404/404.php");
}

?>