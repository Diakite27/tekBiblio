<?php
    require "includes/header.php";
    // Vérifier si le formulaire a été soumis
    if(isset($_POST['envoyer'])) {
        // Récupérer les données du formulaire
        $libelle = $_POST['lib'];

        // Créer un tableau associatif avec les données de l'auteur
        $data = array(
            "nom_genre" => $libelle,
        );

        // Ajouter les données dans la table 'auteur'
        $table = "genre";
        $bd->inserer($table, $data);

        // Afficher un message de confirmation
        echo "<script>alert('L\'auteur a été ajouté avec succès.');</script>";
    }

?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gestion des Catégories de livre</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">Gérer les catégories de livre</li>
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
                                        Ajouter une catégorie de livre
                                    </button>
                                    </div>
                                </div>
                                </div>
                                <!-- Ajouter la fenêtre modale pour ajouter un étudiant -->
                                <div class="modal fade" id="ajouterEtudiantModal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ajouterEtudiantModalLabel">Ajouter un Catégorie de livre</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="category.php" method="POST">
                                            <div class="form-group">
                                                <label for="titre">Libellé<span style="color:red"> *</span> :</label>
                                                <input type="text" class="form-control" name="lib" id="lib" placeholder="Libellé du genre de livre" required>
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
                                $datas = $bd->lire("genre");
                                $colonnes = array("Libellé");
                                echo $bd->afficher($colonnes, $datas, ["nom_genre"], "admin.php");
                            ?>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->


<?php include('includes/footer.php'); ?>