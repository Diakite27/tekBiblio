<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>TEK-UP bibliothèque</span></strong>. Tous droits réservés.
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

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
    "searchPlaceholder": "",
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

</body>

</html>