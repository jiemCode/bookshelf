BEGIN TRANSACTION;
DROP TABLE IF EXISTS "CollectionLivres";
CREATE TABLE IF NOT EXISTS "CollectionLivres" (
	"id_collection"	INTEGER NOT NULL,
	"id_livre"	INTEGER NOT NULL,
	PRIMARY KEY("id_collection","id_livre"),
	FOREIGN KEY("id_collection") REFERENCES "Collections"("id"),
	FOREIGN KEY("id_livre") REFERENCES "Livres"("id")
);
DROP TABLE IF EXISTS "Collections";
CREATE TABLE IF NOT EXISTS "Collections" (
	"id"	INTEGER,
	"id_utilisateurs"	INTEGER NOT NULL,
	FOREIGN KEY("id_utilisateurs") REFERENCES "Utilisateurs"("id"),
	PRIMARY KEY("id" AUTOINCREMENT)
);
DROP TABLE IF EXISTS "Livres";
CREATE TABLE IF NOT EXISTS "Livres" (
	"id"	INTEGER,
	"titre"	TEXT NOT NULL,
	"auteur"	TEXT NOT NULL,
	"annee"	INTEGER NOT NULL,
	"status"	TEXT NOT NULL,
	"genre"	TEXT NOT NULL,
	"location"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
DROP TABLE IF EXISTS "Prets";
CREATE TABLE IF NOT EXISTS "Prets" (
	"id"	INTEGER,
	"id_utilisateur"	INTEGER NOT NULL,
	"id_livre"	INTEGER NOT NULL,
	"nom"	TEXT NOT NULL,
	"date"	DATE,
	FOREIGN KEY("id_utilisateur") REFERENCES "Utilisateurs"("id"),
	FOREIGN KEY("id_livre") REFERENCES "Livres"("id"),
	PRIMARY KEY("id" AUTOINCREMENT)
);
DROP TABLE IF EXISTS "Utilisateurs";
CREATE TABLE IF NOT EXISTS "Utilisateurs" (
	"id"	INTEGER,
	"nom"	TEXT NOT NULL,
	"email"	TEXT NOT NULL,
	"motDePasse"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);