DROP VIEW IF EXISTS competitionKumite CASCADE;
DROP VIEW IF EXISTS competitionKata CASCADE;
DROP VIEW IF EXISTS competitionTameshi CASCADE;
DROP TABLE IF EXISTS authent CASCADE;
DROP TABLE IF EXISTS Club CASCADE;
DROP TABLE IF EXISTS Karateka CASCADE;
DROP TABLE IF EXISTS Kata CASCADE;
DROP TABLE IF EXISTS Video CASCADE;
DROP TABLE IF EXISTS KataKarateka CASCADE;
DROP TABLE IF EXISTS Mouvement CASCADE;
DROP TABLE IF EXISTS MvtKata CASCADE;
DROP TABLE IF EXISTS Categorie CASCADE;
DROP TABLE IF EXISTS CategorieMvts CASCADE;
DROP TABLE IF EXISTS competition CASCADE;
DROP TABLE IF EXISTS Photographie CASCADE;
DROP TABLE IF EXISTS Confrontation CASCADE;
DROP TABLE IF EXISTS Points CASCADE;
DROP TABLE IF EXISTS coupsInterdits CASCADE;
DROP TYPE IF EXISTS TYPE_UTIL CASCADE;
DROP TYPE IF EXISTS TYPECOMPETITION CASCADE;
DROP TYPE IF EXISTS CEINTURE CASCADE;
DROP SEQUENCE IF EXISTS id_karateka;


CREATE TYPE TYPE_UTIL AS ENUM('administrateur', 'club');

CREATE SEQUENCE id_karateka START WITH 1 INCREMENT BY 1;


CREATE TABLE authent(
	login character(128) PRIMARY KEY,
	password character(128) NOT NULL
);


CREATE TABLE Club(
	nom character(128) NOT NULL,
	coordonneesDirigeant character(128) NOT NULL,
	site character(128) NOT NULL,
	PRIMARY KEY (nom, coordonneesDirigeant)
);

CREATE TYPE CEINTURE AS ENUM('blanche', 'jaune', 'orange', 'verte', 'bleue', 'marron', 'noire', 'rougeblanche', 'rouge');

CREATE TABLE Karateka(
	id INTEGER DEFAULT nextval('id_karateka') PRIMARY KEY,
	nom character(128) NOT NULL,
	age INTEGER NOT NULL,
	poids INTEGER NOT NULL,
	taille INTEGER NOT NULL,
	ceinture CEINTURE,
	dan INTEGER NOT NULL,
	photo VARCHAR(128),
	nomClub character(128) ,		
	coordonneesDirigeantClub character(128),
	FOREIGN KEY (nomClub, coordonneesDirigeantClub) REFERENCES Club(nom,coordonneesDirigeant) ON DELETE CASCADE
);

CREATE TABLE Kata (
	nom character(128) PRIMARY KEY,
	traduction character(128),
	description character(128) NOT NULL,
	famille character(128),
	ceinture_coresp character(128),
	grade_coresp INTEGER,
	schema character(128)
);



CREATE TABLE Video (
	url character(128) NOT NULL PRIMARY KEY,
	nomKata character(128) NOT NULL REFERENCES kata (nom) ON DELETE CASCADE
);


CREATE TABLE KataKarateka(
	nomKata VARCHAR(128) NOT NULL,
	idKarateka INTEGER NOT NULL,
	CONSTRAINT KataKarateka_pk
		PRIMARY KEY (nomKata, idKarateka),
	CONSTRAINT fk_kata
		FOREIGN KEY (nomKata)
		REFERENCES Kata (nom)
	ON DELETE CASCADE,
	CONSTRAINT fk_karateka
		FOREIGN KEY (idKarateka)
		REFERENCES Karateka (id)
	ON DELETE CASCADE
);

CREATE TABLE Mouvement(
	nom character(128) PRIMARY KEY,
	traduction character(128)
);

CREATE TABLE MvtKata(
	nomKata character(128),
	nomMouvement character(128),
	ordreMouvement INTEGER NOT NULL,
	CONSTRAINT mvtKata_pk 
		PRIMARY KEY (nomKata, nomMouvement),
	CONSTRAINT fk_Kata
		FOREIGN KEY (nomKata)
		REFERENCES Kata (nom)
	ON DELETE CASCADE
);


CREATE TABLE Categorie(
	nom character(128),
	CONSTRAINT Categorie_pk 
		PRIMARY KEY (nom)

);


