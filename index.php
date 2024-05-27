<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <meta name="twitter:site" content="@themepixels">
  <meta name="twitter:creator" content="@themepixels">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bracket">
  <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

  <!-- Facebook -->
  <meta property="og:url" content="http://themepixels.me/bracket">
  <meta property="og:title" content="Bracket">
  <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

  <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="600">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

  <title>Certificados</title>

  <!-- vendor css -->
  <link href="./public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="./public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="./public/css/bracket.css">
</head>

<body>

  <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

    <form action="" method="POST">
      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">

        <!-- Capturando los mensajes de erro del LOGIN -->
        <?php
        if (isset($_GET["m"])) {
          switch ($_GET["m"]) {
            case "1";
        ?>
              <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-flex align-items-center justify-content-start">
                  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                  <span><strong>Well done!</strong> Successful alert message.</span>
                </div><!-- d-flex -->
              </div><!-- alert -->
            <?php
              break;
            case "2";
            ?>
              <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-flex align-items-center justify-content-start">
                  <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                  <span><strong>Well done!</strong> Successful alert message.</span>
                </div><!-- d-flex -->
              </div><!-- alert -->
        <?php
              break;
          }
        }
        ?>
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal"></span> <img src="public/img/muni.png" alt="" width="200"> <span class="tx-normal"></span></div>
        <div class="tx-center mg-b-30"></div>




        <div class="input-group">
          <span class="input-group-addon"><i class="icon ion-card tx-16 lh-0 op-6"></i></span>
          <input type="text" class="form-control" placeholder="Ingrese Dni">
        </div>
        <br>


        <div class="input-group">
          <span class="input-group-addon"><i class="icon ion-more tx-16 lh-0 op-6"></i></span>
          <input type="password" class="form-control" placeholder="Ingrese Contraseña">
        </div>

<br>
        <a href="" class="tx-info tx-12 d-block mg-t-10">Informacion sobre Nosotros</a>
        <br>
        <input type="hidden" name="enviar" class="form-control" value="si">
        <button type="submit" class="btn btn-info btn-block">Ingresar</button>


      </div><!-- login-wrapper -->
    </form>

  </div><!-- d-flex -->

  <script src="../Public/lib/jquery/jquery.js"></script>
  <script src="../Public/lib/popper.js/popper.js"></script>
  <script src="../Public//bootstrap/bootstrap.js"></script>

</body>

</html>