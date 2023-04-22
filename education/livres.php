<?php
    require "database.php";
    $livres = $bd->lire("livre
    LEFT JOIN genre ON livre.id_genre = genre.id_genre
    LEFT JOIN emprunt ON livre.id_livre = emprunt.id_livre AND emprunt.date_retour IS NULL
    GROUP BY livre.titre ORDER BY livre.titre;
    ", "livre.id_livre, livre.titre, img, genre.nom_genre AS genre,
    CASE 
        WHEN livre.nombre_exemplaires - COUNT(emprunt.id_livre) > 0 THEN '<span style=\"color: green\">Oui</span>' 
        ELSE '<span style=\"color: red\">Non</span>' 
    END AS dispo
    ");
    // Récupération de la liste des livres
    
    if(isset($_POST['envoyer'])){

        $id_livre = $_POST['id_livre'];
        $etu = $_SESSION['idE'];
        $date_emprunt = $_POST['date_emprunt'];
        $date_retour_prevue = $_POST['date_retour_prevue'];

        // Vérification des champs obligatoires
        if(empty($date_emprunt) || empty($date_retour_prevue)){
            echo "<script>alert('Veuillez remplir tous les champs obligatoires.');</script>";
        }
        else if($date_emprunt > $date_retour_prevue){
            echo "<script>alert('La date d\'emprunt ne peut pas être supérieure à la date de retour.');</script>";
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



        <?php
            require 'header.php';
        ?>
    
        <div class="container">
        <h2 class="text-center" style="margin-top: 2cm">Liste de tous les livres</h2>
        <!-- Tableau contenant la liste de tous les livres stockés dans la bdd  -->
            <table id="example" class="table table-striped table-bordered compact nowrap container-fluid" style="width:100%;">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Genre</th>
                    <th>Disponible</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($livres as $livre): ?>
                <tr>
                    <td><img src="admin/assets/livres/<?php echo $livre['img']; ?>" alt="<?php echo $livre['titre']; ?>" width="100"></td>
                    <td><?php echo $livre['titre']; ?></td>
                    <td><?php echo $livre['genre']; ?></td>
                    <td><?php echo $livre['dispo']; ?></td>
                    <input type="hidden" class="id" name="id" value="'. <?php echo $livre['id_livre']; ?> .'" />
                    <td>
                        <a href="#" class="detail" title="Voir les détails" data-toggle="modal" data-target="#detail" data-id="<?php echo $livre['id_livre']; ?>" style="margin-right: 12px;"><img src="https://img.icons8.com/fluency/20/null/eyebrow.png"/></a>
                        <?php if(strpos($livre['dispo'], 'Non') !== false){
                                echo '<a href="#" class="no_emprunter" title="Emprunter le livre" data-toggle="modal" data-target="#emprunt" data-id="<?php echo $livre[\'id_livre\']; ?>" disabled>
                                        <img src="https://img.icons8.com/color/20/null/borrow-book.png"/>
                                    </a>';
                            } else{
                                echo '<a href="#" class="emprunter" title="Emprunter le livre" data-toggle="modal" data-target="#emprunt" data-id="' . $livre['id_livre'] . '"disabled>
                                    <img src="https://img.icons8.com/color/20/null/borrow-book.png"/>
                                 </a>';
                            }
                        ?>
                        
                        <?php 
                            if (strpos($livre['dispo'], 'Non') !== false){
                                echo "
                                    <style>
                                    .no_emprunter[disabled] {
                                        pointer-events: none;
                                        opacity: 0.4; /* optional: reduce opacity to visually indicate the link is disabled */
                                    }
                                    </style>                                
                                ";
                            }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        <!-- Fin des contenus -->
    </table>
    <!-- Ajouter la fenêtre modale pour emprunter un livre -->
    <div class="modal fade" id="emprunt" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterEtudiantModalLabel">Emprunter un livre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="livres.php" method="POST">
                    <div class="form-group">
                        <label for="date_emprunt">Date d'emprunt <span style="color:red"> *</span> :</label>
                        <input type="date" class="form-control" name="date_emprunt" id="date_emprunt">
                    </div>
                    <div class="form-group">
                        <label for="date_retour">Date de retour <span style="color:red"> *</span> :</label>
                        <input type="date" class="form-control" name="date_retour_prevue" id="date_retour_prevue">
                    </div>
                    <input type="hidden" name="id_livre" id="id_livre">
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary text-left" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="envoyer">Emprunter</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Ajouter la fenêtre modale pour emprunter un livre -->
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="livreModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					
				</div>
			</div>
		</div>
    </div>

    <!-- include les liens vers les fichiers JS nécessaires, y compris jQuery et DataTables -->

    <?php
        require 'footer.php';
    ?>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>


    
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Récupérer la valeur de data-id lors du clic sur le bouton "Emprunter"
            $(".emprunter").click(function() {
            var id_livre = $(this).data("id");
            // console.log(id_livre);
            // Affecter la valeur de id_livre à un champ caché dans le formulaire modal
            $("#id_livre").val(id_livre);
            });
        });
        $(document).on('click', '.detail', function() {
            var id = $(this).data("id");
            $.ajax({
                url: 'detail.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    $('#detail .modal-content').html(response);
                    $('#detail').modal('show');
                },
                error: function() {
                    alert('Une erreur est survenue lors du chargement du livre.');
                }
            });
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