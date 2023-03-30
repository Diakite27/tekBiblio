<?php
    require "includes/header.php";
    
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['envoyer'])) {
        // var_dump($_POST);
        // Récupérer les données du formulaire
        $titre = $_POST['titre'];
        $auteurs = $_POST['auteurs'];
        $an = $_POST['annee'];
        $nb_ex = $_POST['nb_ex'];
        $nb_page = $_POST['nb_page'];
        $desc = $_POST['desc'];
        $genre = $_POST['genre'];

        $photo = $_FILES['img'];
        $nomPhoto = $photo['name'];
        $sourcePhoto = $photo['tmp_name'];
        $cheminPhoto = "assets/livres/$nomPhoto";
        
        // Déplacement de la photo
        if (move_uploaded_file($sourcePhoto, $cheminPhoto)) {
            echo "Téléchargée avec succès.<br>";
        } else {
            echo "Erreur lors du téléchargement de la photo.<br>";
        }

        // Créer un tableau associatif avec les données de l'auteur
        $livre = array(
            "titre" => $titre,
            "annee_publication" => $an,
            "nombre_exemplaires" => $nb_ex,
            "nb_page" => $nb_page,
            "img" => $nomPhoto,
            "description" => $desc,
            "id_genre" => $genre,
        );
        
        $bd->inserer("livre", $livre);

        $id_livre = $bd->lire("livre", "max(id_livre) as id");
        $id = intval(trim($id_livre[0]["id"]));

        foreach($auteurs as $auteur){
            $data = array(
                "id_livre" => $id,
                'id_auteur' => $auteur
            );
            $bd->inserer("livre_auteur", $data);
        }

        // Afficher un message de confirmation
        echo "<script>alert('L\'auteur a été ajouté avec succès.');</script>";
    }

    // Vérifier si le formulaire a été soumis
    if(isset($_POST['m_envoyer'])) {
        // Récupérer les données du formulaire
        $titre = $_POST['titre'];
        $auteurs = $_POST['auteurs'];
        $an = $_POST['annee'];
        $nb_ex = $_POST['nb_ex'];
        $nb_page = $_POST['nb_page'];
        $desc = $_POST['desc'];
        $genre = $_POST['genre'];
        $id_livre = $_POST['modifi'];

        // Créer un tableau associatif avec les données de l'auteur
        $livre = array(
            "titre" => $titre,
            "annee_publication" => $an,
            "nombre_exemplaires" => $nb_ex,
            "nb_page" => $nb_page,
            "description" => $desc,
            "id_genre" => $genre,
        );
        // var_dump($auteurs);
        // Ajouter les données dans la table 'auteur'
        $table = "livre";
        $condition = "id_livre = $id_livre";
        $bd->modifier($table, $livre, $condition);

        $table = "livre_auteur";
        $bd->supprimer($table, $condition);
        foreach($auteurs as $auteur){
            $data = array(
                "id_livre" => $id_livre,
                'id_auteur' => $auteur
            );
            $bd->inserer($table, $data);
        }


        // Afficher un message de confirmation
        echo "<script>alert('Le livre a été modifié avec succès.');</script>";
    }

    // Vérifier si l'id de l'étudiant à supprimer a été passé en paramètre de l'URL
    if(isset($_GET['id']) && !empty($_GET['id']) && $_GET['action']=='supprimer') {
        $id = $_GET['id'];
        // Supprimer l'étudiant correspondant dans la table 'eleve'
        $condition = "id_livre = $id";
        $table = "livre_auteur";
        $bd->supprimer($table, $condition);
        $table = "livre";
        $bd->supprimer($table, $condition);

        // Afficher un message de confirmation
        echo "<script>alert('Le livre a été supprimé avec succès.');</script>";
    }


