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
	lu boolean NOT NULL DEFAULT 0, 
	primary key(idMessage)
);

-- table PRODUIT_ENCHERE
drop table if exists PRODUIT_ENCHERE;
create table PRODUIT_ENCHERE
(
	idProduit int AUTO_INCREMENT NOT NULL,
	nomProduit varchar(255) NOT NULL,
	dateDebut datetime NOT NULL,
	dateFin datetime NOT NULL,
	prixInitial decimal(19,4) NOT NULL,
	-- la photo on la stock pas ici mais dans le dossier img/produits/ID_PRODUIT.png
	idProprietaire int NOT NULL,
	idDescriptif int NOT NULL,
	primary key(idProduit)
);

-- table PRODUIT_CATALOGUE
drop table if exists PRODUIT_CATALOGUE;
create table PRODUIT_CATALOGUE
(
	idProduit int AUTO_INCREMENT NOT NULL,
	nomProduit varchar(255) NOT NULL,
	stock int NOT NULL,
	prixUnitaire decimal(19,4) NOT NULL,
	-- la photo on la stock pas ici mais dans le dossier img/produits/ID_PRODUIT.png
	idDescriptif int NOT NULL,
	primary key(idProduit)
);

-- table DESCRIPTIF
drop table if exists DESCRIPTIF;
create table DESCRIPTIF
(
	idDescriptif int AUTO_INCREMENT NOT NULL,
	idLangue int NOT NULL,
	libelleDescriptif blob NOT NULL,
	primary key(idDescriptif)
);

-- table LANGUE
drop table if exists LANGUE;
create table LANGUE
(
	idLangue int AUTO_INCREMENT NOT NULL,
	libelleLangue varchar(150) NOT NULL,
	primary key(idLangue)
);


-- table COMMENTAIRE
drop table if exists COMMENTAIRE;
create table COMMENTAIRE
(
	idCommentaire int AUTO_INCREMENT NOT NULL,
	idMembre int NOT NULL,
	idProduit int NOT NULL,
	contenu blob NOT NULL,
	primary key(idCommentaire)
);

-- table EVALUATION
drop table if exists EVALUATION;
create table EVALUATION
(
	idEvaluation int AUTO_INCREMENT NOT NULL,
	idMembre int NOT NULL,
	note tinyint(1) NOT NULL,
	commentaire blob NOT NULL,
	primary key(idEvaluation)
);

-- table ENCHERE
drop table if exists ENCHERE;
create table ENCHERE
(
	idEnchere int AUTO_INCREMENT NOT NULL,
	montantEnchere decimal(19,4) NOT NULL,
	dateEnchere datetime NOT NULL,
	idEvaluationVendeur int NOT NULL DEFAULT 0,
	idEvaluationAcheteur int NOT NULL DEFAULT 0,
	idProduitEnchere int NOT NULL,
	idEncherisseur int NOT NULL,
	primary key(idEnchere)

);

-- table COMMANDE
drop table if exists COMMANDE;
create table COMMANDE
(
    idCommande int NOT NULL,
    prixLivraison int NOT NULL,
    primary key(idCommande)
);

-- table QUANTITE
drop table if exists QUANTITE;
create table QUANTITE
(
    idProduit int NOT NULL,
    idCommande int NOT NULL,
    quantite int NOT NULL,
    primary key(idProduit,idCommande)
);


-- clés étrangères
alter table MESSAGE add foreign key fk_mes_destinataire(idDestinataire) REFERENCES MEMBRE(id);
alter table MESSAGE add foreign key fk_mes_expediteur(idExpediteuR) refereNCES MEMBRE(id);

alter table DESCRIPTIF add foreign key fk_desc_langue(idLangue) REFERENCES LANGUE(idLangue);

alter table PRODUIT_CATALOGUE add foreign key fk_prodc_desc(idDescriptif) REFERENCES DESCRIPTIF(idDescriptif);

