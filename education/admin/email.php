<?php

    require '../database.php';

    // Récupération des emprunts dont la date de dépôt est dans 3 jours
    $date_depot = date('Y-m-d', strtotime('+3 days'));
    $sql = "SELECT eleve.email, livre.titre FROM emprunt
            INNER JOIN eleve ON emprunt.id_eleve = eleve.id
            INNER JOIN livre ON emprunt.id_livre = livre.id
            WHERE emprunt.date_depot = '$date_depot'";
    $result = $conn->query($sql);

    // Envoi d'un e-mail à chaque étudiant concerné
    if ($result->num_rows > 0) {
        $to = "";
        while($row = $result->fetch_assoc()) {
            $to .= $row["email"] . ",";
            $titre_livre = $row["titre"];
        }
        $to = rtrim($to, ",");
        $subject = "Rappel de retour de livre";
        $message = "Bonjour,\n\nCe message est un rappel pour le retour du livre \"$titre_livre\" que vous avez emprunté à la bibliothèque. La date de dépôt est dans 3 jours.\n\nMerci de le retourner dans les délais prévus.\n\nCordialement,\nLa bibliothèque";
        $headers = "From: yachtediakite@gmail.com";
        mail($to, $subject, $message, $headers);
    }

?>