?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gestion des livres</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item">Gérer les livres</li>
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
                                            Ajouter un livre
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Ajouter la fenêtre modale pour ajouter un étudiant -->
                                <div class="modal fade" id="ajouterEtudiantModal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterEtudiantModalLabel">Ajouter un livre</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="livre.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="titre">Titre<span style="color:red">*</span> :</label>
                                                    <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre du livre" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="auteurs">Auteur(s) <span style="color:red">*</span> :</label>
                                                    <select class="form-control selectpicker" name="auteurs[]" data-live-search="true" multiple required>
                                                        <option value="">Sélectionnez un ou plusieurs auteurs</option>
                                                        <?php
                                                            // Récupération des auteurs depuis la base de données
                                                            $datas = $bd->lire("auteur");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_auteur'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="categorie">Catégorie :</label>
                                                    <select class="form-control selectpicker" name="genre" data-live-search="true">
                                                        <option value="">Sélectionnez une catégorie</option>
                                                        <?php
                                                            // Récupération des catégories depuis la base de données
                                                            $datas = $bd->lire("genre");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_genre'] . '">' . $row['nom_genre'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="annee">Année de publication :</label>
                                                    <input type="number" class="form-control" name="annee" id="annee" placeholder="Année de publication">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exemplaires">Nombre d'exemplaires<span style="color:red"> *</span> :</label>
                                                    <input type="number" class="form-control" name="nb_ex" id="exemplaires" placeholder="Nombre d'exemplaires" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pages">Nombre de pages :</label>
                                                    <input type="number" class="form-control" name="nb_page" id="pages" placeholder="Nombre de pages">
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image<span style="color:red">*</span> :</label>
                                                    <input type="file" class="form-control-file" name="img" id="image" accept=".jpg, .jpeg, .png" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description :</label>
                                                    <textarea class="form-control" name="desc" id="description" rows="3"></textarea>
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
                                $datas = $bd->lire("livre_auteur
                                INNER JOIN livre ON livre_auteur.id_livre = livre.id_livre
                                INNER JOIN auteur ON livre_auteur.id_auteur = auteur.id_auteur
                                INNER JOIN genre ON livre.id_genre = genre.id_genre
                                GROUP BY livre.titre;
                                ", "livre.id_livre, livre.titre, GROUP_CONCAT(auteur.nom , ' ', auteur.prenom SEPARATOR ' et ') AS auteurs, livre.nombre_exemplaires, genre.nom_genre AS genre");
                                // var_dump($s);
                                $colonnes = array("Titre", "Auteur (s)", "Nombre d'exemplaire", "Catégory");
                                echo $bd->afficher($colonnes, $datas, ["titre", "auteurs", "nombre_exemplaires", "genre"], "livre.php");
                            ?>
                            <!-- End Table with stripped rows -->

                        </div>

                        <!-- Ajouter la fenêtre modale pour modifier un livre -->
                        <div class="modal fade" id="modifier-modal" tabindex="-1" role="dialog" aria-labelledby="ajouterEtudiantModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ajouterEtudiantModalLabel">modifier un livre</h5>
                                            <button type="button" class="close cl" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="livre.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="modifi" id="id"> 
                                                <div class="form-group">
                                                    <label for="titre">Titre<span style="color:red">*</span> :</label>
                                                    <input type="text" class="form-control" name="titre" id="m_titre" placeholder="Titre du livre" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="auteurs">Auteur(s) <span style="color:red">*</span> :</label>
                                                    <select class="form-control selectpicker" name="auteurs[]" id="m_auteurs" data-live-search="true" multiple required>
                                                        <option value="">Sélectionnez un ou plusieurs auteurs</option>
                                                        <?php
                                                            // Récupération des auteurs depuis la base de données
                                                            $datas = $bd->lire("auteur");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_auteur'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="categorie">Catégorie :</label>
                                                    <select class="form-control selectpicker" name="genre" id="m_genre" data-live-search="true">
                                                        <option value="">Sélectionnez une catégorie</option>
                                                        <?php
                                                            // Récupération des catégories depuis la base de données
                                                            $datas = $bd->lire("genre");
                                                            foreach ($datas as $row) {
                                                                echo '<option value="' . $row['id_genre'] . '">' . $row['nom_genre'] . '</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="annee">Année de publication :</label>
                                                    <input type="number" class="form-control" name="annee" id="m_annee" placeholder="Année de publication">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exemplaires">Nombre d'exemplaires<span style="color:red"> *</span> :</label>
                                                    <input type="number" class="form-control" name="nb_ex" id="m_exemplaires" placeholder="Nombre d'exemplaires" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pages">Nombre de pages :</label>
                                                    <input type="number" class="form-control" name="nb_page" id="m_pages" placeholder="Nombre de pages">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description :</label>
                                                    <textarea class="form-control" name="desc" id="m_description" rows="3"></textarea>
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
                        'page': 'livre'
                    },
                    success: function(response) {
                        console.log(response);
                        $('#m_titre').val(response['titre']);
                        $('#m_annee').val(response['annee_publication']);
                        $('#m_genre').val(response['genre']);
                        $('#m_exemplaires').val(response['nombre_exemplaires']);
                        $('#m_pages').val(response['nb_page']);
                        $('#m_description').val(response['description']);
                        $('#id').val(response['id_livre']);
                        var selectedAuteurs = response['auteurs'].split(",");
                        $('#m_auteurs option:selected').removeAttr('selected');
                        $('#m_auteurs option').each(function() {
                            var optionValue = $(this).val();
                            if ($.inArray(optionValue, selectedAuteurs) !== -1) {
                                $(this).attr("selected", "selected");
                            }
                        });


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