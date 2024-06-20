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
            <i class="menu-item-icon fa fa-database tx-20"></i>
            <span class="menu-item-label ">GESTION DE ALMACEN</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRepuesto/registroRepuesto.php" class="nav-link ">Adm. Registrar Repuesto</a></li>
          <li class="nav-item"><a href="../AdminRepuesto/adminRepuesto.php" class="nav-link ">Adm. Repuesto</a></li>
        </ul>
      <?php break;
      case "9":
      ?>
        <a href="../GestionUnidades/gestionunidades.php" class="br-menu-link ">
          <div class="br-menu-item">
            <i class="menu-item-icon fa fa-list-ol tx-20"></i>
            <span class="menu-item-label ">GESTION DE UNIDADES (lista)</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->



        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-car tx-24"></i>
            <span class="menu-item-label">GESTION DE UNIDADES</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRegistroArea/adminArea.php" class="nav-link">Adm. Dependencia</a></li>
          <li class="nav-item"><a href="../AdminRegistroTipo/adminTipo.php" class="nav-link">Adm. Tipo de Unidad</a></li>
          <li class="nav-item"><a href="../AdminiRegistroMarca/adminMarca.php" class="nav-link">Adm. Marca de Unidad</a></li>
          <li class="nav-item"><a href="../AdminRegistroModelo/adminModelo.php" class="nav-link">Adm. Modelo de la Unidad</a></li>
          <li class="nav-item"><a href="../AdminRegistroColor/adminColor.php" class="nav-link">Adm. Colores de unidad</a></li>
        </ul>

        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-database tx-24"></i>
            <span class="menu-item-label">GESTION DE ALMACEN </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRepuesto/registroRepuesto.php" class="nav-link ">Adm. Registrar Repuesto</a></li>
          <li class="nav-item"><a href="../AdminRepuesto/adminRepuesto.php" class="nav-link ">Adm. Registro de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRespuestoStock/stockRepuesto.php" class="nav-link ">Adm. Stock de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRepuestoEstado/estadoRepuesto.php" class="nav-link ">Adm. Estado de Repuestos</a></li>
          <li class="nav-item"><a href="../AdminRepuesto/UnidadMedida.php" class="nav-link ">Adm. Unidad Medidad</a></li>
     
        </ul>
  


        <a href="#" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-map-marker tx-24"></i>
            <span class="menu-item-label">GESTION DE RUTAS </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../PoligonoMaps/poligonoMaps.php" class="nav-link ">Adm. Rutas</a></li>
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