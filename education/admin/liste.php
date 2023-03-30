<?php
require "../database.php";

header('Content-Type: application/json');

function liste($table, $bd, $id_table, $sel = '', $details = ''){
   
        // Récupérer l'identifiant de l'étudiant
        $id = $_POST['id'];
        $sels = $sel == '' ? '*' : $sel;
        // Récupérer les informations de l'étudiant à partir de la base de données
        $condition = "$id_table = $id $details";
        $data = $bd->lire($table, $sels, $condition)[0];
    
        // Retourner les informations de l'étudiant au format JSON
        echo json_encode($data);
    
}

switch ($_POST['page']) {
    case 'eleve':
        liste('eleve', $bd, 'id_eleve');
        break;
    case 'classe':
        liste('classe', $bd, 'id_classe');
        break;
    case 'livre':
        liste('livre_auteur
        INNER JOIN livre ON livre_auteur.id_livre = livre.id_livre
        INNER JOIN auteur ON livre_auteur.id_auteur = auteur.id_auteur
        INNER JOIN genre ON livre.id_genre = genre.id_genre', 
        $bd, 
        'livre.id_livre', "livre.id_livre, livre.titre, livre.annee_publication, livre.nombre_exemplaires, GROUP_CONCAT(auteur.id_auteur) AS auteurs, livre.nombre_exemplaires, livre.nb_page, livre.img, livre.description, genre.id_genre AS genre",
        'GROUP BY livre.id_livre;'
        );
        break;
    case 'emprunt':
        liste('emprunt AS e
        INNER JOIN livre ON e.id_livre = livre.id_livre
        INNER JOIN eleve ON e.id_eleve = eleve.id_eleve', 
        $bd, 
        'id', "id, e.id_livre, e.id_eleve, date_emprunt, date_retour_prevue",
        );
        break;
    
    default:
        echo "Mauvaise valeur de paramètre";
        break;
}



?>
