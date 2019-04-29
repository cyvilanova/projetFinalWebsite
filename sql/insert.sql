
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
