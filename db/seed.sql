SET FOREIGN_KEY_CHECKS = 0;


TRUNCATE TABLE review;
TRUNCATE TABLE favorites_item;
TRUNCATE TABLE cast_actor;
TRUNCATE TABLE movie_genre;
TRUNCATE TABLE `cast`;
TRUNCATE TABLE genre;
TRUNCATE TABLE movieimage;
TRUNCATE TABLE movie;
TRUNCATE TABLE favorites;
TRUNCATE TABLE users;
TRUNCATE TABLE actor;

SET FOREIGN_KEY_CHECKS = 1;


INSERT INTO users (email, password, nickname, role, created_at) VALUES 
('admin@cinephilia.com', 'admin123', 'AdminMaster', 'admin', NOW()),
('pedro.almeida@email.com', 'senha123', 'PedroFilms', 'user', NOW()),
('ana.costa@email.com', 'senha123', 'AnaCine', 'user', NOW());


INSERT INTO genre (name) VALUES 
('Drama'), 
('Ficção Científica'), 
('Crime'), 
('Aventura'), 
('Ação');


INSERT INTO actor (name, birthdate, biography, country) VALUES 
('Marlon Brando', '1924-04-03', 'Lenda do cinema, conhecido por O Poderoso Chefão.', 'EUA'),
('Al Pacino', '1940-04-25', 'Famoso por papéis em filmes de crime e drama.', 'EUA'),
('Matthew McConaughey', '1969-11-04', 'Vencedor do Oscar e estrela de Interestelar.', 'EUA'),
('Anne Hathaway', '1982-11-12', 'Atriz versátil, vencedora do Oscar.', 'EUA'),
('Heath Ledger', '1979-04-04', 'Lendário por sua performance como Coringa.', 'Austrália');


INSERT INTO movie (age_classification, name, status, release_date, country, duration, budget) VALUES 
('14', 'O Poderoso Chefão', 'Lançado', '1972-03-24', 'EUA', 175, 6000000.00),
('10', 'Interestelar', 'Lançado', '2014-11-06', 'EUA', 169, 165000000.00),
('12', 'O Cavaleiro das Trevas', 'Lançado', '2008-07-18', 'EUA', 152, 185000000.00);


INSERT INTO movie_genre (genre_id, movie_id) VALUES (3, 1), (1, 1);


INSERT INTO movie_genre (genre_id, movie_id) VALUES (2, 2), (4, 2);


INSERT INTO movie_genre (genre_id, movie_id) VALUES (5, 3), (3, 3);


INSERT INTO `cast` (movie_id) VALUES 
(1),
(2), 
(3); 


INSERT INTO cast_actor (cast_id, actor_id) VALUES (1, 1), (1, 2);


INSERT INTO cast_actor (cast_id, actor_id) VALUES (2, 3), (2, 4);


INSERT INTO cast_actor (cast_id, actor_id) VALUES (3, 5);
