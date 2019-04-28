DROP DATABASE IF EXISTS quintessentieldb;

CREATE DATABASE quintessentieldb;

USE quintessentieldb;

/* Product table */
CREATE TABLE product (
	id_product INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(128) NOT NULL,
	image_path VARCHAR(255),
	is_sellable BOOLEAN NOT NULL DEFAULT 0,
	description TEXT,
	price DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	quantity INT NOT NULL DEFAULT 0,
	PRIMARY KEY (id_product)
);

/* Recipe table */
CREATE TABLE recipe (
	id_recipe INT NOT NULL AUTO_INCREMENT,
	id_product INT,
	name VARCHAR(255) NOT NULL,
	is_custom BOOLEAN NOT NULL DEFAULT 0,
	steps TEXT,
	description TEXT,
	PRIMARY KEY (id_recipe),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);

/* Association table for recipe+product */
CREATE TABLE ta_recipe_product (
	id_recipe INT NOT NULL,
	id_product INT NOT NULL,
	qty_ml INT,
	qty_drops INT,
	qty_percent INT,
	PRIMARY KEY (id_recipe, id_product),
	FOREIGN KEY (id_recipe) REFERENCES recipe(id_recipe),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);

/* Product category table */
CREATE TABLE category (
	id_category INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	is_active BOOLEAN NOT NULL DEFAULT 0,
	description TEXT,
	PRIMARY KEY (id_category)
);

/* Association table for product+category */
CREATE TABLE ta_product_category (
	id_category INT NOT NULL,
	id_product INT NOT NULL,
	PRIMARY KEY (id_category, id_product),
	FOREIGN KEY (id_category) REFERENCES category(id_category),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);

/* Secret question table */
CREATE TABLE secret_question (
	id_question INT NOT NULL AUTO_INCREMENT,
	question VARCHAR(512) NOT NULL,
	PRIMARY KEY (id_question)
);

/* User table */
CREATE TABLE user (
	id_user INT NOT NULL AUTO_INCREMENT,
	id_question INT NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(512) NOT NULL,
	secret_answer VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_user),
	FOREIGN KEY (id_question) REFERENCES secret_question(id_question)
);

/* Form table */
CREATE TABLE form_answers (
	id_form INT NOT NULL AUTO_INCREMENT,
	id_user INT NOT NULL,
	age INT NOT NULL,
	skintype VARCHAR(64),
	work_environment TEXT,
	desired_effect VARCHAR(255),
	quantity INT,
	fragrance VARCHAR(128),
	essential_oil VARCHAR(128),
	request TEXT,
	comment TEXT,
	PRIMARY KEY (id_form),
	FOREIGN KEY (id_user) REFERENCES user(id_user)
);

/* Order's state table */
CREATE TABLE state (
	id_state INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	description TEXT,
	PRIMARY KEY (id_state)
);

/* Client table */
CREATE TABLE client (
	id_client INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	address VARCHAR(255) NOT NULL,
	city VARCHAR(100) NOT NULL,
	province VARCHAR(32) NOT NULL,
	postal_code VARCHAR(32) NOT NULL,
	PRIMARY KEY (id_client)
);

/* Shipping company table */
CREATE TABLE shipping_company (
	id_company INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY (id_company)
);

/* Shipping method table */
CREATE TABLE shipping_method (
	id_method INT NOT NULL AUTO_INCREMENT,
	id_company INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	price DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	PRIMARY KEY (id_method),
	FOREIGN KEY (id_company) REFERENCES shipping_company(id_company)
);

/* Order table */
CREATE TABLE `order` (
	id_order INT NOT NULL AUTO_INCREMENT,
	id_client INT,
	id_user INT,
	id_state INT,
	id_method INT,
	tps DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	tvq DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	total DECIMAL(7,2) NOT NULL DEFAULT 0.00,
	PRIMARY KEY (id_order),
	FOREIGN KEY (id_user) REFERENCES user(id_user),
	FOREIGN KEY (id_client) REFERENCES client(id_client),
	FOREIGN KEY (id_state) REFERENCES state(id_state),
	FOREIGN KEY (id_method) REFERENCES shipping_method(id_method)
);

/* Association table for order+product */
CREATE TABLE ta_order_product (
	id_order INT NOT NULL,
	id_product INT NOT NULL,
	PRIMARY KEY (id_order, id_product),
	FOREIGN KEY (id_order) REFERENCES `order`(id_order),
	FOREIGN KEY (id_product) REFERENCES product(id_product)
);






/* Populate la DB */


