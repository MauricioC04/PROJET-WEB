---------------------------------------------------
-- Author: Mauricio COSTA CABRAL                  |
-- Date: 04.03.2020                               |
-- Project: E-Commerce de vente de musiques       |
---------------------------------------------------


------------------ ADMINISTRATEUR ------------------

--- Vérifier si login est correct | Varibale > m.cabral@cpnv.ch | Check pas le mot de passe, car mot de passe haché. Code Php controlera.
SELECT *
FROM administrators 
WHERE administrators.email = "m.cabral@cpnv.ch";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération de la liste des albums CD
SELECT articles.id, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price
FROM articles
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN countries
ON artists.country_id = countries.id
INNER JOIN labels
ON articles.label_id = labels.id
INNER JOIN genres
ON articles.genre_id = genres.id
LEFT JOIN vinyleformats
ON articles.vinyleFormat_id = vinyleformats.id
WHERE articletypes.name = "Album CD";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération de la liste des vinyles
SELECT articles.id, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price, vinyleformats.name AS NameFormatVinyle
FROM articles
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN countries
ON artists.country_id = countries.id
INNER JOIN labels
ON articles.label_id = labels.id
INNER JOIN genres
ON articles.genre_id = genres.id
LEFT JOIN vinyleformats
ON articles.vinyleFormat_id = vinyleformats.id
WHERE articletypes.name = "Vinyle";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération des informations de l'article pour la modification d'un article (préremplir les champs)
SELECT articles.id, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, genres.name AS NameGenre, labels.name AS NameLabel, articles.quantity, articles.price, vinyleformats.name AS NameFormatVinyle, articles.pathFileCover, 
FROM articles
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN countries
ON artists.country_id = countries.id
INNER JOIN labels
ON articles.label_id = labels.id
INNER JOIN genres
ON articles.genre_id = genres.id
LEFT JOIN vinyleformats
ON articles.vinyleFormat_id = vinyleformats.id
WHERE articletypes.name = "Vinyle";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Insertion de l'article !!!!!!!!!!!!!!!! Voir avec Mme Andolfatto pour la table artist --> Si l'utilisateur écrit un artiste déjà enregistré mais avec une faute d'ortho ? Combobox ?


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération des morceaux de l'article en cours de modification | Variable > 1, True
SELECT musics.id, musics.title, musics.pathFileMusic, musics.duration
FROM musics
INNER JOIN articles
ON musics.article_id = articles.id
WHERE articles.id = 1 AND articles.name = "True";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération des informations du morceau pour la modification d'un morceau (préremplir les champs) | Variable > 1
SELECT musics.id, musics.title, musics.pathFileMusic, musics.duration
FROM musics
WHERE musics.id = 1;


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Insertion du morceau
INSERT INTO musics (title, duration, pathFileMusic, article_id)
VALUES ("MonTitre", "04:35", "#", "1");



-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||



------------------ CLIENT ------------------

--- Vérifier si login est correct | Varibale > j.dupont@cpnv.ch | Check pas le mot de passe, car mot de passe haché. Code Php controlera.
SELECT * 
FROM customers 
WHERE customers.email = "j.dupont@cpnv.ch";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Inscription d'un client | Variable > toutes les données dans VALUES

-- Récupération de l'id de la localité, selon ce que l'utilisateur aura noté. Obligatoirement suisse. | Variable > Vers-chez-Perrin
SELECT id
FROM cities
WHERE NAME = "Vers-chez-Perrin";

