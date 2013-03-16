drop database if exists sitemarchand;
create database sitemarchand;
USE sitemarchand;

-- table MEMBRE
drop table if exists MEMBRE;
create table MEMBRE
(
	id int AUTO_INCREMENT NOT NULL,
	prenom varchar(30) NOT NULL,
	nom varchar(30) NOT NULL,
	statut varchar(20) DEFAULT 'membre',
	pseudo varchar(20) unique ,
	ville varchar(40) NOT NULL,
	codePostal varchar(6) NOT NULL,
	mail varchar(40) NOT NULL unique,
	dateInscription datetime NOT NULL,
	dateDerniereConnexion datetime,
	adressePostale varchar(40) NOT NULL,
	password char(128) NOT NULL,
	sel VARCHAR(22) NOT NULL,
	validation_hash VARCHAR(32) DEFAULT '', -- Hash(MD5) permettant de valider une inscription / Si vide alors email validé
	banned boolean DEFAULT 0, -- 1 => Utilisateur banni, 0 => non banni;
	primary key(id)
);
insert into MEMBRE VALUES(1, 'prenom','nom','admin','admin','AdminTown','31337','admin@admin.com',Now(),Now(),'Admin street','3abb1bcb6f8757ac570cd84d8877d6385ae4c394d21bc1466301bc2f1b759cc4215e75ed708c183538face54dbb3bbc05a59734be48e7bdd357d0ac05901108b','13MzUxMzhmNWY4Zjk0MDIx','',0);
insert into MEMBRE VALUES(2, 'prenom','nom','membre','membre','membreTown','31337','membre@membre.com',Now(),Now(),'membre street','06b62ebef1e65ae4d8a4cf4c3fb4e33e38c6b556cb89d2e816b3a3facc2e3ab48cbf0b50b0a3dbe7df609ab7df816ed2aa75a275772b0e4a2271f7d94f76897d','13ZWUxZTkwMDdhNWYyYTA1','',0);

-- table MESSAGE
drop table if exists MESSAGE;
create table MESSAGE
(
	idMessage int AUTO_INCREMENT NOT NULL,
	idDestinataire int NOT NULL,
	idExpediteur int NOT NULL,
	contenu blob NOT NULL,
	sujet varchar(255) NOT NULL,
	dateEnvoi datetime NOT NULL, 
	primary key(idMessage)
);
alter table MESSAGE add foreign key fk_mes_destinataire(idDestinataire) REFERENCES MEMBRE(id);
alter table MESSAGE add foreign key fk_mes_expediteur(idExpediteuR) refereNCES MEMBRE(id);
