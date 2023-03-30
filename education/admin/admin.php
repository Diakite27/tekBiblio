<?php
    require "includes/header.php";
    require "includes/aside.php";
?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gestion des étudiants</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterEtudiantModal">
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
                                                <form>
                                                    <div class="form-group">
                                                        <label for="nom">Nom:</label>
                                                        <input type="text" class="form-control" id="nom">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prenom">Prénom:</label>
                                                        <input type="text" class="form-control" id="prenom">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="email" class="form-control" id="email">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                <button type="button" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <table id="example" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Doe</td>
                                        <td>John</td>
                                        <td>johndoe@gmail.com</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <a href="#" class="btn btn-info btn-sm">Voir</a>
                                            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Doe</td>
                                        <td>John</td>
                                        <td>johndoe@gmail.com</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <a href="#" class="btn btn-info btn-sm">Voir</a>
                                            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Doe</td>
                                        <td>John</td>
                                        <td>johndoe@gmail.com</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <a href="#" class="btn btn-info btn-sm">Voir</a>
                                            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Doe</td>
                                        <td>John</td>
                                        <td>johndoe@gmail.com</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <a href="#" class="btn btn-info btn-sm">Voir</a>
                                            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Doe</td>
                                        <td>John</td>
                                        <td>johndoe@gmail.com</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <a href="#" class="btn btn-info btn-sm">Voir</a>
                                            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <?php include('includes/footer.php'); ?>