drop database if exists sitemarchand;
create database sitemarchand;

drop table if exists sitemarchand.MEMBRE;
create table sitemarchand.MEMBRE
(
	id int NOT NULL,
	prenom varchar(30) NOT NULL,
	nom varchar(30) NOT NULL,
	statut varchar(20) NOT NULL DEFAULT 'membre',
	pseudo varchar(20) unique ,
	ville varchar(40) NOT NULL,
	codePostal varchar(6) NOT NULL,
	mail varchar(40) NOT NULL unique,
	dateInscription date NOT NULL,
	dateDerniereConnexion date,
	adressePostale varchar(40) NOT NULL,
	password char(128) NOT NULL,
	sel VARCHAR(22) NOT NULL,
	validation_hash VARCHAR(32) NOT NULL DEFAULT '', -- Hash(MD5) permettant de valider une inscription / Si vide alors email validé
	banned boolean NOT NULL DEFAULT 0, -- 1 => Utilisateur banni, 0 => non banni;
	primary key(id)
);
