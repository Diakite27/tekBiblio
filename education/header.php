<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TekBiblio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="freehtml5.co" />
    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
    <!-- chargement des liens css pour le dataTable -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css">

    <!-- Pricing -->
    <link rel="stylesheet" href="css/pricing.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <style>
			.fh5co-nav li {
				display: inline-block;
				margin-right: 20px;
				padding: 10px;
				font-size: 18px;
				font-weight: bold;
				color: red;
				text-transform: uppercase;
				text-decoration: none;
				border-bottom: 2px solid transparent;
			  }
			  
			  .fh5co-nav li:hover {
				border-bottom: 2px solid #333;
				color: #333;
			  }
			  .fh5co-nav ul li.active a {
				font-weight: bold;
			  }  
	</style>

</head>

<body>

    <div class="fh5co-loader"></div>

    <div id="page">

<nav class="fh5co-nav" role="navigation">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <p class="site">www.tekup.tn</p>
                            <p class="num">Tel: +216 52083322</p>
                            <ul class="fh5co-social">
                                <li><a href="#"><i class="icon-facebook2"></i></a></li>
                                <li><a href="#"><i class="icon-twitter2"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble2"></i></a></li>
                                <li><a href="#"><i class="icon-github"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2">
                            <div id="fh5co-logo"><a href="index.php"><i class="icon-book"></i>TekBiblio<span>.</span></a></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li class="active"><a href="index.php">Accueil</a></li>
                                <li><a href="livres.php">Livres</a></li>
                                <li><a href="<?php if(isset($_SESSION['idE'])){echo 'emprunts.php';} else{echo 'login.php';} ?>">Mes emprunts</a></li>
                                <li><a href="auteurs.php">Auteurs</a></li>
                                <li><a href="a-propos.html">À propos</a></li>
                                <li><a href="tarification.html">Tarification</a></li>
                                <li class="has-dropdown">
                                    <a href="blog.html">Blog</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Conseils de lecture</a></li>
                                        <li><a href="#">Critiques de livres</a></li>
                                        <li><a href="#">Entretiens avec des auteurs</a></li>
                                        <li><a href="#">Événements de la bibliothèque</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.php">Contact</a></li>
                                <li class="btn-cta">
                                    <?php if(isset($_SESSION['idE'])) {
                                        echo '<a href="logout.php"><span>Se déconnecter</span></a>';
                                    } else{
                                        echo '<a href="login.php"><span>Se connecter</span></a>';
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </nav>