DROP DATABASE IF EXISTS nf17;
CREATE DATABASE nf17 CHARACTER SET utf8;
USE nf17;

CREATE TABLE authent(
	login character(128) PRIMARY KEY,
	password character(128) NOT NULL,
    type_util ENUM('administrateur', 'club')
);

CREATE TABLE Club(
	nom character(128) NOT NULL,
    password character(128) NOT NULL,
	telephone character(10),
	site character(128),
	PRIMARY KEY (nom, telephone)
);

CREATE TABLE Karateka(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom character(128) NOT NULL,
	age INTEGER NOT NULL,
	poids INTEGER NOT NULL,
	taille INTEGER NOT NULL,
	ceinture ENUM('blanche', 'jaune', 'orange', 'verte', 'bleue', 'marron', 'noire', 'rougeblanche', 'rouge'),
	dan INTEGER NOT NULL,
	photo VARCHAR(128),
	nomclub character(128),		
	telclub character(128),
	FOREIGN KEY (nomclub, telclub) REFERENCES Club(nom,telephone) ON DELETE CASCADE
)ENGINE = InnoDB
;

CREATE TABLE Kata(
	nom character(128) PRIMARY KEY,
	traduction character(128),
	description character(128) NOT NULL,
	famille character(128),
	ceinture_coresp character(128),
	grade_coresp INTEGER,
	illustration character(128)
);

CREATE TABLE KataKarateka(
	nomkata VARCHAR(128) NOT NULL,
	idkarateka INT UNSIGNED NOT NULL,
	CONSTRAINT PRIMARY KEY (nomkata, idkarateka),
	CONSTRAINT FOREIGN KEY (nomkata) REFERENCES Kata(nom) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (idkarateka) REFERENCES Karateka(id) ON DELETE CASCADE
)ENGINE = InnoDB
;

CREATE TABLE Mouvement(
	nom character(128) PRIMARY KEY,
	traduction character(128)
);

CREATE TABLE MvtKata(
	nomkata character(128),
	nommouvement character(128),
	ordremouvement INTEGER NOT NULL,
	CONSTRAINT PRIMARY KEY (nomkata, nommouvement),
	CONSTRAINT FOREIGN KEY (nomkata) REFERENCES Kata(nom) ON DELETE CASCADE
)ENGINE = InnoDB
;


CREATE TABLE Categorie(
	nom character(128) PRIMARY KEY
);

CREATE TABLE CategorieMvts(
	nommouvement character(128),
	nomcategorie character(128),
	CONSTRAINT PRIMARY KEY (nommouvement, nomcategorie),
	CONSTRAINT FOREIGN KEY (nommouvement) REFERENCES Mouvement(nom) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (nomcategorie) REFERENCES Categorie(nom) ON DELETE CASCADE
)ENGINE = InnoDB
;

CREATE TABLE competition(
	date DATE, 
	nom character(128),
	lieu character(128),
	site character(128),
	contact character(128),
	nomclub character(128) NOT NULL,
	telclub character(128) NOT NULL,
	typecompetition ENUM('kumite', 'kata', 'tameshi', 'libre'),
	CONSTRAINT PRIMARY KEY (date, nom),
	CONSTRAINT FOREIGN KEY (nomclub, telclub) REFERENCES club(nom, telephone) ON DELETE CASCADE
)ENGINE = InnoDB
;

CREATE VIEW competitionKumite AS
	SELECT date, nom, lieu, site, contact, nomclub, telclub
	FROM competition
	WHERE competition.typecompetition = 'kumite';

CREATE VIEW competitionKata AS
	SELECT date, nom, lieu, site, contact, nomclub, telclub
	FROM competition
	WHERE competition.typecompetition = 'kata'
;

CREATE VIEW competitionTameshi AS
	SELECT date, nom, lieu, site, contact, nomclub, telclub
	FROM competition
	WHERE competition.typecompetition = 'tameshi'
;


CREATE TABLE Photographie(
	url character(128) PRIMARY KEY,
	datecompetition DATE NOT NULL,
	nomcompetition character(128) NOT NULL,
	CONSTRAINT FOREIGN KEY (datecompetition, nomcompetition) REFERENCES competition(date, nom) ON DELETE CASCADE
)ENGINE = InnoDB
;


CREATE TABLE Confrontation(
	date DATE NOT NULL,
	datecompetition DATE NOT NULL,
	nomcompetition character(128) NOT NULL,
	numerotour INTEGER ,
	gagnant INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	perdant INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	scoregagnant INTEGER,
	scoreperdant INTEGER,
	part1 INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	part2 INTEGER REFERENCES karateka(id) ON DELETE CASCADE,
	CONSTRAINT PRIMARY KEY (part1, part2, numerotour, nomcompetition, datecompetition),
	CONSTRAINT FOREIGN KEY (datecompetition, nomcompetition) REFERENCES competition(date, nom) ON DELETE CASCADE
)ENGINE = InnoDB
;

CREATE TABLE Points(
	nomcategorie character(128),
	datecompetition DATE,
	nomcompetition character(128),
	points INTEGER NOT NULL,
	CONSTRAINT PRIMARY KEY (nomcategorie, nomcompetition),
	CONSTRAINT FOREIGN KEY (nomcategorie) REFERENCES Categorie(nom) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (datecompetition, nomcompetition) REFERENCES Competition(date, nom) ON DELETE CASCADE
)ENGINE = InnoDB
;


CREATE TABLE coupsInterdits(
	nomcategorie character(128),
	datecompetition date,
	nomcompetition character(128),
	CONSTRAINT PRIMARY KEY (nomcategorie, nomcompetition, datecompetition),
	CONSTRAINT FOREIGN KEY (datecompetition, nomcompetition) REFERENCES competition(date,nom) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (nomcategorie) REFERENCES categorie (nom) ON DELETE CASCADE
)ENGINE = InnoDB
;
