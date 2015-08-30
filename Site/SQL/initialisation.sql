USE nf17;
DELETE FROM authent;
DELETE FROM club;
DELETE FROM Karateka;
ALTER TABLE Karateka AUTO_INCREMENT = 1;
DELETE FROM Kata;
DELETE FROM KataKarateka;
DELETE FROM Mouvement;
DELETE FROM MvtKata;
DELETE FROM Categorie;
DELETE FROM CategorieMvts;
DELETE FROM competition;
DELETE FROM Photographie;
DELETE FROM Confrontation;
DELETE FROM Points;
DELETE FROM coupsInterdits;



INSERT INTO authent(login, password, type_util) VALUES ('admin', 'admin', 'administrateur');

INSERT INTO authent(login, password, type_util) VALUES ('club_dojo_paris', 'admin', 'club');
INSERT INTO club(login, nom, telephone, site) VALUES ('club_dojo_paris', 'dojo_paris', '0315784932', 'www.dojo_paris.com');

INSERT INTO authent(login, password, type_util) VALUES ('club_karateland', 'admin', 'club');
INSERT INTO club(login, nom, telephone, site) VALUES ('club_karateland', 'karateland', '0456123754', 'www.dojo_karate.com');

INSERT INTO authent(login, password, type_util) VALUES ('club_dojo_sombre', 'admin', 'club');
INSERT INTO club(login, nom, telephone, site) VALUES ('club_dojo_sombre', 'dojo_sombre', '0238451349', 'www.dojoS.com');


INSERT INTO Karateka(nom, age, poids, taille, ceinture, dan, loginclub)
    VALUES ('thomas', 20, 70, 170, 'rouge', 5, 'club_dojo_paris');
INSERT INTO Karateka(nom, age, poids, taille, ceinture, dan, loginclub)
    VALUES ('jeoffrey', 22, 80, 150, 'jaune', 4, 'club_karateland');
INSERT INTO karateka(nom, age, poids, taille, ceinture, dan, loginclub)
    VALUES ('fabrice', 25, 90, 190, 'rouge', 5, 'club_karateland');
INSERT INTO Karateka(nom, age, poids, taille, ceinture, dan, loginclub)
    VALUES ('jean-jacques', 50, 130, 180, 'blanche', 2, 'club_dojo_sombre');


INSERT INTO Kata (nom, description, ceinture_coresp, grade_coresp) VALUES ('karajoki', 'WUT ?!', 'rouge', 5);
INSERT INTO Kata (nom, description, ceinture_coresp, grade_coresp) VALUES ('taokwo', 'wohhhh...', 'jaune', 4);
INSERT INTO Kata (nom, description, ceinture_coresp, grade_coresp) VALUES ('kabazk', 'heu...', 'blanche', 2);



INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('karajoki', 1);
INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('kabazk', 1);

INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('taokwo', 2);
INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('kabazk', 2);

INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('kabazk', 3);
INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('taokwo', 3);
INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('karajoki', 3);

INSERT INTO KataKarateka(nomkata,idkarateka) VALUES ('karajoki', 4);



INSERT INTO Mouvement(nom,traduction) VALUES ('waza!', 'devine');
INSERT INTO Mouvement(nom) VALUES ('wohooo!');
INSERT INTO Mouvement(nom) VALUES ('ahhhh!');
INSERT INTO Mouvement(nom) VALUES ('plop');



INSERT INTO MvtKata(nomkata,nommouvement,ordremouvement) VALUES ('karajoki','waza!',1);
INSERT INTO MvtKata(nomkata,nommouvement,ordremouvement) VALUES ('karajoki','wohooo!',2);
INSERT INTO MvtKata(nomkata,nommouvement,ordremouvement) VALUES ('karajoki','plop',3);

INSERT INTO MvtKata(nomkata,nommouvement,ordremouvement) VALUES ('kabazk','wohooo!',1);
INSERT INTO MvtKata(nomkata,nommouvement,ordremouvement) VALUES ('kabazk','plop',2);

