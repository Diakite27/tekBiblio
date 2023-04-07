<?php
    require "includes/header.php";
    
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['envoyer'])) {
        // Récupérer les données du formulaire
        $etu = $_POST['etudiant'];
        $livre = $_POST['livre'];
        $date_emp = $_POST['date_emprunt'];
        $date_retour_prev = $_POST['date_retour_prevue'];

        // Créer un tableau associatif avec les données de l'auteur
        $emprunt = array(
            "id_livre" => $livre,
            "id_eleve" => $etu,
            "date_emprunt" => $date_emp,
            "date_retour_prevue" => $date_retour_prev
        );
        
        $bd->inserer("emprunt", $emprunt);

        // Afficher un message de confirmation
        echo "<script>alert('L\'emprunt a été effectué avec succès.');</script>";
    }

    // Vérifier si le formulaire a été soumis
    if(isset($_POST['m_envoyer'])) {
        // Récupérer les données du formulaire
        $etu = $_POST['etudiant'];
        $livre = $_POST['livre'];
        $date_emp = $_POST['date_emprunt'];
        $date_retour_prev = $_POST['date_retour_prevue'];
        $id = $_POST['modifi'];

        // Créer un tableau associatif avec les données de l'auteur
        $emprunt = array(
            "id_livre" => $livre,
            "id_eleve" => $etu,
            "date_emprunt" => $date_emp,
            "date_retour_prevue" => $date_retour_prev
        );
        // var_dump($auteurs);
        // Ajouter les données dans la table 'auteur'
        $table = "emprunt";
        $condition = "id = $id";
        $bd->modifier($table, $emprunt, $condition);

        // Afficher un message de confirmation
        echo "<script>alert('L\'emprunt a été modifié avec succès.');</script>";
    }

    // Vérifier si l'id de l'étudiant à supprimer a été passé en paramètre de l'URL
    if(isset($_GET['id']) && !empty($_GET['id']) && $_GET['action']=='supprimer') {
        $id = $_GET['id'];
        // Supprimer l'étudiant correspondant dans la table 'eleve'
        $condition = "id = $id";
        $table = "emprunt";
        $bd->supprimer($table, $condition);

        // Afficher un message de confirmation
        echo "<script>alert('L\'emprunt a été supprimé avec succès.');</script>";
    }


?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gestion des livres</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">Gérer les emprunts</li>
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
                                            Emprunter un livre
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Ajouter la fenêtre modale pour ajouter un étudiant -->
                                <div class="modal fade" id="ajouterEtudiantModal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterEtudiantModalLabel">Emprunter un livre</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="emprunt.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="etudiant">Nom de l'étudiant <span style="color:red">*</span> :</label>
                                                    <select class="form-control selectpicker" name="etudiant" id="etudiant" data-live-search="true" required>
                                                        <option value="">Sélectionnez un étudiant</option>
                                                        <?php
                                                            // Récupération des auteurs depuis la base de données
                                                            $datas = $bd->lire("eleve");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_eleve'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="livre">Titre du livre <span style="color:red">*</span> :</label>
                                                    <select class="form-control selectpicker" name="livre" id="livre" data-live-search="true" required>
                                                        <option value="">Sélectionnez un livre</option>
                                                        <?php
                                                            // Récupération des auteurs depuis la base de données
                                                            $datas = $bd->lire("livre");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_livre'] . '">' . $row['titre'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_emprunt">Date d'emprunt <span style="color:red"> *</span> :</label>
                                                    <input type="date" class="form-control" name="date_emprunt" id="date_emprunt">
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_retour">Date de retour <span style="color:red"> *</span> :</label>
                                                    <input type="date" class="form-control" name="date_retour_prevue" id="date_retour_prevue">
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
                                $datas = $bd->lire("emprunt
                                INNER JOIN livre ON emprunt.id_livre = livre.id_livre
                                INNER JOIN eleve ON emprunt.id_eleve = eleve.id_eleve
                                ORDER BY emprunt.id DESC;",
                                "id, livre.titre, CONCAT (eleve.nom, ' ', eleve.prenom) as etudiant, date_emprunt, date_retour_prevue,
                                CASE 
                                    WHEN date_retour <= date_retour_prevue THEN '<span style=\"color: green\">Déposé</span>' 
                                    WHEN date_retour_prevue < NOW() THEN '<span style=\"color: red\"> Non Déposé</span>' 
                                    ELSE '<span style=\"color: yellow\">En cours</span>' 
                                END AS statut"
                                );
                                // var_dump($s);
                                $colonnes = array("Etudiant", "Livre", "Date d'emprunt", "Date de retour prévue", "Statut");
                                echo $bd->afficher($colonnes, $datas, ["etudiant", "titre", "date_emprunt", "date_retour_prevue", "statut"], "emprunt.php");
                            ?>
                            <!-- End Table with stripped rows -->

                        </div>

                        <!-- Ajouter la fenêtre modale pour modifier un emprunt  -->
                        <div class="modal fade" id="modifier-modal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterEtudiantModalLabel">modifier un emprunt</h5>
                                            <button type="button" class="close cl" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="emprunt.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="modifi" id="id"> 
                                                <div class="form-group">
                                                    <label for="etudiant">Nom de l'étudiant <span style="color:red">*</span> :</label>
                                                    <select class="form-control selectpicker" name="etudiant" id="m_etudiant" data-live-search="true" required>
                                                        <option value="">Sélectionnez un étudiant</option>
                                                        <?php
                                                            // Récupération des auteurs depuis la base de données
                                                            $datas = $bd->lire("eleve");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_eleve'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="livre">Titre du livre <span style="color:red">*</span> :</label>
                                                    <select class="form-control selectpicker" name="livre" id="m_livre" data-live-search="true" required>
                                                        <option value="">Sélectionnez un livre</option>
                                                        <?php
                                                            // Récupération des auteurs depuis la base de données
                                                            $datas = $bd->lire("livre");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_livre'] . '">' . $row['titre'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_emprunt">Date d'emprunt <span style="color:red"> *</span> :</label>
                                                    <input type="date" class="form-control" name="date_emprunt" id="m_date_emprunt">
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_retour">Date de retour <span style="color:red"> *</span> :</label>
                                                    <input type="date" class="form-control" name="date_retour_prevue" id="m_date_retour_prevue">
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
                        'page': 'emprunt'
                    },
                    success: function(response) {
                        console.log(response);
                        $('#m_livre').val(response['id_livre']);
                        $('#m_etudiant').val(response['id_eleve']);
                        $('#m_date_emprunt').val(response['date_emprunt']);
                        $('#m_date_retour_prevue').val(response['date_retour_prevue']);
                        $('#id').val(response['id']);


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