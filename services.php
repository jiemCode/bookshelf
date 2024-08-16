<?php

define ('SITE_ROOT', realpath(dirname(__FILE__)));

// $DB = 'sqlite:database/development_v2.db';

$pdo =new PDO("sqlite:database/development_v3.db","","",array(
    PDO::ATTR_PERSISTENT => true
));

function opendatabase(){
    global $pdo;
    try{
        if($pdo==null){
          $pdo =new PDO("sqlite:database/development_v2.db","","",array(
                PDO::ATTR_PERSISTENT => true
            ));
        }
        return $pdo;
    }catch(PDOException $e){
        // logerror($e->getMessage(), "opendatabase");
        print "Error in openhrsedb ".$e->getMessage();
    }
}


function isValidUser($username) {
    
    try {
        $pdo = opendatabase();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Utilisateurs WHERE Utilisateurs.nom = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getUserId($username) {
    try {
        $pdo = opendatabase();

        $stmt = $pdo->prepare("SELECT id FROM Utilisateurs WHERE Utilisateurs.nom = ?");
        $stmt->execute([$username]);
        $user_id = $stmt->fetchColumn();
        

        return $user_id;
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getCollectionId($user_id) {
    try {
        $pdo = opendatabase();

        $stmt = $pdo->prepare("SELECT id FROM Collections WHERE id_utilisateurs = ?");
        $stmt->execute([$user_id]);
        $collection_id = $stmt->fetchColumn();
        

        return $collection_id;
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getPassword($username) {
    
    try {
        $pdo = opendatabase();

        $stmt = $pdo->prepare("SELECT motDePasse FROM Utilisateurs WHERE Utilisateurs.nom = ?");
        $stmt->execute([$username]);
        $password = $stmt->fetchColumn();
        

        return $password;
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// insertion


function insererUtilisateur($nom, $email, $motDePasse) {
    
    
    try {
        $pdo = opendatabase();
        

        $pdo->beginTransaction();

        // Insérer l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (nom, email, motDePasse) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $email, $motDePasse]);

        // Récupérer l'ID de l'utilisateur inséré
        $userId = $pdo->lastInsertId();

        // Insérer une collection pour l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO Collections (id_utilisateurs) VALUES (?)");
        $stmt->execute([$userId]);

        $pdo->commit();

        return $userId; // Retourner l'ID de l'utilisateur inséré
    } catch (PDOException $e) {
        global $pdo;
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


function insererLivre($titre, $auteur, $annee, $genre, $collection_id, $filename) {
    
    
    try {
        $pdo = opendatabase();
        

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO Livres (titre, auteur, status, annee, genre, location) VALUES (?, ?, 'Disponible', ?, ?, ?)");
        $stmt->execute([$titre, $auteur, $annee, $genre, $filename]);


        $livre_id = $pdo->lastInsertId(); // Retourner l'ID du livre inséré
        echo "Last inserted id -> ".$livre_id;
        
        $stmt = $pdo->prepare("INSERT INTO CollectionLivres (id_collection, id_livre) VALUES (?, ?)");
        $stmt->execute([$collection_id, $livre_id]);

        $pdo->commit();
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function insererPret($idUtilisateur, $idLivre, $nom) {
    
    
    try {
        $pdo = opendatabase();
        

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO Prets (id_utilisateur, id_livre, nom) VALUES (?, ?, ?)");
        $stmt->execute([$idUtilisateur, $idLivre, $nom]);

        $stmt = $pdo->prepare("
            UPDATE Livres SET status = 'Prêté' WHERE id = ?
        ");
        $stmt->execute([$idLivre]);

        $stmt = $pdo->prepare("
            UPDATE Prets SET date = CURRENT_DATE WHERE date IS NULL;
        ");
        $stmt->execute();
        
        $pdo->commit();

        return $pdo->lastInsertId(); // Retourner l'ID du prêt inséré
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


// recuperation

function getLivresUtilisateur($idUtilisateur) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("
            SELECT Livres.*
            FROM Livres
            JOIN CollectionLivres ON Livres.id = CollectionLivres.id_livre
            JOIN Collections ON CollectionLivres.id_collection = Collections.id
            WHERE Collections.id_utilisateurs = ?
        ");
        $stmt->execute([$idUtilisateur]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getLivreUtilisateur($idUtilisateur, $idLivre) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("
            SELECT Livres.*
            FROM Livres
            JOIN CollectionLivres ON Livres.id = CollectionLivres.id_livre
            JOIN Collections ON CollectionLivres.id_collection = Collections.id
            WHERE Collections.id_utilisateurs = ? AND Livres.id = ?
        ");
        $stmt->execute([$idUtilisateur, $idLivre]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getLivreDisponible($idUtilisateur) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("
            SELECT Livres.*
            FROM Livres
            JOIN CollectionLivres ON Livres.id = CollectionLivres.id_livre
            JOIN Collections ON CollectionLivres.id_collection = Collections.id
            WHERE Collections.id_utilisateurs = ? AND Livres.status = 'Disponible'
        ");
        $stmt->execute([$idUtilisateur]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getLivrePrete($idUtilisateur) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("
            SELECT Livres.*, Prets.*
            FROM Livres
            JOIN CollectionLivres ON Livres.id = CollectionLivres.id_livre
            JOIN Collections ON CollectionLivres.id_collection = Collections.id
            RIGHT JOIN Prets ON Prets.id_livre = Livres.id
            WHERE Collections.id_utilisateurs = ? AND Livres.status = 'Prêté'
        ");
        $stmt->execute([$idUtilisateur]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getPretUtilisateur($idUtilisateur, $idPret) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("
            SELECT Prets.*
            FROM Prets
            WHERE id_utilisateur = ? AND id = ?
        ");
        $stmt->execute([$idUtilisateur, $idPret]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


// modification


function modifierUtilisateurNomEmail($idUtilisateur, $nouveauNom, $nouvelEmail) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("UPDATE Utilisateurs SET nom = ?, email = ? WHERE id = ?");
        $stmt->execute([$nouveauNom, $nouvelEmail, $idUtilisateur]);

        echo "L'utilisateur avec l'ID $idUtilisateur a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function modifierUtilisateurMotDePasse($idUtilisateur, $nouveauMotDePasse) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("UPDATE Utilisateurs SET motDePasse = ? WHERE id = ?");
        $stmt->execute([$nouveauMotDePasse, $idUtilisateur]);

        echo "Le mot de passe de l'utilisateur avec l'ID $idUtilisateur a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function modifierLivre($idLivre, $nouveauTitre, $nouvelAuteur, $nouvelleAnnee, $nouveauGenre, $nouvelleLocation) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("UPDATE Livres SET titre = ?, auteur = ?, annee = ?, genre = ?, location = ? WHERE id = ?");
        $stmt->execute([$nouveauTitre, $nouvelAuteur, $nouvelleAnnee, $nouveauGenre, $nouvelleLocation, $idLivre]);

        echo "Le livre avec l'ID $idLivre a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function modifierStatutLivre($idLivre, $nouveauStatut) {
    
    
    try {
        $pdo = opendatabase();
        

        $stmt = $pdo->prepare("
            UPDATE Livre SET status = ? WHERE id = ?
        ");
        $stmt->execute([$nouveauStatut, $idLivre]);

        echo "Le statut du livre avec l'ID $idLivre a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



// suppression

function supprimerLivre($idLivre) {
    
    
    try {
        $pdo = opendatabase();
        

        $pdo->beginTransaction();

        // Supprimer le livre de la table CollectionLivres
        $stmt = $pdo->prepare("DELETE FROM CollectionLivres WHERE id_livre = ?");
        $stmt->execute([$idLivre]);

        $stmt = $pdo->prepare("
            DELETE FROM Prets 
            WHERE id_livre = ?
            AND EXISTS (SELECT 1 FROM Prets WHERE id_livre = ?);
        ");
        $stmt->execute([$idLivre, $idLivre]);

        // Supprimer le livre de la table Livres
        $stmt = $pdo->prepare("DELETE FROM Livres WHERE id = ?");
        $stmt->execute([$idLivre]);


        $pdo->commit();

        echo "Le livre avec l'ID $idLivre a été supprimé avec succès.";
    } catch (PDOException $e) {
        global $pdo;
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


function supprimerPret($idPret, $idLivre) {
    
    
    try {
        $pdo = opendatabase();
        

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            UPDATE Livres SET status = ? WHERE id = ?
        ");
        $stmt->execute(["Disponible", $idLivre]);
        
        $stmt = $pdo->prepare("DELETE FROM Prets WHERE id = ?");
        $stmt->execute([$idPret]);

        
        $pdo->commit();

        echo "Le prêt avec l'ID $idPret a été supprimé avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function supprimerUtilisateur($idUtilisateur) {
    
    
    try {
        $pdo = opendatabase();
        

        $pdo->beginTransaction();

        // Supprimer la collection de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM Collections WHERE id_utilisateurs = ?");
        $stmt->execute([$idUtilisateur]);

        // Supprimer les prêts de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM Prets WHERE id_utilisateur = ?");
        $stmt->execute([$idUtilisateur]);

        // Supprimer l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM Utilisateurs WHERE id = ?");
        $stmt->execute([$idUtilisateur]);

        $pdo->commit();

        echo "L'utilisateur avec l'ID $idUtilisateur a été supprimé avec succès.";
    } catch (PDOException $e) {
        global $pdo;
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}



function rechercherLivres($sql, $params) {
    try {
        $pdo = opendatabase();

        // Préparation et exécution de la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Récupération des résultats
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des résultats
        if ($resultats) {
            // foreach ($resultats as $livre) {
            //     echo $livre['titre'] . " de " . $livre['auteur'] . " publié en " . $livre['annee'] . "<br>";
            // }
            return $resultats;
        } else {
            return null;
        }
        
    } catch (PDOException $e) {
        global $pdo;
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    return null;
}