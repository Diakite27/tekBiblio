<?php
    require "database.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Connexion </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="admin/assets/img/favico.png" rel="icon">
  <link href="admin/assets/img/apple-touch-ico.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 
  <!-- Template Main CSS File -->
  <link href="admin/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
                <i class="bi bi-book"></i>
                <span class="d-none d-lg-block">TekBiblio</span>
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Connectez-vous à votre compte</h5>
                <p class="text-center small">Entrez votre nom d'utilisateur et votre mot de passe pour vous connecter</p>
              </div>

              <form class="row g-3 needs-validation" method="post" action="">

                <div class="col-12">
                  <label for="yourUsername" class="form-label">Nom d'utilisateur</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="email" name="username" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Veuillez entrer votre nom d'utilisateur.</div>
                  </div>
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Mot de passe</label>
                  <input type="password" name="password" class="form-control" id="yourPassword" required>
                  <div class="invalid-feedback">Veuillez entrer votre mot de passe!</div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit" name="envoyer">Se connecter</button>
                </div>
                <div class="col-12">
                  <p class="small mb-0">Vous n'avez pas de compte ? <a href="pages-register.html">Créer un compte</a></p>
                </div>
                <?php
                    if (isset($_POST['envoyer'])) {
                            $email = $_POST['username'];
                            $password = $_POST['password'];
                            $table = "eleve";
                            $condition = "email = '$email' and mot_de_passe_eleve = '$password'";
                            $data = $bd->lire($table, "*", $condition);
                            if (!$data)
                            {
                            echo '<span style="color:red; text-align: center; background-color: black; font-weight: bold; font-size: 15px; margin-left: ">Mauvais email ou mot de passe !</span>';
                            }
                            else
                            {
                            $_SESSION['idE'] = $data[0]['id_eleve'];
                            $_SESSION['nomE'] = $data[0]['nom'];
                            $_SESSION['prenomE'] = $data[0]['prenom'];
                            header('location: index.php');
                            }
                    }
                ?>
              </form>

            </div>
          </div>

          <div class="credits">
            <!-- Conçu par <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
          </div>

        </div>
      </div>
    </div>

  </section>

    </div>
  </main><!-- End #main -->

</body>

</html>