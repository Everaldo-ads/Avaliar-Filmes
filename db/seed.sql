SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS favorites_item;
DROP TABLE IF EXISTS cast_actor;
DROP TABLE IF EXISTS movie_genre;
DROP TABLE IF EXISTS `cast`;
DROP TABLE IF EXISTS genre;
DROP TABLE IF EXISTS movieimage;
DROP TABLE IF EXISTS movie;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS actor;


CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nickname VARCHAR(100) NOT NULL,
  role ENUM('user','admin') NOT NULL DEFAULT 'user',
  profile_image LONGBLOB DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE actor (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  birthdate DATE DEFAULT NULL,
  biography TEXT DEFAULT NULL,
  country VARCHAR(150) NOT NULL,
  profile_image LONGBLOB DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE favorites (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE movie (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  age_classification ENUM('L','10','12','14','16','18') NOT NULL,
  name VARCHAR(255) NOT NULL,
  status VARCHAR(100) NOT NULL,
  release_date DATE NOT NULL,
  country VARCHAR(100) NOT NULL,
  duration INT UNSIGNED NOT NULL,
  budget FLOAT UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE movieimage (
  id INT AUTO_INCREMENT PRIMARY KEY,
  movie_id INT UNSIGNED NOT NULL,
  content LONGBLOB,
  FOREIGN KEY (movie_id) REFERENCES movie(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE genre (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE movie_genre (
  genre_id INT NOT NULL,
  movie_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (genre_id, movie_id),
  FOREIGN KEY (genre_id) REFERENCES genre(id) ON DELETE CASCADE,
  FOREIGN KEY (movie_id) REFERENCES movie(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cast` (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  movie_id INT UNSIGNED NOT NULL UNIQUE,
  FOREIGN KEY (movie_id) REFERENCES movie(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE cast_actor (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  cast_id INT UNSIGNED NOT NULL,
  actor_id INT UNSIGNED NOT NULL,
  UNIQUE KEY unique_casting (cast_id, actor_id),
  FOREIGN KEY (actor_id) REFERENCES actor(id) ON DELETE CASCADE,
  FOREIGN KEY (cast_id) REFERENCES `cast`(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE favorites_item (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  movie_id INT UNSIGNED NOT NULL,
  favorites_id INT UNSIGNED NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (movie_id) REFERENCES movie(id),
  FOREIGN KEY (favorites_id) REFERENCES favorites(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE review (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  movie_id INT UNSIGNED NOT NULL,
  score FLOAT NOT NULL,
  message TEXT DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (movie_id) REFERENCES movie(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO users (email, password, nickname, role, created_at) VALUES 
('admin@cinephilia.com', 'admin123', 'AdminMaster', 'admin', NOW()),
('pedro.almeida@email.com', 'senha123', 'PedroFilms', 'user', NOW()),
('ana.costa@email.com', 'senha123', 'AnaCine', 'user', NOW());

INSERT INTO genre (name) VALUES 
('Drama'), ('Ficção Científica'), ('Crime'), ('Aventura'), ('Ação');

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

INSERT INTO movie_genre (genre_id, movie_id) VALUES 
(3, 1), (1, 1), 
(2, 2), (4, 2), 
(5, 3), (3, 3);

INSERT INTO `cast` (movie_id) VALUES (1), (2), (3);

INSERT INTO cast_actor (cast_id, actor_id) VALUES 
(1, 1), (1, 2), 
(2, 3), (2, 4), 
(3, 5);

SET FOREIGN_KEY_CHECKS = 1;