CREATE TABLE CategorieMvts(
	nomMouvement character(128),
	nomCategorie character(128),
	CONSTRAINT CategorieMvts_pk 
		PRIMARY KEY (nomMouvement, nomCategorie),
	CONSTRAINT fk_Mouvement 
		FOREIGN KEY (nomMouvement)
		REFERENCES Mouvement (nom)
	ON DELETE CASCADE,
	CONSTRAINT fk_Categorie 
		FOREIGN KEY (nomCategorie)
		REFERENCES Categorie (nom) 
	ON DELETE CASCADE
);

CREATE TYPE TYPECOMPETITION AS ENUM('kumite', 'kata', 'tameshi', 'libre');
	

CREATE TABLE competition(
	date DATE, 
	nom character(128),
	lieu character(128),
	site character(128),
	contact character(128),
	clubNom character(128) NOT NULL,
	clubCoordonneesDirigeant character(128) NOT NULL,
	typeCompetition TYPECOMPETITION,
	CONSTRAINT competitionKumite_pk PRIMARY KEY (date, nom),
	CONSTRAINT fk_club FOREIGN KEY (clubNom,clubCoordonneesDirigeant) REFERENCES club(nom,coordonneesDirigeant) ON DELETE CASCADE
);

CREATE VIEW competitionKumite AS
	SELECT date, nom, lieu, site, contact, clubNom,clubCoordonneesDirigeant
	FROM competition
	WHERE competition.typeCompetition = 'kumite';

CREATE VIEW competitionKata AS
	SELECT date, nom, lieu, site, contact, clubNom,clubCoordonneesDirigeant
	FROM competition
	WHERE competition.typeCompetition = 'kata'
;

CREATE VIEW competitionTameshi AS
	SELECT date, nom, lieu, site, contact, clubNom,clubCoordonneesDirigeant
	FROM competition
	WHERE competition.typeCompetition = 'tameshi'
;


CREATE TABLE Photographie(
	url character(128) PRIMARY KEY,
	dateCompetition DATE NOT NULL,
	nomCompetition character(128) NOT NULL,
	CONSTRAINT fk_competition
		FOREIGN KEY (dateCompetition, nomCompetition)
		REFERENCES competition (date, nom)
	ON DELETE CASCADE
);


CREATE TABLE Confrontation(
	date DATE NOT NULL,
	dateCompetition DATE NOT NULL,
	nomCompetition character(128) NOT NULL,
	numeroTour INTEGER ,
	gagnant INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	perdant INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	scoreGagnant INTEGER ,
	scorePerdant INTEGER ,
	part1 INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	part2 INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	CONSTRAINT confrontation_pk
		PRIMARY KEY (part1,part2,numeroTour, nomCompetition, dateCompetition), -- modification
	CONSTRAINT fk_competition
		FOREIGN KEY (dateCompetition, nomCompetition)
		REFERENCES competition (date, nom)
	ON DELETE CASCADE
);

DROP TRIGGER IF EXISTS perdant_auto ON Confrontation;
DROP FUNCTION IF EXISTS set_perdant();

CREATE OR REPLACE FUNCTION set_perdant() RETURNS TRIGGER AS $set_perdant$
BEGIN
	IF NEW.gagnant = NEW.part1 THEN
		NEW.perdant := NEW.part2;
		
	ELSIF NEW.gagnant = NEW.part2 THEN 
		NEW.perdant := NEW.part1;
	END IF;
	RETURN NEW;
END;
$set_perdant$ LANGUAGE 'plpgsql';

CREATE  TRIGGER perdant_auto BEFORE UPDATE ON Confrontation
FOR EACH ROW 
EXECUTE PROCEDURE set_perdant() ;


CREATE TABLE Points(
	nomCategorie character(128),
	dateCompetition DATE,
	nomCompetition character(128),
	points INTEGER NOT NULL,
	CONSTRAINT points_pk
		PRIMARY KEY (nomCategorie, nomCompetition),
	CONSTRAINT fk_Categorie
		FOREIGN KEY (NomCategorie)
		REFERENCES Categorie (nom)
	ON DELETE CASCADE,
	CONSTRAINT fk_competition
		FOREIGN KEY (dateCompetition, nomCompetition)
		REFERENCES Competition (date, nom)
	ON DELETE CASCADE
);


CREATE TABLE coupsInterdits(
	nomCategorie character(128),
	dateCompetition date,
	nomCompetition character(128),
	CONSTRAINT coupsInterdits_pk
		PRIMARY KEY (nomCategorie, nomCompetition, dateCompetition),
	CONSTRAINT fk_competition
		FOREIGN KEY (dateCompetition,nomCompetition)
		REFERENCES competition (date,nom)
	ON DELETE CASCADE,
	CONSTRAINT fk_categorie
		FOREIGN KEY (nomCategorie)
		REFERENCES categorie (nom)
	ON DELETE CASCADE
);
