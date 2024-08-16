<?php

require 'services.php';

// Démarrage de la session
session_start();

function getQuery() {
    
}
// Initialisation des paramètres de recherche dans la session (si ce n'est pas déjà fait)
if (!isset($_SESSION['params'])) {
    $_SESSION['params'] = [
        'annee_min' => '',
        'annee_max' => '',
        'titre' => '',
        'auteur' => '',
        'genre' => '',
        'status' => ''
    ];
}

// Mise à jour des paramètres avec les valeurs fournies dans la requête
if (isset($_GET['annee_min'])) {
    $_SESSION['params']['annee_min'] = $_GET['annee_min'];
}
if (isset($_GET['annee_max'])) {
    $_SESSION['params']['annee_max'] = $_GET['annee_max'];
}
if (isset($_GET['titre'])) {
    $_SESSION['params']['titre'] = $_GET['titre'];
}
if (isset($_GET['auteur'])) {
    $_SESSION['params']['auteur'] = $_GET['auteur'];
}
if (isset($_GET['genre'])) {
    $_SESSION['params']['genre'] = $_GET['genre'];
}
if (isset($_GET['status'])) {
    $_SESSION['params']['status'] = $_GET['status'];
}
// Début de la requête SQL
$sql = "SELECT * FROM Livres WHERE 1=1";

// Liste des paramètres pour la requête
$params = [];

// Ajout dynamique des conditions et des paramètres en fonction des valeurs non vides dans $_SESSION['params']
if (!empty($_SESSION['params']['annee_min']) && !empty($_SESSION['params']['annee_max'])) {
    $sql .= " AND annee BETWEEN :annee_min AND :annee_max";
    $params[':annee_min'] = $_SESSION['params']['annee_min'];
    $params[':annee_max'] = $_SESSION['params']['annee_max'];
}

if (!empty($_SESSION['params']['titre'])) {
    $sql .= " AND titre LIKE :titre";
    $params[':titre'] = '%' . $_SESSION['params']['titre'] . '%';
}

if (!empty($_SESSION['params']['auteur'])) {
    $sql .= " AND auteur LIKE :auteur";
    $params[':auteur'] = '%' . $_SESSION['params']['auteur'] . '%';
}

if (!empty($_SESSION['params']['genre'])) {
    $sql .= " AND genre LIKE :genre";
    $params[':genre'] = '%' . $_SESSION['params']['genre'] . '%';
}

if (!empty($_SESSION['params']['status'])) {
    $sql .= " AND status LIKE :status";
    $params[':status'] = '%' . $_SESSION['params']['status'] . '%';
}

// header("Location : /pages/search.php");