/* Table Produit */
INSERT INTO Product VALUES 
(DEFAULT,"Atelier comment décoder les étiquettes","images/imgProducts/img1.jpg",1,"Cancer, baisse de la fertilité, Alzheimer… Et si nos produits de beauté nous empoisonnaient ?

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


(DEFAULT,"Sérum personnalisé","images/imgProducts/default.jpg",1,"",90.00,20),
(DEFAULT,"Consultation 1 heure en dermo cosmétique naturelle","images/imgProducts/img3.jpg",0,"Consultation d'environ 1 heure pour discuter de vos problèmes de peau 

- Bilan de vos besoins et établissement de la formule personnalisée 

- Recommandations et protocole de soins adapté a votre problématique

- Sur rendez-vous en personne ou par Skype

- Rendez-vous de suivi gratuit un mois aprés pour évaluer vos progrès",60.00,30),


(DEFAULT,"Gant de kessa exfoliant","images/imgProducts/img4.jpg",1,"",12.00,7),


(DEFAULT,"Eau rééquilibrante","images/imgProducts/img5.jpg",1,"Composée de trois hydrolats anti-inflammatoires, cette eau rééquilibrante est à appliquer impérativement après le liniment pour rééquilibrer le ph de la peau. La camomille, la rose de damas et l'eau de bleuet viennent calmer l'irritation et les rougeurs des peaux sensibles et irritées. C'est le complément indispensable à votre routine de soin pour retrouver une peau en santé! ",20.00,8),


(DEFAULT,"Liniment démaquillant peau sensible","images/imgProducts/img6.jpg",1,"Doux et efficace pour les peaux sensibles!

Le liniment Oleocalcaire démaquillant est le must pour les peaux sensibles et irritées. Bien connu en Europe pour le soin des peaux fragiles des bébés, il démaquille et nettoie en douceur les épidermes les plus fragiles. Composé à 100% d'huiles végétales  précieuses bio, il nettoie, nourrit et hydrate l'épiderme tout en douceur. A utiliser avec nos hydrolats rééquilibrants!",20.00,5),


(DEFAULT,"Beurre de karité brut de Cote d'Ivoire Sauvage 200 g","images/imgProducts/img7.jpg",1,"Découvrez notre trésor d'Afrique ! Ce beurre de karité brut filtré provient d'un petit village de Cote d'Ivoire.  Les noix de karité sont ramassées en brousse puis transformées de facon artisanale par les femmes Ivoiriennes. Ce beurre est d'une qualité exceptionnelle. Sa couleur ivoire, sa texture crémeuse et son odeur douce sont la signature de notre beurre de karité, connu pour nourrir et hydrater intensément la peau. ",17.00,4),


(DEFAULT,"Duo clin d'oeil","images/imgProducts/img8.jpg",1,"Vous adorerez le duo contour de l'oeil Clin D'oeil. Le sérum gel Jour à la texture fluide légère est hydratant et tenseur. Les hydrolats d et l'extrait de bourgeon de hetre lissent instantanément le contour de l.oeil et défatiguent le regard. 

L'huile régénérante nuit à la précieuse huile essentielle d'immortelle de Corse, aussi connue sous le nom d'Hélichryse Italienne, nourrit cette zone fragile et agit en profondeur, tandis que l'huile de foraha et ce chanvre stimulent la microcirculation.

Vous pouvez aussi appliquer le gel et l'huile ensemble, pour un effet optimal!",55.00,1),


(DEFAULT,"Oléo-Sérum Clarté Anti-taches brunes","images/imgProducts/img9.jpg",1,"L'oléosérum Clarté contribue à réduire les taches pigmentaires grace à un actif naturel: l'arbutine contenu dans le macérat de busserole, qui régule la production de mélanine à l'origine des taches pigmentaires.

 Les huiles essentielles dépigmentantes qu'il contient accroissent l'efficacité de ce sérum. A utiliser seul ou en duo avec le sérum tenseur. Protéger impérativement la peau du soleil.",50.00,1),


(DEFAULT,"Oléo-sérum Équilibre peau grasse et acnéique","images/imgProducts/img10.jpg",1,"L'acné vous gâche la vie et vous souhaitez une alternative naturelle aux traitements agressifs pour votre peau? L'oléo-sérum Équilibre aide votre peau à se rééquilibrer naturellement  et en douceur grace aux propriétés équilibrantes et assainissantes. Combinez le avec le nettoyant micellaire sans rinçage et le savon au moringa pour une action optimale.",50.00,6),

(DEFAULT,"Oléo-sérum Harmonie Couperose et Rosacée","images/imgProducts/img11.jpg",1,"Vous souffrez de couperose ou de rosacée et souhaitez une alternative naturelle? L'Oléo-sérum Harmonie calme l'inflammation et les rougeurs grâce à un puissant complexe d'huiles végétales précieuses, riches en Omégas 3 et 9 qui apaisent l'inflammation de votre peau! Les huiles végétales de chanvre et tamanu en particulier apportent leurs propriétés apaisantes et anti-inflammatoires pour un soin apaisant 100% actif et naturel, allié à la précieuse Huile essentielle d' immortelle de Corse, connue aussi sous le nom d'Hélychrise italienne, et de camomille, anti-inflammatoire.",50.00,100),
(DEFAULT,"Sérum Régénération anti-age aux 5 huiles précieuses","images/imgProducts/img12.jpg",1,"Découvrez notre merveilleux soin anti-age aux 5 huiles précieuses! Un vrai trésor liquide, gorgé d'acides gras omégas 3, 6 et 9, essentiels pour votre peau! la peau est régénérée, souple et douce.",50.00,8),
(DEFAULT,"Savon peaux sensibles moringa et calendule","images/imgProducts/img13.jpg",1,"Savon doux aux huiles végétales de moringa et de calendule, pour peaux sensibles",7.00,12),
(DEFAULT,"Savon Exfoliant moringa et abricot","images/imgProducts/img14.jpg",1,"Savon exfoliant doux, moringa calendule et graines d'Abricot",8.00,5),
(DEFAULT,"Shampoing au moringa et karité cheveux secs","images/imgProducts/img15.jpg",1,"Ce shampoing doux enrichi en huile de moringa et karité est un plaisir pour les cheveux secs.  Il nettoie vos cheveux en douceur et les rend doux et faciles à coiffer. Les huiles essentielles de lavande et romarin apportent leurs propriétés apaisantes et fortifiantes à ce soin. Nos shampoings sont sans agents toxiques ou parfums chimiques, ils sont excellents pour tous types de cheveux.",13.00,2);
