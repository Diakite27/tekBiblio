<?php
    require "database.php";
    if(isset($_SESSION['idE'])){
        $id=$_SESSION['idE'];
        $condition = "id_eleve = $id";
        $livres = $bd->lire("emprunt
        INNER JOIN livre ON emprunt.id_livre = livre.id_livre WHERE $condition
        ORDER BY emprunt.id DESC;
        ", "id, livre.titre, date_emprunt, date_retour_prevue,
        CASE 
            WHEN date_retour <= date_retour_prevue THEN '<span style=\"color: green\">Déposé</span>' 
            WHEN date_retour_prevue < NOW() THEN '<span style=\"color: red\"> Non Déposé</span>' 
            ELSE '<span style=\"color: blue\">En cours</span>' 
        END AS statut
        ");
    }
    
    
    if(isset($_POST['envoyer'])){

        $id_livre = $_POST['id_livre'];
        $etu = $_SESSION['idE'];
        $date_emprunt = $_POST['date_emprunt'];
        $date_retour_prevue = $_POST['date_retour_prevue'];
        
        // Vérification des champs obligatoires
        if(empty($date_emprunt) || empty($date_retour_prevue)){
            echo "Veuillez remplir tous les champs obligatoires.";
        }
        else{
            // Insertion de l'emprunt dans la base de données
            $datas = array(
                'id_livre' => $id_livre,
                "id_eleve" => $etu,
                'date_emprunt' => $date_emprunt,
                'date_retour_prevue' => $date_retour_prevue
            );
            $bd->inserer("emprunt", $datas);
            
            echo "<script>alert('Votre emprunt a été effectué avec succès.');</script>";
        }
    }

?>

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

        <?php
            require 'header.php';
        ?>

        <div class="container">
        <h2 class="text-center" style="margin-top: 2cm">Mes livres empruntés</h2>
        <!-- Tableau contenant la liste de tous les livres stockés dans la bdd  -->
            <table id="example" class="table table-striped table-bordered compact nowrap container-fluid" style="width:100%;">
            <thead>
                <tr>
                    <th>Livre</th>
                    <th>Date emprunt</th>
                    <th>Date retour</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($_SESSION['idE'])): ?>
                <?php foreach($livres as $livre): ?>
                <tr>
                    <td><?php echo $livre['titre']; ?></td>
                    <td><?php echo $livre['date_emprunt']; ?></td>
                    <td><?php echo $livre['date_retour_prevue']; ?></td>
                    <td><?php echo $livre['statut']; ?></td>
                    <td>
                        <a href="fiche_emprunt.php" class="detail" title="Imprimer fiche emprunt" data-toggle="modal" data-target="#detail" data-id="<?php echo $livre['id']; ?>" id="emprunt-link" style="margin-left: 12px;">
                            <img src="https://img.icons8.com/fluency/20/null/print.png"/>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <?php echo "<script>alert('Veuillez vous connecter pour pouvoir voir vos emprunts.');</script>"; 
                    // exit();
                    ?>
                <?php endif; ?>
            </tbody>
        <!-- Fin des contenus -->
    </table>
    <form action="fiche_emprunt.php" method="POST">
        <input type="hidden" name="empruntId" id="empruntIdInput">
        <!-- Other form fields -->
        <button type="submit"></button>
    </form>
    </div>

    <!-- include les liens vers les fichiers JS nécessaires, y compris jQuery et DataTables -->
    

    <?php
        require 'footer.php';
    ?>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script>
        document.getElementById('emprunt-link').addEventListener('click', function(event) {
            event.preventDefault();
            var empruntId = this.getAttribute('data-id');
            document.getElementById('empruntIdInput').value = empruntId;
            document.querySelector('form').submit();
        });
