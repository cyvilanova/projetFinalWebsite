
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
VALUES("Gant de crain", "img4.jpg", 1, "Action reparatrice", 2.78),

("Oléo-sérum Équilibre peau grasse et acnéique","img10.jpg",1,"L'acné vous gâche la vie et vous souhaitez une alternative naturelle aux traitements agressifs pour votre peau? L'oléo-sérum Équilibre aide votre peau à se rééquilibrer naturellement  et en douceur grace aux propriétés équilibrantes et assainissantes. Combinez le avec le nettoyant micellaire sans rinçage et le savon au moringa pour une action optimale.",50.00,6),

("Oléo-sérum Harmonie Couperose et Rosacée","images/imgProducts/img11.jpg",1,"Vous souffrez de couperose ou de rosacée et souhaitez une alternative naturelle? L'Oléo-sérum Harmonie calme l'inflammation et les rougeurs grâce à un puissant complexe d'huiles végétales précieuses, riches en Omégas 3 et 9 qui apaisent l'inflammation de votre peau! Les huiles végétales de chanvre et tamanu en particulier apportent leurs propriétés apaisantes et anti-inflammatoires pour un soin apaisant 100% actif et naturel, allié à la précieuse Huile essentielle d' immortelle de Corse, connue aussi sous le nom d'Hélychrise italienne, et de camomille, anti-inflammatoire.",50.00,100),
("Sérum Régénération anti-age aux 5 huiles précieuses","images/imgProducts/img12.jpg",1,"Découvrez notre merveilleux soin anti-age aux 5 huiles précieuses! Un vrai trésor liquide, gorgé d'acides gras omégas 3, 6 et 9, essentiels pour votre peau! la peau est régénérée, souple et douce.",50.00,8),
("Savon peaux sensibles moringa et calendule","images/imgProducts/img13.jpg",1,"Savon doux aux huiles végétales de moringa et de calendule, pour peaux sensibles",7.00,12),
("Savon Exfoliant moringa et abricot","images/imgProducts/img14.jpg",1,"Savon exfoliant doux, moringa calendule et graines d'Abricot",8.00,5),
("Shampoing au moringa et karité cheveux secs","images/imgProducts/img15.jpg",1,"Ce shampoing doux enrichi en huile de moringa et karité est un plaisir pour les cheveux secs.  Il nettoie vos cheveux en douceur et les rend doux et faciles à coiffer. Les huiles essentielles de lavande et romarin apportent leurs propriétés apaisantes et fortifiantes à ce soin. Nos shampoings sont sans agents toxiques ou parfums chimiques, ils sont excellents pour tous types de cheveux.",13.00,2);
("Oléo-sérum Harmonie Couperose et Rosacée","img11.jpg",1,"Vous souffrez de couperose ou de rosacée et souhaitez une alternative naturelle? L'Oléo-sérum Harmonie calme l'inflammation et les rougeurs grâce à un puissant complexe d'huiles végétales précieuses, riches en Omégas 3 et 9 qui apaisent l'inflammation de votre peau! Les huiles végétales de chanvre et tamanu en particulier apportent leurs propriétés apaisantes et anti-inflammatoires pour un soin apaisant 100% actif et naturel, allié à la précieuse Huile essentielle d' immortelle de Corse, connue aussi sous le nom d'Hélychrise italienne, et de camomille, anti-inflammatoire.",50.00,100),
("Sérum Régénération anti-age aux 5 huiles précieuses","img12.jpg",1,"Découvrez notre merveilleux soin anti-age aux 5 huiles précieuses! Un vrai trésor liquide, gorgé d'acides gras omégas 3, 6 et 9, essentiels pour votre peau! la peau est régénérée, souple et douce.",50.00,8),
("Savon peaux sensibles moringa et calendule","img13.jpg",1,"Savon doux aux huiles végétales de moringa et de calendule, pour peaux sensibles",7.00,12),
("Savon Exfoliant moringa et abricot","img14.jpg",1,"Savon exfoliant doux, moringa calendule et graines d'Abricot",8.00,5),
("Shampoing au moringa et karité cheveux secs","img15.jpg",1,"Ce shampoing doux enrichi en huile de moringa et karité est un plaisir pour les cheveux secs.  Il nettoie vos cheveux en douceur et les rend doux et faciles à coiffer. Les huiles essentielles de lavande et romarin apportent leurs propriétés apaisantes et fortifiantes à ce soin. Nos shampoings sont sans agents toxiques ou parfums chimiques, ils sont excellents pour tous types de cheveux.",13.00,2);
;


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



/* secret_question */
INSERT INTO secret_question(question)
VALUES("Quel était le nom de votre premier animal de compagnie?");

