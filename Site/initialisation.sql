INSERT INTO authent(login, password) VALUES ('admin', 'admin');


INSERT INTO club(nom,coordonneesDirigeant,site) VALUES ('le_club_a_toto', 'compicity', 'nf17');
INSERT INTO club(nom,coordonneesDirigeant,site) VALUES ('le_club_a_jojo', 'marseille', 'kalash');
INSERT INTO club(nom,coordonneesDirigeant,site) VALUES ('le_club_a_momo', 'paris', 'parisestmagique');


INSERT INTO Karateka(nom, age, poids, taille, ceinture, dan, nomClub, coordonneesDirigeantClub)
    VALUES ('toto', 20, 70, 170, 'rouge', 5, 'le_club_a_toto', 'compicity');
INSERT INTO Karateka(nom, age, poids, taille, ceinture, dan, nomClub, coordonneesDirigeantClub)
    VALUES ('jojo', 22, 80, 150, 'jaune', 4, 'le_club_a_jojo', 'marseille');
INSERT INTO karateka(nom, age, poids, taille, ceinture, dan, nomClub, coordonneesDirigeantClub)
    VALUES ('titi', 25, 90, 190, 'rouge', 5, 'le_club_a_jojo', 'marseille');
INSERT INTO Karateka(nom, age, poids, taille, ceinture, dan, nomClub, coordonneesDirigeantClub)
    VALUES ('momo', 50, 130, 180, 'blanche', 2, 'le_club_a_momo', 'paris');



INSERT INTO Kata (nom,description,ceinture_coresp,grade_coresp) VALUES ('le_kata_des_plus_forts', 'WUT ?!', 'rouge', 5);
INSERT INTO Kata (nom,description,ceinture_coresp,grade_coresp) VALUES ('le_kata_des_jolis', 'wohhhh...', 'jaune', 4);
INSERT INTO Kata (nom,description,ceinture_coresp,grade_coresp) VALUES ('le_kata_des_autres', 'heu...', 'blanche', 2);


INSERT INTO Video (url,nomKata) VALUES ('lesplusforts.com', 'le_kata_des_plus_forts');
INSERT INTO Video (url,nomKata) VALUES ('nimportequoi.com', 'le_kata_des_autres');



INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_jolis', 1);
INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_autres', 1);

INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_jolis', 2);
INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_autres', 2);

INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_plus_forts', 3);
INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_jolis', 3);
INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_autres', 3);

INSERT INTO KataKarateka(nomKata,idKarateka) VALUES ('le_kata_des_autres', 4);



INSERT INTO Mouvement(nom,traduction) VALUES ('waza!', 'devine');
INSERT INTO Mouvement(nom) VALUES ('wohooo!');
INSERT INTO Mouvement(nom) VALUES ('ahhhh!');
INSERT INTO Mouvement(nom) VALUES ('plop');



INSERT INTO MvtKata(nomKata,nomMouvement,ordreMouvement) VALUES ('le_kata_des_plus_forts','waza!',1);
INSERT INTO MvtKata(nomKata,nomMouvement,ordreMouvement) VALUES ('le_kata_des_plus_forts','wohooo!',2);
INSERT INTO MvtKata(nomKata,nomMouvement,ordreMouvement) VALUES ('le_kata_des_plus_forts','plop',3);

INSERT INTO MvtKata(nomKata,nomMouvement,ordreMouvement) VALUES ('le_kata_des_jolis','wohooo!',1);
INSERT INTO MvtKata(nomKata,nomMouvement,ordreMouvement) VALUES ('le_kata_des_jolis','plop',2);

INSERT INTO MvtKata(nomKata,nomMouvement,ordreMouvement) VALUES ('le_kata_des_autres','plop',1);



INSERT INTO Categorie(nom) VALUES('une_cat');
INSERT INTO Categorie(nom) VALUES('une_autre_cat');
INSERT INTO Categorie(nom) VALUES('une_enieme_cat');




