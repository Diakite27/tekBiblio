<?php

    require "database.php";
    $id = $_POST['id'];
    $livre = $bd->lire("livre
    LEFT JOIN livre_auteur ON livre.id_livre = livre_auteur.id_livre
    LEFT JOIN auteur ON livre_auteur.id_auteur = auteur.id_auteur
    WHERE livre.id_livre=$id
    GROUP BY titre;
    ", "livre.id_livre, titre, annee_publication, nb_page, description, img, GROUP_CONCAT(auteur.nom, ' ', auteur.prenom SEPARATOR ' et ') AS auteurs
    ")[0];

// Générer le contenu de la fenêtre modale à partir des informations du livre
?>
<div class="modal-header">
<h5 class="modal-title" id="livreModalLabel">Détails du livre</h5>
</div>
<div class="modal-body">
    <div class="row">
        <!-- <div class="col-md-4">
            <img src="admin/assets/livres/<?php echo $livre['img']; ?>" alt="Image du livre" class="img-fluid">
        </div> -->
        <div class="col-md-8">
            <h4 class="text-primary" id="livreModalLabel">Nom du livre: <?php echo $livre['titre']; ?></h5>
            <h4 class="text-muted">Auteur(s) : <span class="fw-normal"><?php echo $livre['auteurs']; ?></span></h4>
            <h4 class="text-muted">Année de publication : <span class="fw-normal"><?php echo $livre['annee_publication']; ?></span></h4>
            <h4 class="text-muted">Nombre de pages : <span class="fw-normal"><?php echo $livre['nb_page']; ?></span></h4>
            <h4 class="text-muted">Description du livre :</h4>
            <p><?php echo $livre['description']; ?></p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
</div>