INSERT INTO secret_question(question)
VALUES("Quel est le nom de votre premier(e) meilleur(e) ami(e)?");

INSERT INTO secret_question(question)
VALUES("Quel était le nom de jeune fille de votre mère?");


/* user */
INSERT INTO `user`(id_question, username, password, email, secret_answer)
VALUES(1,"test","test123","warpaintingqc@gmail.com","chopin");

INSERT INTO `user`(id_question, username, password, email, secret_answer)
VALUES(2,"test","test","zebulon@gmail.com","corin");

INSERT INTO `user`(id_question, username, password, email, secret_answer)
VALUES(3,"AlloToi","byebye","lolnon@gmail.com","Audit");

INSERT INTO `user`(id_question, username, password, email, secret_answer)
VALUES(1,"admin","admin","dgailalrd@gmail.com","duchesse");


/* category */
INSERT INTO category(name,is_active,description)
VALUES("Peau douce",1,"Produits qui rends la peau douce.");

INSERT INTO category(name,is_active,description)
VALUES("Peau acide",1,"Produits pour la peau acide.");

INSERT INTO category(name,is_active,description)
VALUES("Rajeunissant",1,"Produits rajeunissant");

INSERT INTO category(name,is_active,description)
VALUES("Peau sensible",1,"Produits pour la peau sensible.");

INSERT INTO category(name,is_active,description)
VALUES("Peau mature",1,"Produits pour peau mature.");

INSERT INTO category(name,is_active,description)
VALUES("Nutritif",0,"Apporte les nutriments necessaires.");

INSERT INTO category(name,is_active,description)
VALUES("Peau seche",0,"Produits hydratants.");


/* state */
INSERT INTO state (name, description) 
VALUES ("Fermée", "Commande fermée");

INSERT INTO state (name, description) 
VALUES ("Ouverte", "Commande ouverte");

INSERT INTO state (name, description) 
VALUES ("Transit", "Commande en transit");

INSERT INTO state (name, description) 
VALUES ("En magasin", "Commande en magasin");

INSERT INTO state (name, description)
VALUES ("Payée","Commande payée");


/* shipping_company */
INSERT INTO shipping_company (name) 
VALUES ("UPS");

INSERT INTO shipping_company (name) 
VALUES ("Fedex");

INSERT INTO shipping_company (name) 
VALUES ("CanadaPost");


/* shipping_method*/
INSERT INTO shipping_method (id_company, name, price) 
VALUES (1, "Très rapide", 20.00);

INSERT INTO shipping_method (id_company, name, price) 
VALUES (1, "Normal", 10.00);

INSERT INTO shipping_method (id_company, name, price) 
VALUES (2, "Rapide", 15.00);

INSERT INTO shipping_method (id_company, name, price) 
VALUES (3, "Normal", 12.00);
  
 
/* client */
INSERT INTO client (name, address, city, province, postal_code) 
VALUES ("Edith Piaf", '14 Rue Alexandre', 'Sherbrooke', 'Québec', 'J2H4I9');

INSERT INTO client (name, address, city, province, postal_code) 
VALUES ("Céline Dion", '1 Rue Chanteuse', 'Magog', 'Québec', 'J3A5H8');

INSERT INTO client (name, address, city, province, postal_code) 
VALUES ("Éric Lapointe", '333 Boulevard Rock', 'St-Élie', 'Québec', 'J4H1D9');
  
  
/* order */
INSERT INTO `order` (id_client, id_user, id_state, id_method, tps, tvq, total) 
VALUES (1, 1, 1, 1, 10.00, 20.00, 50.00);

INSERT INTO `order` (id_client, id_user, id_state, id_method, tps, tvq, total) 
VALUES (2, 1, 2, 4, 20.00, 20.00, 60.00);
  
  
/* ta_order_product */
INSERT INTO ta_order_product (id_order, id_product, quantity) 
VALUES (1, 1, 2);

INSERT INTO ta_order_product (id_order, id_product, quantity) 
VALUES (1, 5, 4);

INSERT INTO ta_order_product (id_order, id_product, quantity) 
VALUES (1, 2, 1);

INSERT INTO ta_order_product (id_order, id_product, quantity) 
VALUES (2, 1, 1);

  
/* ta_product_category */
INSERT INTO ta_product_category(id_category, id_product) 
VALUES (1, 1);

INSERT INTO ta_product_category(id_category, id_product) 
VALUES (3, 1);

INSERT INTO ta_product_category(id_category, id_product) 
VALUES (4, 1);

INSERT INTO ta_product_category(id_category, id_product) 
VALUES (1, 2);

INSERT INTO ta_product_category(id_category, id_product) 
VALUES (4, 3);

