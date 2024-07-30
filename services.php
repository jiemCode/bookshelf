<?php

$DB = 'sqlite:database/development.db';

$pdo = new PDO($DB);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function opendatabase(){
    global $pdo;
    try{
        if($pdo==null){
          $pdo =new PDO("sqlite:database/development.db","","",array(
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
            echo "User exists";
            return true;
        } else {
            echo "User doesn't exit";
            return false;
        }
        
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
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


function insererLivre($titre, $auteur, $annee, $status, $genre) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO Livres (titre, auteur, annee, status, genre) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $auteur, $annee, $status, $genre]);

        return $pdo->lastInsertId(); // Retourner l'ID du livre inséré
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function insererPret($idUtilisateur, $idLivre, $nom) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO Prets (id_utilisateur, id_livre, nom) VALUES (?, ?, ?)");
        $stmt->execute([$idUtilisateur, $idLivre, $nom]);

        return $pdo->lastInsertId(); // Retourner l'ID du prêt inséré
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


// recuperation

function getLivresUtilisateur($idUtilisateur) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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


// modification


function modifierUtilisateurNomEmail($idUtilisateur, $nouveauNom, $nouvelEmail) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE Utilisateurs SET motDePasse = ? WHERE id = ?");
        $stmt->execute([$nouveauMotDePasse, $idUtilisateur]);

        echo "Le mot de passe de l'utilisateur avec l'ID $idUtilisateur a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function modifierLivre($idLivre, $nouveauTitre, $nouvelAuteur, $nouvelleAnnee, $nouveauStatus, $nouveauGenre) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE Livres SET titre = ?, auteur = ?, annee = ?, status = ?, genre = ? WHERE id = ?");
        $stmt->execute([$nouveauTitre, $nouvelAuteur, $nouvelleAnnee, $nouveauStatus, $nouveauGenre, $idLivre]);

        echo "Le livre avec l'ID $idLivre a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function modifierStatutPret($idPret, $nouveauStatut) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE Prets SET status = ? WHERE id = ?");
        $stmt->execute([$nouveauStatut, $idPret]);

        echo "Le statut du prêt avec l'ID $idPret a été mis à jour avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}



// suppression

function supprimerLivre($idLivre) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->beginTransaction();

        // Supprimer le livre de la table CollectionLivres
        $stmt = $pdo->prepare("DELETE FROM CollectionLivres WHERE id_livre = ?");
        $stmt->execute([$idLivre]);

        // Supprimer le livre de la table Livres
        $stmt = $pdo->prepare("DELETE FROM Livres WHERE id = ?");
        $stmt->execute([$idLivre]);

        $pdo->commit();

        echo "Le livre avec l'ID $idLivre a été supprimé avec succès.";
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


function supprimerPret($idPret) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM Prets WHERE id = ?");
        $stmt->execute([$idPret]);

        echo "Le prêt avec l'ID $idPret a été supprimé avec succès.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function supprimerUtilisateur($idUtilisateur) {
    
    
    try {
        $pdo = opendatabase();
        // $pdo = new PDO($DB);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


