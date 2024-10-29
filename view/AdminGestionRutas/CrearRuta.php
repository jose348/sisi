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
    <link rel="stylesheet" type="text/css" href="UnidadDisponible.css">
    <title>ADMIN::Rutas</title>

    <!-- CSS de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
      /* Estilo global */
      body,
      html {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f4f6f9;
      }

      .container {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
        padding: 15px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        background-color: white;
      }

      .form-container {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
      }

      input,
      select,
      button,
      textarea {
        padding: 10px;
        font-size: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: all 0.3s ease;
      }

      input:focus,
      select:focus,
      textarea:focus {
        border-color: #5a9;
        box-shadow: 0 0 5px rgba(85, 190, 90, 0.5);
      }



      textarea {
        width: 100%;
        height: 100px;
        resize: none;
      }

      #map {
        height: 70vh;
        width: 100%;
        border-radius: 12px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      }
    </style>



  </head>

  <body>

    <?php
    require_once("../Menu/menu.php");

    ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <?php
    require_once("../Header/MainHeader.php");

    ?>


    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">

        <a class="breadcrumb-item" href="../Home/home.php">Inicio</a>
        <span class="breadcrumb-item active">Registro</span>

      </div><!-- br-pageheader -->

      <div class="br-pagebody">
        <div class="br-section-wrapper">





          <!-- Contenedor principal -->
          <div class="row">
            <!-- Formulario -->
            <div class="container mt-4">
              <div class="row align-items-center">

                <!-- Nombre de la Ruta -->
                <div class="col-4">
                  <input class="form-control" type="text" id="nombreRuta" placeholder="Nombre de la Ruta">
                </div>

                <!-- Selector de Horario con Select2 -->
                <div class="col-4">
                  <select id="horarioSelect" class="form-control">
                    <option value="">Seleccione un horario</option>
                  </select>
                </div>

                <!-- Botón de Guardar -->
                <div class="col-2">
                  <button class="btn btn-outline-success w-100" onclick="guardarRuta()">Guardar Ruta</button>
                </div>

              </div>
            </div>





            <!-- Textarea para mostrar las coordenadas seleccionadas -->
            <textarea id="ubicacionesSeleccionadas" placeholder="Aquí se mostrarán las calles o coordenadas seleccionadas..." readonly></textarea>


          </div>
          <br>
          <div id="map"></div>







          <!-- JS de Leaflet -->
          <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>



        </div>
      </div>
    </div>

    <?php

    require_once("../Js/MainJs.php");

    ?>



    <script type="text/javascript" src="CrearRuta.js"></script>

  </body>

  </html>
<?php

} else {

  /* sino a iniciado session entonces lo redireccionara a la ruta principal */
  //header("Location:".Conectar::ruta()."index.php"); //para validar si cerre session y no abrir el url copiado antes que ingrese 
  header("Location:" . Conectar::ruta() . "View/404"); //por url------esta linea********ojo puede llamar al 404
}

?>