drop database sitemarchand;
create database sitemarchand;

drop table if exists sitemarchand.MEMBRE;
create table sitemarchand.MEMBRE (
	idMembre int not null,
	prenom varchar(30),
	nom varchar(30),
	statut varchar(20),
	pseudo varchar(20) unique ,
	ville varchar(40),
	codePostal varchar(6),
	mail varchar(40),
	dateInscription date,
	dateDerniereCo date,
	adressePostale varchar(40),
	mdp varchar(30),
	sel VARCHAR(22) NOT NULL,
	validation_hash VARCHAR(32) NOT NULL DEFAULT '', -- Hash(MD5) permettant de valider une inscription / Si vide alors email validé
	banned boolean NOT NULL DEFAULT 0, -- 1 => Utilisateur banni, 0 => non banni;
primary key(idMembre));
