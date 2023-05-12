<?php
header('Content-Type: text/html; charset=utf-8');

require "database.php";
require('fpdf/fpdf.php');

// Récupération des détails de l'emprunt
$empruntId = $_POST['empruntId']; // ID de l'emprunt à afficher (à adapter selon vos besoins)
$emprunt = $bd->lire("emprunt
                    INNER JOIN livre ON emprunt.id_livre = livre.id_livre
                    INNER JOIN eleve ON emprunt.id_eleve = eleve.id_eleve",
                    "emprunt.id, emprunt.date_emprunt, emprunt.date_retour_prevue, livre.titre, eleve.nom, eleve.prenom",
                    "emprunt.id = $empruntId"
);

// var_dump($emprunt);
$num = $emprunt[0]['id'];
// Création du document PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetFont('Arial', '', 12);
$pdf->SetAutoPageBreak(true, 20);
$pdf->AddPage();
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(0, 0, 0);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('FICHE EMPRUNT N° TEK-UP 0'.$num), 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(50, 10, utf8_decode('Nom et prénom(s):'), 0, 0);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, strtoupper(utf8_decode($emprunt[0]['nom']).' '.utf8_decode($emprunt[0]['prenom'])), 0, 1);

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 10, 'Titre du livre:', 0, 0);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, strtoupper(utf8_decode($emprunt[0]['titre'])), 0, 1);

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 10, 'Date d\'emprunt:', 0, 0);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, $emprunt[0]['date_emprunt'], 0, 1);

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50, 10, utf8_decode('Date de retour prévue:'), 0, 0);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(0, 10, $emprunt[0]['date_retour_prevue'], 0, 1);

$pdf->Output();
?>
