<div class="br-logo"><a href="../Home/home.php"><span><img src="../../public/img/muni.png" alt=""></span></a></div>
<div class="br-sideleft overflow-y-auto">
  <div>

  </div>
  <div class="br-sideleft-menu">




    <!-- SISTEMA DE GESTION DE GRIFOS -->
    <!-- SISTEMA DE GESTION DE GRIFOS -->
    <!-- SISTEMA DE GESTION DE GRIFOS -->

    <div class="br-menu-item br-menu-link">
      <i class="menu-item-icon fa fa-user tx-20"></i>
      <span class="menu-item-label text text-light">
        <?php echo $_SESSION["rol_nombre"] ?>
      </span>
    </div><!-- menu-item -->


    <?php $variable = $_SESSION["acce_rol"];
    switch ($variable) {
      case "25":
    ?>
        <a href="../GestionUnidades/gestionunidades.php" class="br-menu-link ">
          <div class="br-menu-item">
            <i class="menu-item-icon fa fa-list tx-20"></i>
            <span class="menu-item-label ">GESTION DE UNIDADES</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

      <?php break;

      case "14":
      ?>
        <a href="#" class="br-menu-link ">
          <div class="br-menu-item">
            <i class="menu-item-icon fa fa-database tx-5"></i>
            <span class="menu-item-label ">GESTION DE ALMACEN</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRepuesto/registroRepuesto.php" class="nav-link ">Registrar Repuesto</a></li>
          <li class="nav-item"><a href="../AdminRepuesto/adminRepuesto.php" class="nav-link ">Registro de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRespuestoStock/stockRepuesto.php" class="nav-link ">Stock de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRepuestoEstado/estadoRepuesto.php" class="nav-link ">Estado de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRepuestoAltasBjas/altasbajas.php" class="nav-link ">Bajas-Altas del Repuesto</a></li>
        </ul>

        <a href="#" class="br-menu-link ">
          <div class="br-menu-item">
            <i class="menu-item-icon fa fa-commenting tx-20"></i>
            <span class="menu-item-label ">GESTION DE SOCLICITUD</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminSolicitudes/solicitud.php" class="nav-link ">Recepcionar Solicitud</a></li>

        </ul>
      <?php break;
      case "9":
      ?>
        <a href="../GestionUnidades/gestionunidades.php" class="br-menu-link ">
          <div class="br-menu-item">
            <i class="menu-item-icon fa fa-list-ol tx-18"></i>
            <span class="menu-item-label ">GESTION DE UNIDADES (lista)</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->



        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-car tx-18"></i>
            <span class="menu-item-label">GESTION DE UNIDADES</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRegistroArea/area.php" class="nav-link">Adm. Dependencia</a></li>
          <li class="nav-item"><a href="../AdminRegistroTipo/adminTipo.php" class="nav-link">Adm. Tipo de Unidad</a></li>
          <li class="nav-item"><a href="../AdminiRegistroMarca/adminMarca.php" class="nav-link">Adm. Marca de Unidad</a></li>
          <li class="nav-item"><a href="../AdminRegistroModelo/adminModelo.php" class="nav-link">Adm. Modelo de la Unidad</a></li>
          <li class="nav-item"><a href="../AdminRegistroColor/adminColor.php" class="nav-link">Adm. Colores de unidad</a></li>
        </ul>

        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-database tx-18"></i>
            <span class="menu-item-label">GESTION DE ALMACEN </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRepuesto/registroRepuesto.php" class="nav-link ">Adm. Registrar Repuesto</a></li>
          <li class="nav-item"><a href="../AdminRepuesto/adminRepuesto.php" class="nav-link ">Adm. Registro de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRespuestoStock/stockRepuesto.php" class="nav-link ">Adm. Stock de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRepuestoEstado/estadoRepuesto.php" class="nav-link ">Adm. Estado de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRepuestoAltasBjas/altasbajas.php" class="nav-link ">Bajas-Altas del Repuesto</a></li>
          <li class="nav-item"><a href="../AdminRepuesto/UnidadMedida.php" class="nav-link "> Unidad Medidad-Repuesto</a></li>

        </ul>

        <a href="#" class="br-menu-link ">
          <div class="br-menu-item">
            <i class="menu-item-icon fa fa-commenting tx-18"></i>
            <span class="menu-item-label ">GESTION DE SOCLICITUD</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminSolicitudes/solicitud.php" class="nav-link ">Adm. Recepcionar Solicitud</a></li>

        </ul>


        
        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-users tx-18"></i>
            <span class="menu-item-label">GESTION DE PERSONAL </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminGestionPersonal/adminPersonal.php" class="nav-link ">Adm. Personal</a></li>
        </ul>


        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-map-marker tx-18"></i>
            <span class="menu-item-label">GESTION DE RUTAS </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          
          <li class="nav-item"><a href="../AdminGestionRutas/CrearRuta.php" class="nav-link ">Crear Rutas</a></li>
          <li class="nav-item"><a href="" class="nav-link ">Rutas Disponibles</a></li>
          <li class="nav-item"><a href=" " class="nav-link ">Choferes Disponibles</a></li>
          <li class="nav-item"><a href=" " class="nav-link ">Verifica Ruta-Chofer-Unidad</a></li>
          <li class="nav-item"><a href="../AdminGestionRutas/asignacion.php" class="nav-link ">Asigna Ruta-Chofer-Unidad</a></li>
          <li class="nav-item"><a href=" " class="nav-link ">Manteniminto de Unidad</a></li>
        </ul>

        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-wrench tx-18"></i>
            <span class="menu-item-label">INTERNAMIENTO</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../Internado/" class="nav-link ">Movil</a></li>
          <li class="nav-item"><a href="../Internado/mecanico.php" class="nav-link ">Mecanico/Mantenimiento</a></li>
        <li class="nav-item"><a href="../Internado/Directorio.php" class="nav-link ">Directorio</a></li>
        <li class="nav-item"><a href="../Internado/bitacoraInternado.php" class="nav-link ">Bitacora</a></li>
          
        </ul>


    <?php
        break;
    } 

    ?>




    <a href="../Logout/logout.php" class="br-menu-link">
      <div class="br-menu-item">
        <i class=" icon icon ion-power tx-20"></i>
        <span class="menu-item-label">Cerrar Session</span>
      </div><!-- menu-item -->
    </a><!-- br-menu-link -->

  </div><!-- br-sideleft-menu -->

  <br>
</div><!-- br-sideleft -->