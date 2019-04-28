
/* product */
INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Beurre de Karite", "img7.jpg", 0, "Action reparatrice", 12.00);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Petale de rose", "img5.jpg", 0, "Action reparatrice", 21.00);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Huile de lavande", "img16.jpg", 0, "Apportent leurs vertus curatives et leurs precieux aromes pour embellir votre peau.", 21.22);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Oleo-serum Harmonie Couperose et Rosacee", "img13.jpg", 1, "Peau couperosee et rosacee", 9.22);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Oleo-serum equilibre peau grasse et acneique", "img11.jpg", 1, "Cette mousse micellaire naturelle aux eaux florales de rose et d'orange nettoie et demaquille votre peau tout en douceur.", 32.00);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Nettoyant micellaire 'mousse radieuse'", "img10.jpg", 1, "Action reparatrice", 10.00);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Sel de l'Himalaya", "img12.jpg", 0, "riche en plus de 80 mineraux, il est regenerant et detoxifiant", 88.22);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Formation sur les etiquettes", "img3.jpg", 1, "Action reparatrice", 22.83);

INSERT INTO product(name, image_path, is_sellable, description, price)
VALUES("Gant de crain", "img4.jpg", 1, "Action reparatrice", 2.78);



/* recipe */
INSERT INTO recipe(id_product, name, is_custom, steps) 
VALUES(1, "B barbe lavande", 0, "1- Melanger la farine 2- Ajouter les herbes");

INSERT INTO recipe(id_product, name, is_custom, steps) 
VALUES(2, "B barbe sapin", 0, "1- Melanger la farine 2- Ajouter les herbes");

INSERT INTO recipe(id_product, name, is_custom, steps) 
VALUES(3, "Parfum rose", 1, "1- Melanger la farine 2- Ajouter les herbes 3- Sentir");

INSERT INTO recipe(id_product, name, is_custom, steps) 
VALUES(4, "Beurre mercure", 0, "1- Melanger la farine 2- Ajouter les herbes");

INSERT INTO recipe(id_product, name, is_custom, steps) 
VALUES(5, "Savon blanc", 0, "1- Melanger la farine 2- Ajouter les herbes");

INSERT INTO recipe(id_product, name, is_custom, steps) 
VALUES(6, "Creme main orange", 1, "1- Melanger la farine 2- Ajouter les herbes");

/* ta_recipe_product */
INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
VALUES(1,1,5);

INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
VALUES(1,3,23);

INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
VALUES(1,5,0.5);

INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
VALUES(2,1,11);

INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
VALUES(5,4,0.1);

INSERT INTO ta_recipe_product(id_recipe, id_product, qty_ml)
VALUES(5,5,22);


/* Products */