</script>
    <script>
      $(document).ready(function() {
    $('#example').DataTable({
      //indication du nombre d'éléments à afficher par page dans le tableau
      pagingType: "simple_numbers",
      lengthMenu:[5,10,15,20,25],
      //Le tableau de données est par défaut en anglais, ce script permet de changer la langue en français
      language: {
             "emptyTable": "Aucune donnée disponible dans le tableau",
    "lengthMenu": "Afficher _MENU_ éléments",
    "loadingRecords": "Chargement...",
    "processing": "Traitement...",
    "zeroRecords": "Aucun élément correspondant trouvé",
    "paginate": {
        "first": "Premier",
        "last": "Dernier",
        "previous": "Précédent",
        "next": "Suiv"
    },
    "aria": {
        "sortAscending": ": activer pour trier la colonne par ordre croissant",
        "sortDescending": ": activer pour trier la colonne par ordre décroissant"
    },
    "select": {
        "rows": {
            "_": "%d lignes sélectionnées",
            "0": "Aucune ligne sélectionnée",
            "1": "1 ligne sélectionnée"
        },
        "1": "1 ligne selectionnée",
        "_": "%d lignes selectionnées",
        "cells": {
            "1": "1 cellule sélectionnée",
            "_": "%d cellules sélectionnées"
        },
        "columns": {
            "1": "1 colonne sélectionnée",
            "_": "%d colonnes sélectionnées"
        }
    },
    "autoFill": {
        "cancel": "Annuler",
        "fill": "Remplir toutes les cellules avec <i>%d<\/i>",
        "fillHorizontal": "Remplir les cellules horizontalement",
        "fillVertical": "Remplir les cellules verticalement",
        "info": "Exemple de remplissage automatique"
    },
    "searchBuilder": {
        "conditions": {
            "date": {
                "after": "Après le",
                "before": "Avant le",
                "between": "Entre",
                "empty": "Vide",
                "equals": "Egal à",
                "not": "Différent de",
                "notBetween": "Pas entre",
                "notEmpty": "Non vide"
            },
            "number": {
                "between": "Entre",
                "empty": "Vide",
                "equals": "Egal à",
                "gt": "Supérieur à",
                "gte": "Supérieur ou égal à",
                "lt": "Inférieur à",
                "lte": "Inférieur ou égal à",
                "not": "Différent de",
                "notBetween": "Pas entre",
                "notEmpty": "Non vide"
            },
            "string": {
                "contains": "Contient",
                "empty": "Vide",
                "endsWith": "Se termine par",
                "equals": "Egal à",
                "not": "Différent de",
                "notEmpty": "Non vide",
                "startsWith": "Commence par"
            },
            "array": {
                "equals": "Egal à",
                "empty": "Vide",
                "contains": "Contient",
                "not": "Différent de",
                "notEmpty": "Non vide",
                "without": "Sans"
            }
        },
        "add": "Ajouter une condition",
        "button": {
            "0": "Recherche avancée",
            "_": "Recherche avancée (%d)"
        },
        "clearAll": "Effacer tout",
        "condition": "Condition",
        "data": "Donnée",
        "deleteTitle": "Supprimer la règle de filtrage",
        "logicAnd": "Et",
        "logicOr": "Ou",
        "title": {
            "0": "Recherche avancée",
            "_": "Recherche avancée (%d)"
        },
        "value": "Valeur"
    },
    "searchPanes": {
        "clearMessage": "Effacer tout",
        "count": "{total}",
        "title": "Filtres actifs - %d",
        "collapse": {
            "0": "Volet de recherche",
            "_": "Volet de recherche (%d)"
        },
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Pas de volet de recherche",
        "loadMessage": "Chargement du volet de recherche..."
    },
    "buttons": {
        "copyKeys": "Appuyer sur ctrl ou u2318 + C pour copier les données du tableau dans votre presse-papier.",
        "collection": "Collection",
        "colvis": "Visibilité colonnes",
        "colvisRestore": "Rétablir visibilité",
        "copy": "Copier",
        "copySuccess": {
            "1": "1 ligne copiée dans le presse-papier",
            "_": "%ds lignes copiées dans le presse-papier"
        },
        "copyTitle": "Copier dans le presse-papier",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Afficher toutes les lignes",
            "1": "Afficher 1 ligne",
            "_": "Afficher %d lignes"
        },
        "pdf": "PDF",
        "print": "Imprimer"
    },
    "decimal": ",",
    "info": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
    "infoEmpty": "Affichage de 0 à 0 sur 0 éléments",
    "infoFiltered": "(filtrés de _MAX_ éléments au total)",
    "infoThousands": ".",
    "search": "Rechercher:",
    "searchPlaceholder": "Rechercher un livre",
    "thousands": ".",
    "datetime": {
        "previous": "précédent",
        "next": "suivant",
        "hours": "heures",
        "minutes": "minutes",
        "seconds": "secondes"
    }
        }
      });
} );
    </script>
    
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <!-- <script src="js/jquery.stellar.min.js"></script> -->
    <!-- Carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Flexslider -->
    <script src="js/jquery.flexslider-min.js"></script>
    <!-- countTo -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Count Down -->
    <script src="js/simplyCountdown.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>

</body>
    

</html>