INSERT INTO MvtKata(nomkata,nommouvement,ordremouvement) VALUES ('taokwo','plop',1);



INSERT INTO Categorie(nom) VALUES('une_cat');
INSERT INTO Categorie(nom) VALUES('une_autre_cat');
INSERT INTO Categorie(nom) VALUES('une_enieme_cat');




INSERT INTO CategorieMvts(nommouvement,nomcategorie) VALUES ('waza!','une_cat');
INSERT INTO CategorieMvts(nommouvement,nomcategorie) VALUES ('waza!','une_autre_cat');
INSERT INTO CategorieMvts(nommouvement,nomcategorie) VALUES ('wohooo!','une_autre_cat');
INSERT INTO CategorieMvts(nommouvement,nomcategorie) VALUES ('ahhhh!','une_cat');
INSERT INTO CategorieMvts(nommouvement,nomcategorie) VALUES ('plop','une_enieme_cat');



INSERT INTO competition(date, nom, lieu, contact, loginclub, typeCompetition)
    VALUES ('2015-06-05', 'ma_premiere', 'compicity', '0689821231', 'club_dojo_paris', 'kata');
INSERT INTO competition(date, nom, lieu, contact, loginclub, typeCompetition)
    VALUES ('2015-05-25', 'une_compet', 'paris', '0348484546', 'club_karateland', 'kata');
INSERT INTO competition(date, nom, lieu, contact, loginclub, typeCompetition)
    VALUES ('2015-06-10', 'gilet_parballe', 'marseille', '0644521231', 'club_dojo_sombre', 'kumite');
    


INSERT INTO Photographie(url, datecompetition, nomcompetition) VALUES ('maphoto.fr','2015-06-05', 'ma_premiere');
INSERT INTO Photographie(url, datecompetition, nomcompetition) VALUES ('maphoto2.fr','2015-06-10', 'gilet_parballe');



INSERT INTO Confrontation(date, datecompetition, nomcompetition, numerotour, part1, part2, gagnant, perdant, scoregagnant,scoreperdant)
    VALUES ('2015-06-05', '2015-06-05', 'ma_premiere', 1, 1, 2, 1, 2, 20, 10);
INSERT INTO Confrontation(date, datecompetition, nomcompetition, numerotour, part1, part2, gagnant, perdant, scoregagnant,scoreperdant)
    VALUES ('2015-06-06', '2015-06-05', 'ma_premiere', 1, 3, 4, 4, 3, 50, 5);
INSERT INTO Confrontation(date, datecompetition, nomcompetition, numerotour, part1, part2, gagnant, perdant, scoregagnant,scoreperdant)
    VALUES ('2015-06-05', '2015-06-05', 'ma_premiere', 2, 1, 4, 1, 4, 30, 25);
INSERT INTO Confrontation(date, datecompetition, nomcompetition, numerotour, part1, part2)
    VALUES ('2015-06-05', '2015-05-25', 'une_compet', 1, 3, 2);




INSERT INTO Points(nomcategorie,datecompetition,nomcompetition,points) VALUES ('une_cat', '2015-06-05', 'ma_premiere', 5);
INSERT INTO Points(nomcategorie,datecompetition,nomcompetition,points) VALUES ('une_enieme_cat', '2015-06-05', 'ma_premiere', 1);
INSERT INTO Points(nomcategorie,datecompetition,nomcompetition,points) VALUES ('une_cat', '2015-05-25', 'une_compet', 10);
INSERT INTO Points(nomcategorie,datecompetition,nomcompetition,points) VALUES ('une_autre_cat', '2015-05-25', 'une_compet', 1);


INSERT INTO coupsInterdits(nomcategorie, datecompetition, nomcompetition) VALUES ('une_enieme_cat','2015-05-25', 'une_compet');
INSERT INTO coupsInterdits(nomcategorie, datecompetition, nomcompetition) VALUES ('une_autre_cat','2015-06-05', 'ma_premiere');