/* Table Produit */
INSERT INTO Product VALUES 
(DEFAULT,"Atelier comment décoder les étiquettes","img1.jpg",1,"Cancer, baisse de la fertilité, Alzheimer… Et si nos produits de beauté nous empoisonnaient ?

 Vous souhaitez apprendre à décrypter les étiquettes des produits cosmétiques conventionnels afin de connaitre les ingrédients nocifs pour votre peau et votre santé?

 

-Vous aimeriez comprendre la composition des cosmétiques conventionnels et prendre vote beauté en main?

-Vous voulez passer au bio et comprendre comment choisir les cosmétiques adaptés à votre peau ?

 

Lors de cet atelier de 2 heures, vous apprendrez à  :

-Décoder la composition des cosmétiques 

-Quelle est la liste des produits à éviter et leurs effets sur l'organisme

-Découvrir quels sont les vrais besoins de votre peau

-Découvrir ce qu'est la dermocosmétique naturelle et quels sont les bons ingrédients à choisir pour prendre soin de votre peau. ",25.00,30),


(DEFAULT,"Forfait Consultation en dermocosmétique naturelle + Sérum personnalisé","images/imgProducts/img2.jpg",1,"Vos problèmes de peau (couperose, dermatite atopique, eczema...) vous empoisonnent la vie? Vous avez essayé tous les traitements possibles mais cherchez une solution naturelle? Vous etes prets a changer votre routine de soins et cherchez une solution efficace, naturelle, juste pour vous? 

Prenez rendez-vous pour une consultation et un sérum personnalisé. Nous établirons ensemble un protocole de soins simple et efficace, a base d'ingrédients naturels pour vous aider à rééquilibrer votre peau.",120.00,30),


(DEFAULT,"Sérum personnalisé","default.jpg",1,"",90.00,20),
(DEFAULT,"Consultation 1 heure en dermo cosmétique naturelle","img3.jpg",0,"Consultation d'environ 1 heure pour discuter de vos problèmes de peau 

- Bilan de vos besoins et établissement de la formule personnalisée 

- Recommandations et protocole de soins adapté a votre problématique

- Sur rendez-vous en personne ou par Skype

- Rendez-vous de suivi gratuit un mois aprés pour évaluer vos progrès",60.00,30),


(DEFAULT,"Gant de kessa exfoliant","img4.jpg",1,"",12.00,7),


(DEFAULT,"Eau rééquilibrante","img5.jpg",1,"Composée de trois hydrolats anti-inflammatoires, cette eau rééquilibrante est à appliquer impérativement après le liniment pour rééquilibrer le ph de la peau. La camomille, la rose de damas et l'eau de bleuet viennent calmer l'irritation et les rougeurs des peaux sensibles et irritées. C'est le complément indispensable à votre routine de soin pour retrouver une peau en santé! ",20.00,8),


(DEFAULT,"Liniment démaquillant peau sensible","img6.jpg",1,"Doux et efficace pour les peaux sensibles!

Le liniment Oleocalcaire démaquillant est le must pour les peaux sensibles et irritées. Bien connu en Europe pour le soin des peaux fragiles des bébés, il démaquille et nettoie en douceur les épidermes les plus fragiles. Composé à 100% d'huiles végétales  précieuses bio, il nettoie, nourrit et hydrate l'épiderme tout en douceur. A utiliser avec nos hydrolats rééquilibrants!",20.00,5),


(DEFAULT,"Beurre de karité brut de Cote d'Ivoire Sauvage 200 g","img7.jpg",1,"Découvrez notre trésor d'Afrique ! Ce beurre de karité brut filtré provient d'un petit village de Cote d'Ivoire.  Les noix de karité sont ramassées en brousse puis transformées de facon artisanale par les femmes Ivoiriennes. Ce beurre est d'une qualité exceptionnelle. Sa couleur ivoire, sa texture crémeuse et son odeur douce sont la signature de notre beurre de karité, connu pour nourrir et hydrater intensément la peau. ",17.00,4),


(DEFAULT,"Duo clin d'oeil","img8.jpg",1,"Vous adorerez le duo contour de l'oeil Clin D'oeil. Le sérum gel Jour à la texture fluide légère est hydratant et tenseur. Les hydrolats d et l'extrait de bourgeon de hetre lissent instantanément le contour de l.oeil et défatiguent le regard. 

L'huile régénérante nuit à la précieuse huile essentielle d'immortelle de Corse, aussi connue sous le nom d'Hélichryse Italienne, nourrit cette zone fragile et agit en profondeur, tandis que l'huile de foraha et ce chanvre stimulent la microcirculation.

Vous pouvez aussi appliquer le gel et l'huile ensemble, pour un effet optimal!",55.00,1),


(DEFAULT,"Oléo-Sérum Clarté Anti-taches brunes","img9.jpg",1,"L'oléosérum Clarté contribue à réduire les taches pigmentaires grace à un actif naturel: l'arbutine contenu dans le macérat de busserole, qui régule la production de mélanine à l'origine des taches pigmentaires.

 Les huiles essentielles dépigmentantes qu'il contient accroissent l'efficacité de ce sérum. A utiliser seul ou en duo avec le sérum tenseur. Protéger impérativement la peau du soleil.",50.00,1),


(DEFAULT,"Oléo-sérum Équilibre peau grasse et acnéique","img10.jpg",1,"L'acné vous gâche la vie et vous souhaitez une alternative naturelle aux traitements agressifs pour votre peau? L'oléo-sérum Équilibre aide votre peau à se rééquilibrer naturellement  et en douceur grace aux propriétés équilibrantes et assainissantes. Combinez le avec le nettoyant micellaire sans rinçage et le savon au moringa pour une action optimale.",50.00,6),

(DEFAULT,"Oléo-sérum Harmonie Couperose et Rosacée","img11.jpg",1,"Vous souffrez de couperose ou de rosacée et souhaitez une alternative naturelle? L'Oléo-sérum Harmonie calme l'inflammation et les rougeurs grâce à un puissant complexe d'huiles végétales précieuses, riches en Omégas 3 et 9 qui apaisent l'inflammation de votre peau! Les huiles végétales de chanvre et tamanu en particulier apportent leurs propriétés apaisantes et anti-inflammatoires pour un soin apaisant 100% actif et naturel, allié à la précieuse Huile essentielle d' immortelle de Corse, connue aussi sous le nom d'Hélychrise italienne, et de camomille, anti-inflammatoire.",50.00,100),
(DEFAULT,"Sérum Régénération anti-age aux 5 huiles précieuses","img12.jpg",1,"Découvrez notre merveilleux soin anti-age aux 5 huiles précieuses! Un vrai trésor liquide, gorgé d'acides gras omégas 3, 6 et 9, essentiels pour votre peau! la peau est régénérée, souple et douce.",50.00,8),
(DEFAULT,"Savon peaux sensibles moringa et calendule","img13.jpg",1,"Savon doux aux huiles végétales de moringa et de calendule, pour peaux sensibles",7.00,12),
(DEFAULT,"Savon Exfoliant moringa et abricot","img14.jpg",1,"Savon exfoliant doux, moringa calendule et graines d'Abricot",8.00,5),
(DEFAULT,"Shampoing au moringa et karité cheveux secs","img15.jpg",1,"Ce shampoing doux enrichi en huile de moringa et karité est un plaisir pour les cheveux secs.  Il nettoie vos cheveux en douceur et les rend doux et faciles à coiffer. Les huiles essentielles de lavande et romarin apportent leurs propriétés apaisantes et fortifiantes à ce soin. Nos shampoings sont sans agents toxiques ou parfums chimiques, ils sont excellents pour tous types de cheveux.",13.00,2);