INSERT INTO customers (NAME, firstname, address, email, PASSWORD, city_id)
VALUES ("Obama", "Barack", "Rue de la Maison Blanche 78", "b.obama@cpnv.ch", "81dc9bdb52d04dc20036dbd8313ed055", 3461);


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération des données personnelles (compte client) | Variable > b.obama@cpnv.ch (email stocké dans une variable session)
SELECT customers.name, customers.firstname, customers.address, cities.zip, cities.name
FROM customers
INNER JOIN cities
ON customers.city_id = cities.id
WHERE customers.email = "b.obama@cpnv.ch";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération des anciennes commandes (compte client) | Variable > m.costa-cabral@cpnv.ch
SELECT orders.id, orders.orderDate, SUM(articles.price) AS totalCost
FROM orders
INNER JOIN customers
ON orders.customer_id = customers.id
INNER JOIN orders_has_articles
ON orders_has_articles.Orders_id = orders.id
INNER JOIN articles
ON orders_has_articles.Articles_id = articles.id
WHERE customers.email = "m.costa-cabral@cpnv.ch"
GROUP BY orders.id;


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération d'une commande détaillée | Variable > 1
SELECT articles.id, articletypes.name AS TypeArticle, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, COUNT(musics.id) AS NumberMusics, orders_has_articles.Quantity
FROM articles
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN musics
ON musics.article_id = articles.id
INNER JOIN orders_has_articles
ON orders_has_articles.Articles_id = articles.id
WHERE orders_has_articles.Orders_id = 1
GROUP BY articles.id;


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération de la liste des albums CD
SELECT articles.name, articles.releaseYear, articles.pathFileCover, articles.price, articles.quantity, articletypes.name, artists.name, countries.name, labels.name, genres.name, vinyleformats.name
FROM articles
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN countries
ON artists.country_id = countries.id
INNER JOIN labels
ON articles.label_id = labels.id
INNER JOIN genres
ON articles.genre_id = genres.id
LEFT JOIN vinyleformats
ON articles.vinyleFormat_id = vinyleformats.id
WHERE articletypes.name = "Album CD";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération de la liste des vinyles
SELECT articles.name, articles.releaseYear, articles.pathFileCover, articles.price, articles.quantity, articletypes.name, artists.name, countries.name, labels.name, genres.name, vinyleformats.name
FROM articles
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN countries
ON artists.country_id = countries.id
INNER JOIN labels
ON articles.label_id = labels.id
INNER JOIN genres
ON articles.genre_id = genres.id
LEFT JOIN vinyleformats
ON articles.vinyleFormat_id = vinyleformats.id
WHERE articletypes.name = "Vinyle";


--------------------------------------------------------------------------------------------------------------------------------------------------------


--- Récupération de la liste des morceaux d'un article | Variable > 1 ,1, 1

-- Récupération des informations de l'article
SELECT articles.name, articles.releaseYear, articles.pathFileCover, articles.price, articles.quantity, articletypes.name, artists.name, countries.name, labels.name, genres.name, vinyleformats.name
FROM articles
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN countries
ON artists.country_id = countries.id
INNER JOIN labels
ON articles.label_id = labels.id
INNER JOIN genres
ON articles.genre_id = genres.id
LEFT JOIN vinyleformats
ON articles.vinyleFormat_id = vinyleformats.id
WHERE articles.id = 1;

-- Récupération des morceaux
SELECT musics.title, musics.pathFileMusic, musics.duration
FROM musics
INNER JOIN articles
ON musics.article_id = articles.id
WHERE articles.id = 1;

-- Récupération du nombre de morceaux
SELECT COUNT(musics.id)
FROM musics
INNER JOIN articles
ON musics.article_id = articles.id
WHERE articles.id = 1;


--------------------------------------------------------------------------------------------------------------------------------------------------------

--- Exécution d'une commande

-- Récupération de la quantité pour vérification avec le panier | Variable > 1
SELECT articles.id, articles.quantity
FROM articles
WHERE articles.id = 1;

-- Création d'une commande | Variable > 2
INSERT INTO orders (customer_id, orderDate)
VALUES (2, CURRENT_DATE());

-- Insertion des articles dans la table intermédiaire (historique de la commande) | Variable > 2, 4, 5
INSERT INTO orders_has_articles (orders_id, articles_id, quantity)
VALUES ((SELECT MAX(orders.id) FROM orders WHERE orders.customer_id = 2), 4, 5);


--------------------------------------------------------------------------------------------------------------------------------------------------------


-- Confirmation d'achat | Variable > 2
SELECT articles.id, articletypes.name AS TypeArticle, articles.name AS NameArticle, artists.name AS NameArtist, articles.releaseYear, orders_has_articles.Quantity, articles.price
FROM articles
INNER JOIN artists
ON articles.artist_id = artists.id
INNER JOIN articletypes
ON articles.articleType_id = articletypes.id
INNER JOIN orders_has_articles
ON orders_has_articles.Articles_id = articles.id
WHERE orders_has_articles.Orders_id = (SELECT MAX(orders.id) FROM orders WHERE orders.customer_id = 2)
GROUP BY articles.id;
