<?php
    require "includes/header.php";
    
    // Vérifier si le formulaire a été soumis
    if(isset($_POST['envoyer'])) {
        // Récupérer les données du formulaire
        $lib = $_POST['lib'];
        $eff = $_POST['eff'];

        // Créer un tableau associatif avec les données de l'auteur
        $data = array(
            "libelle" => $lib,
            "effectif" => $eff
        );

        // Ajouter les données dans la table 'auteur'
        $table = "classe";
        $bd->inserer($table, $data);

        // Afficher un message de confirmation
        echo "<script>alert('La classe a été ajoutée avec succès.');</script>";
    }

        // Vérifier si le formulaire a été soumis
        if(isset($_POST['m_envoyer'])) {
            // Récupérer les données du formulaire
            $lib = $_POST['lib'];
            $eff = $_POST['eff'];
            $id_classe = $_POST['modifi'];
    
            // Créer un tableau associatif avec les données de l'auteur
            $data = array(
                "libelle" => $lib,
                "effectif" => $eff
            );
    
            // Ajouter les données dans la table 'auteur'
            $table = "classe";
            $condition = "id_classe = $id_classe";
            $bd->modifier($table, $data, $condition);
    
            // Afficher un message de confirmation
            echo "<script>alert('La classe a été modifiée avec succès.');</script>";
        }
    
        // Vérifier si l'id de l'étudiant à supprimer a été passé en paramètre de l'URL
        if(isset($_GET['id']) && !empty($_GET['id']) && $_GET['action']=='supprimer') {
            $id = $_GET['id'];
    
            // Supprimer l'étudiant correspondant dans la table 'eleve'
            $table = "classe";
            $condition = "id_classe = $id";
            $bd->supprimer($table, $condition);
    
            // Afficher un message de confirmation
            echo "<script>alert('La classe a été supprimée avec succès.');</script>";
        }
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Gestion des classes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                <li class="breadcrumb-item">Gérer les classes</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <!-- Ajouter le bouton pour ajouter un étudiant -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterEtudiantModal">
                                        Ajouter une classe
                                    </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Ajouter la fenêtre modale pour ajouter un étudiant -->
                            <div class="modal fade" id="ajouterEtudiantModal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterEtudiantModalLabel">Ajouter une classe</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="classe.php" method="POST">
                                                <div class="form-group">
                                                    <label for="lib">Libellé<span style="color:red"> *</span> :</label>
                                                    <input type="text" class="form-control" name="lib" id="lib" placeholder="Libellé de la classe" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="eff">Effectif :</label>
                                                    <input type="number" class="form-control" name="eff" id="eff" placeholder="Effectif de la classe">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary text-left" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary" name="envoyer">Enregistrer</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <?php 
                            $datas = $bd->lire("classe");
                            $colonnes = array("Libellé", "Effectif");
                            echo $bd->afficher($colonnes, $datas, ["libelle", "effectif"], "classe.php");
                        ?>
                        <!-- End Table with stripped rows -->

                    </div>
                    <!-- Ajouter la fenêtre modale pour modifier une classe -->
                    <div class="modal fade" id="modifier-modal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterEtudiantModalLabel">Modifier les informations d'une classe</h5>
                                            <button type="button" class="close cl" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="classe.php" method="POST">
                                                <input type="hidden" name="modifi" id="id">
                                                <div class="form-group">
                                                    <label for="lib">Libellé<span style="color:red"> *</span> :</label>
                                                    <input type="text" class="form-control" name="lib" id="m_lib" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="eff">Effectif :</label>
                                                    <input type="number" class="form-control" name="eff" id="m_eff" placeholder="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary text-left cl" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary" name="m_envoyer">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->


<?php include('includes/footer.php'); ?>

<script type="text/javascript">
		$(document).ready(function () {
            $('.modifier').click(function (e){
                e.preventDefault();
                var id = $(this).closest('tr').find('.id').val();
                // alert(id);
                $.ajax({
                    url: 'liste.php',
                    type: "POST",
                    data: {
                        'modif': true,
                        'id': id,
                        'page': 'classe'
                    },
                    success: function(response) {
                        console.log(response['nom']);
                        $('#m_lib').val(response['libelle']);
                        $('#m_eff').val(response['effectif']);
                        $('#id').val(response['id_classe']);
                        $('#modifier-modal').modal('show');
                        $(document).on('click', '.cl', function() {
                        $('#modifier-modal').modal('hide');
                        });
                        
                    },
                    error: function(err) {
                        console.log(err);
                    },
                });
            });
        });
</script>