alter table PRODUIT_ENCHERE add foreign key fk_prode_desc(idDescriptif) REFERENCES DESCRIPTIF(idDescriptif);
alter table PRODUIT_ENCHERE add foreign key fk_prode_pro(idProprietaire) REFERENCES MEMBRE(id);

alter table COMMENTAIRE add foreign key fk_com_mem(idMembre) REFERENCES MEMBRE(id);
alter table COMMENTAIRE add foreign key fk_com_prod(idProduit) REFERENCES PRODUIT_CATALOGUE(idProduit);

alter table ENCHERE add foreign key fk_ench_evalv(idEvaluationVendeur) REFERENCES MEMBRE(id);
alter table ENCHERE add foreign key fk_ench_evala(idEvaluationAcheteur) REFERENCES MEMBRE(id);
alter table ENCHERE add foreign key fk_ench_ench(idEncherisseur) REFERENCES MEMBRE(id);
alter table ENCHERE add foreign key fk_ench_prod(idProduitEnchere) REFERENCES PRODUIT_ENCHERE(idProduit);

alter table EVALUATION add foreign key fk_eval_mem(idMembre) REFERENCES MEMBRE(id);

alter table QUANTITE add foreign key fk_quant_pro(idProduit)  REFERENCES PRODUIT_CATALOGUE(idProduit);
alter table QUANTITE add foreign key fk_quant_com(idCommande) REFERENCES COMMANDE(idCommande);

-- exemples
-- admin:admin
insert into MEMBRE VALUES(1, 'prenom','nom','admin','admin','AdminTown','31337','admin@admin.com',Now(),Now(),'Admin street','3abb1bcb6f8757ac570cd84d8877d6385ae4c394d21bc1466301bc2f1b759cc4215e75ed708c183538face54dbb3bbc05a59734be48e7bdd357d0ac05901108b','13MzUxMzhmNWY4Zjk0MDIx','',0);
-- membre:membre
insert into MEMBRE VALUES(2, 'prenom','nom','membre','membre','membreTown','31337','membre@membre.com',Now(),Now(),'membre street','06b62ebef1e65ae4d8a4cf4c3fb4e33e38c6b556cb89d2e816b3a3facc2e3ab48cbf0b50b0a3dbe7df609ab7df816ed2aa75a275772b0e4a2271f7d94f76897d','13ZWUxZTkwMDdhNWYyYTA1','',0);
-- pauvre:membre
insert into MEMBRE VALUES(3, 'pauvre','LePauvre','membre','pauvre','pauvreTown','31337','pauvre@membre.com',Now(),Now(),'pauvre street','06b62ebef1e65ae4d8a4cf4c3fb4e33e38c6b556cb89d2e816b3a3facc2e3ab48cbf0b50b0a3dbe7df609ab7df816ed2aa75a275772b0e4a2271f7d94f76897d','13ZWUxZTkwMDdhNWYyYTA1','',0);
-- philosophe:membre
insert into MEMBRE VALUES(4, 'philosophe','LePhilosophe','membre','philosophe','philoTown','31337','philo@membre.com',Now(),Now(),'philo street','06b62ebef1e65ae4d8a4cf4c3fb4e33e38c6b556cb89d2e816b3a3facc2e3ab48cbf0b50b0a3dbe7df609ab7df816ed2aa75a275772b0e4a2271f7d94f76897d','13ZWUxZTkwMDdhNWYyYTA1','',0);

insert into MESSAGE VALUES(1, 1, 2, 'Mahn Mahna', 'The question is, what is a Mahna Mahna ?', Now()-600, 1);
insert into MESSAGE VALUES(2, 2, 1, 'Re: Mahn Mahna', 'The question is, who cares ?', Now(), 0);
insert into MESSAGE VALUES(3, 1, 4, 'Les hommes', 'J''ai un profond respect pour le mépris que j''ai des hommes', Now()-300, 0);
insert into MESSAGE VALUES(4, 1, 3, 'Les pauvres', 'Les pauvres depuis le début de l''humanité ont toujours eu des goûts simples.', Now()-800, 0);