INSERT INTO CategorieMvts(nomMouvement,nomCategorie) VALUES ('waza!','une_cat');
INSERT INTO CategorieMvts(nomMouvement,nomCategorie) VALUES ('waza!','une_autre_cat');
INSERT INTO CategorieMvts(nomMouvement,nomCategorie) VALUES ('wohooo!','une_autre_cat');
INSERT INTO CategorieMvts(nomMouvement,nomCategorie) VALUES ('ahhhh!','une_cat');
INSERT INTO CategorieMvts(nomMouvement,nomCategorie) VALUES ('plop','une_enieme_cat');



INSERT INTO competition(date, nom,lieu,contact,clubNom ,clubCoordonneesDirigeant,typeCompetition)
    VALUES ('05/06/2015', 'ma_premiere', 'compicity', '0689821231', 'le_club_a_toto', 'compicity', 'kata');
INSERT INTO competition(date, nom,lieu,contact,clubNom ,clubCoordonneesDirigeant,typeCompetition)
    VALUES ('25/05/2015', 'une_compet', 'paris', '0348484546', 'le_club_a_momo', 'paris', 'kata');
INSERT INTO competition(date, nom,lieu,contact,clubNom ,clubCoordonneesDirigeant,typeCompetition)
    VALUES ('10/06/2015', 'gilet_parballe', 'marseille', '0644521231', 'le_club_a_jojo', 'marseille', 'kumite');
    


INSERT INTO Photographie(url,dateCompetition,nomCompetition) VALUES ('maphoto.fr','05/06/2015', 'ma_premiere');
INSERT INTO Photographie(url,dateCompetition,nomCompetition) VALUES ('maphoto2.fr','10/06/2015', 'gilet_parballe');



INSERT INTO Confrontation(date, dateCompetition, nomCompetition, numeroTour, part1, part2, gagnant, perdant, scoreGagnant,scorePerdant)
    VALUES ('05/06/2015', '05/06/2015', 'ma_premiere', 1, 1, 2, 1, 2, 20, 10);
INSERT INTO Confrontation(date, dateCompetition, nomCompetition, numeroTour, part1, part2, gagnant, perdant, scoreGagnant,scorePerdant)
    VALUES ('06/06/2015', '05/06/2015', 'ma_premiere', 1, 3, 4, 4, 3, 50, 5);
INSERT INTO Confrontation(date, dateCompetition, nomCompetition, numeroTour, part1, part2, gagnant, perdant, scoreGagnant,scorePerdant)
    VALUES ('05/06/2015', '05/06/2015', 'ma_premiere', 2, 1, 4, 1, 4, 30, 25);
INSERT INTO Confrontation(date, dateCompetition, nomCompetition, numeroTour, part1, part2)
    VALUES ('05/06/2015', '25/05/2015', 'une_compet', 1, 3, 2);




INSERT INTO Points(nomCategorie,dateCompetition,nomCompetition,points) VALUES ('une_cat', '05/06/2015', 'ma_premiere', 5);
INSERT INTO Points(nomCategorie,dateCompetition,nomCompetition,points) VALUES ('une_enieme_cat', '05/06/2015', 'ma_premiere', 1);
INSERT INTO Points(nomCategorie,dateCompetition,nomCompetition,points) VALUES ('une_cat', '25/05/2015', 'une_compet', 10);
INSERT INTO Points(nomCategorie,dateCompetition,nomCompetition,points) VALUES ('une_autre_cat', '25/05/2015', 'une_compet', 1);


INSERT INTO coupsInterdits(nomCategorie, dateCompetition, nomCompetition) VALUES ('une_enieme_cat','25/05/2015', 'une_compet');
INSERT INTO coupsInterdits(nomCategorie, dateCompetition, nomCompetition) VALUES ('une_autre_cat','05/06/2015', 'ma_premiere');



