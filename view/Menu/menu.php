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

      </span>
    </div><!-- menu-item -->


    <?php
    if ($_SESSION["acce_rol"] != '0') { ?>

      <a href="../GestionUnidades/gestionunidades.php" class="br-menu-link ">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-list tx-20"></i>
          <span class="menu-item-label ">Gestion de Unidades</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->



      <a href="../RegistroUnidad/registrounidad.php" class="br-menu-link ">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-pencil-square tx-20"></i>
          <span class="menu-item-label ">Registro de Unidades</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->




    <?php
    } else { ?>
      <a href="../GestionUnidades/gestionunidades.php" class="br-menu-link ">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-list tx-20"></i>
          <span class="menu-item-label ">GESTION DE UNIDADES</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

     

      <a href="../AdminRegistroUnidad/adminArea.php" class="br-menu-link">
          <div class="br-menu-item">
            <i class="menu-item-icon icon fa fa-book tx-24"></i>
            <span class="menu-item-label">GESTION DE REGISTROS </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="../AdminRegistroArea/adminArea.php" class="nav-link">Adm. Dependencia</a></li>
          <li class="nav-item"><a href="../AdminRegistroTipo/adminTipo.php" class="nav-link">Adm. Tipo de Unidad</a></li>
          <li class="nav-item"><a href="../AdminiRegistroMarca/adminMarca.php" class="nav-link">Adm. Marca de  Unidad</a></li>
          <li class="nav-item"><a href="../AdminRegistroModelo/adminModelo.php" class="nav-link">Adm. Modelo de la Unidad</a></li>
          <li class="nav-item"><a href="../AdminRegistroColor/adminColor.php" class="nav-link">Adm. Colores de unidad</a></li>
          
  
          
          </ul>

    <?php
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