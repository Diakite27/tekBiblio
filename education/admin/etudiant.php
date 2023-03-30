<?php
    require "includes/header.php";
    
    // Vérifier si le formulaire a été soumis
    if(isset($_POST['envoyer'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $id_classe = $_POST['classe'];

        // Créer un tableau associatif avec les données de l'auteur
        $data = array(
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "id_classe" => $id_classe,
        );

        // Ajouter les données dans la table 'auteur'
        $table = "eleve";
        $bd->inserer($table, $data);

        // Afficher un message de confirmation
        echo "<script>alert('L\'étudiant a été ajouté avec succès.');</script>";
    }

    // Vérifier si le formulaire a été soumis
    if(isset($_POST['m_envoyer'])) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $id_classe = $_POST['classe'];
        $id_eleve = $_POST['modifi'];

        // Créer un tableau associatif avec les données de l'auteur
        $data = array(
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "id_classe" => $id_classe,
        );

        // Ajouter les données dans la table 'auteur'
        $table = "eleve";
        $condition = "id_eleve = $id_eleve";
        $bd->modifier($table, $data, $condition);

        // Afficher un message de confirmation
        echo "<script>alert('L\'étudiant a été modifié avec succès.');</script>";
    }

    // Vérifier si l'id de l'étudiant à supprimer a été passé en paramètre de l'URL
    if(isset($_GET['id']) && !empty($_GET['id']) && $_GET['action']=='supprimer') {
        $id = $_GET['id'];

        // Supprimer l'étudiant correspondant dans la table 'eleve'
        $table = "eleve";
        $condition = "id_eleve = $id";
        $bd->supprimer($table, $condition);

        // Afficher un message de confirmation
        echo "<script>alert('L\'étudiant a été supprimé avec succès.');</script>";
    }
?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gestion des étudiants</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">Gérer les étudiants</li>
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
                                        Ajouter un étudiant
                                    </button>
                                    </div>
                                </div>
                                </div>
                                <!-- Ajouter la fenêtre modale pour ajouter un étudiant -->
                                <div class="modal fade" id="ajouterEtudiantModal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ajouterEtudiantModalLabel">Ajouter un étudiant</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="etudiant.php" method="POST">
                                            <div class="form-group">
                                                <label for="nom">Nom <span style="color:red"> *</span> :</label>
                                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom de l'étudiant">
                                            </div>
                                            <div class="form-group">
                                                <label for="prenom">Prénom <span style="color:red"> *</span> :</label>
                                                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom de l'étudiant">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email <span style="color:red"> *</span> :</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="L'adresse e-mail de l'étudiant">
                                            </div>
                                            <div class="form-group">
                                                    <label for="classe">Classe <span style="color:red"> *</span> :</label>
                                                    <select class="form-control selectpicker" name="classe" data-live-search="true">
                                                        <option value="">Sélectionnez une classe</option>
                                                        <?php
                                                            // Récupération des catégories depuis la base de données
                                                            $datas = $bd->lire("classe");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_classe'] . '">' . $row['libelle'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
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
                                $datas = $bd->lire("eleve INNER JOIN classe ON eleve.id_classe = classe.id_classe;", "id_eleve, eleve.nom, eleve.prenom, eleve.email, classe.libelle");
                                $colonnes = array("Nom", "Prenom", "email", "Classe");
                                echo $bd->afficher($colonnes, $datas, ["nom", "prenom", "email", "libelle"], "etudiant.php");
                            ?>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                    <!-- Modal pour le formulaire de modification -->
                    
                    <div class="modal fade" id="modifier-modal" tabindex="-1" role="dialog" aria-labelledby="modifier-etudiant-modal-label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifier-etudiant-modal-label">Modifier les informations de l'étudiant</h5>
                            <button type="button" class="close cl" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="etudiant.php" method="POST">
                                <input type="hidden" name="modifi" id="id">
                                <div class="form-group">
                                    <label for="nom">Nom <span style="color:red"> *</span> :</label>
                                    <input type="text" class="form-control" name="nom" id="m_nom">
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom <span style="color:red"> *</span> :</label>
                                    <input type="text" class="form-control" name="prenom" id="m_prenom">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span style="color:red"> *</span> :</label>
                                    <input type="email" class="form-control" name="email" id="m_email">
                                </div>
                                <div class="form-group">
                                        <label for="classe">Classe <span style="color:red"> *</span> :</label>
                                        <select class="form-control selectpicker" name="classe" id="m_classe" data-live-search="true">
                                            <option value="">Sélectionnez une classe</option>
                                            <?php
                                                // Récupération des catégories depuis la base de données
                                                $datas = $bd->lire("classe");
                                                foreach ($datas as $row) {
                                                    echo '<option value="' . $row['id_classe'] . '">' . $row['libelle'] . '</option>';
                                                }
                                            ?>
                                        </select>
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
                        'page': 'eleve'
                    },
                    success: function(response) {
                        console.log(response['nom']);
                        $('#m_nom').val(response['nom']);
                        $('#m_prenom').val(response['prenom']);
                        $('#m_email').val(response['email']);
                        $('#m_classe').val(response['id_classe']);
                        $('#id').val(response['id_eleve']);
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