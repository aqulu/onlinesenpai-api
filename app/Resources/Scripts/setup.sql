CREATE TABLE `grades` (
  id INT NOT NULL,
  grade INT NOT NULL,
  level VARCHAR(3),
  color_hex VARCHAR(7),
  PRIMARY KEY(id)
);
INSERT INTO `grades` VALUES
  (1, 9, 'Kyu', '#ffffff'),
  (2, 8, 'Kyu', '#ffed20'),
  (3, 7, 'Kyu', '#f78402'),
  (4, 6, 'Kyu', '#18851f'),
  (5, 5, 'Kyu', '#01579b'),
  (6, 4, 'Kyu', '#8d15ba'),
  (7, 3, 'Kyu', '#51474A'),
  (8, 2, 'Kyu', '#51474A'),
  (9, 1, 'Kyu', '#51474A'),
  (10, 1, 'Dan', '#000000'),
  (11, 2, 'Dan', '#000000'),
  (12, 3, 'Dan', '#000000'),
  (13, 4, 'Dan', '#000000'),
  (14, 5, 'Dan', '#000000');

CREATE TABLE `users` (
  id BIGINT NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(25) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  mail VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  instructor BOOLEAN NOT NULL,
  grade_id INT NULL,
  FOREIGN KEY(grade_id) REFERENCES grades(id)
    ON DELETE SET NULL ON UPDATE NO ACTION,
  PRIMARY KEY(id)
);
INSERT INTO `users`(firstname, lastname, mail, password, instructor, grade_id)
VALUES ('Luca', 'Aquino', 'laquino@hsr.ch', 'test', 1, 12);

CREATE TABLE `authkeys` (
  token VARCHAR(50) NOT NULL,
  expires TIMESTAMP NULL,
  user_id BIGINT NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
  PRIMARY KEY (token)
);
INSERT INTO `authkeys` VALUES ('test', null, 1);

CREATE TABLE `categories` (
  id INT NOT NULL,
  name VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
);
INSERT INTO `categories` VALUES
  (1, 'Kihon'),
  (2, 'Kata'),
  (3, 'Kumite');

CREATE TABLE `techniques` (
  id INT AUTO_INCREMENT,
  name VARCHAR(25) NOT NULL,
  description TEXT,
  video_url VARCHAR(50),
  category_id INT NULL,
  FOREIGN KEY(category_id) REFERENCES categories(id)
    ON DELETE CASCADE,
  PRIMARY KEY(id)
);
INSERT INTO `techniques` (name, category_id, description) VALUES
  ('Juntsuki', 1, '順突き'),
  ('Gyakutsuki', 1, '逆突き'),
  ('Juntsuki no Tsukomi', 1, '順突きの突っ込み'),
  ('Gykutsuki no Tsukomi', 1, '逆突きの突っ込み'),
  ('Kette Juntsuki', 1, '蹴って順突き'),
  ('Kette Gyakutsuki', 1, '蹴って逆突き'),
  ('Kette Juntsuki no Tsukomi', 1, '蹴って順突きの突っ込み'),
  ('Kette Gyakutsuki no Tsukomi', 1, '蹴って逆突きの突っ込み'),
  ('Tobikomitsuki', 1, '飛び込み突き'),
  ('Nagashitsuki', 1, '流し付き'),
  ('Jodanuke', 1, '上段受け'),
  ('Gedanbarai', 1, '下段払い'),
  ('Sotouke', 1, '外受け'),
  ('Uchiuke', 1, '内受け'),
  ('Shutouke', 1, '手刀受け'),
  ('Maegeri', 1, '前蹴り'),
  ('Mawashigeri', 1, '回し蹴り'),
  ('Sokutogeri', 1, '足刀蹴り'),
  ('Ushirogeri', 1, '後ろ蹴り');
INSERT INTO `techniques` (name, category_id) VALUES
  ('Pinan Shodan', 2),
  ('Pinan Nidan', 2),
  ('Pinan Sandan', 2),
  ('Pinan Yondan', 2),
  ('Pinan Godan', 2),
  ('Kushanku', 2),
  ('Naihanchi', 2),
  ('Seishan', 2),
  ('Chinto', 2),
  ('Niseishi', 2),
  ('Jion', 2),
  ('Jitte', 2),
  ('Wanshu', 2),
  ('Bassai', 2),
  ('Rohai', 2);
INSERT INTO `techniques` (name, category_id) VALUES
  ('Ohyo Kumite Ipponme', 3),
  ('Ohyo Kumite Nihonme', 3),
  ('Ohyo Kumite Sanbonme', 3),
  ('Ohyo Kumite Yohonme', 3),
  ('Ohyo Kumite Gohonme', 3),
  ('Ohyo Kumite Ropponme', 3),
  ('Ohyo Kumite Nanahonme', 3),
  ('Ohyo Kumite Hachihonme', 3),
  ('Kihon Kumite Ipponme', 3),
  ('Kihon Kumite Nihonme', 3),
  ('Kihon Kumite Sanbonme', 3),
  ('Kihon Kumite Yohonme', 3),
  ('Kihon Kumite Gohonme', 3),
  ('Kihon Kumite Ropponme', 3),
  ('Kihon Kumite Nanahonme', 3),
  ('Kihon Kumite Hachihonme', 3),
  ('Kihon Kumite Kyuhonme', 3),
  ('Kihon Kumite Jupponme', 3);


CREATE TABLE `programs` (
  grade_id INT,
  ordering INT,
  technique_id INT,
  FOREIGN KEY(grade_id) REFERENCES grades(id),
  FOREIGN KEY (technique_id) REFERENCES techniques(id),
  PRIMARY KEY (grade_id, technique_id)
);

-- 8. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (2, 1, 1),
  (2, 2, 2),
  (2, 3, 11),
  (2, 4, 12),
  (2, 5, 13),
  (2, 6, 14),
  (2, 7, 16),
  (2, 8, 21);

-- 7. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (3, 1, 1),
  (3, 2, 2),
  (3, 3, 3),
  (3, 4, 11),
  (3, 5, 12),
  (3, 6, 13),
  (3, 7, 14),
  (3, 8, 16),
  (3, 9, 17),
  (3, 10, 21),
  (3, 11, 35);

-- 6. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (4, 1, 1),
  (4, 2, 2),
  (4, 3, 3),
  (4, 4, 5),
  (4, 5, 6),
  (4, 6, 8),
  (4, 7, 11),
  (4, 8, 12),
  (4, 9, 13),
  (4, 10, 14),
  (4, 11, 15),
  (4, 12, 16),
  (4, 13, 17),
  (4, 14, 18),
  (4, 15, 19),
  (4, 16, 35),
  (4, 17, 36);

-- 5. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (5, 1, 1),
  (5, 2, 2),
  (5, 3, 3),
  (5, 4, 4),
  (5, 5, 5),
  (5, 6, 6),
  (5, 7, 8),
  (5, 8, 11),
  (5, 9, 12),
  (5, 10, 13),
  (5, 11, 14),
  (5, 12, 15),
  (5, 13, 16),
  (5, 14, 17),
  (5, 15, 18),
  (5, 16, 19),
  (5, 17, 22),
  (5, 18, 36),
  (5, 19, 37);

-- 4. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (6, 1, 1),
  (6, 2, 2),
  (6, 3, 3),
  (6, 4, 4),
  (6, 5, 5),
  (6, 6, 6),
  (6, 7, 7),
  (6, 8, 8),
  (6, 9, 9),
  (6, 10, 11),
  (6, 11, 12),
  (6, 12, 13),
  (6, 13, 14),
  (6, 14, 15),
  (6, 15, 16),
  (6, 16, 17),
  (6, 17, 18),
  (6, 18, 22),
  (6, 19, 23),
  (6, 20, 37),
  (6, 21, 38),
  (6, 22, 43);

-- 3. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (7, 1, 1),
  (7, 2, 2),
  (7, 3, 3),
  (7, 4, 4),
  (7, 5, 5),
  (7, 6, 6),
  (7, 7, 7),
  (7, 8, 8),
  (7, 9, 9),
  (7, 10, 11),
  (7, 11, 12),
  (7, 12, 13),
  (7, 13, 14),
  (7, 14, 15),
  (7, 15, 16),
  (7, 16, 17),
  (7, 17, 18),
  (7, 18, 23),
  (7, 19, 24),
  (7, 20, 38),
  (7, 21, 39),
  (7, 22, 43),
  (7, 22, 44);

-- 2. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (8, 1, 1),
  (8, 2, 2),
  (8, 3, 3),
  (8, 4, 4),
  (8, 5, 5),
  (8, 6, 6),
  (8, 7, 7),
  (8, 8, 8),
  (8, 9, 9),
  (8, 10, 10),
  (8, 11, 11),
  (8, 12, 12),
  (8, 13, 13),
  (8, 14, 14),
  (8, 15, 15),
  (8, 16, 16),
  (8, 17, 17),
  (8, 18, 18),
  (8, 19, 24),
  (8, 20, 26),
  (8, 21, 38),
  (8, 22, 39),
  (8, 23, 43),
  (8, 24, 44);

-- 1. kyu
INSERT INTO `programs` (grade_id, ordering, technique_id) VALUES
  (9, 1, 1),
  (9, 2, 2),
  (9, 3, 3),
  (9, 4, 4),
  (9, 5, 5),
  (9, 6, 6),
  (9, 7, 7),
  (9, 8, 8),
  (9, 9, 9),
  (9, 10, 10),
  (9, 11, 11),
  (9, 12, 12),
  (9, 13, 13),
  (9, 14, 14),
  (9, 15, 15),
  (9, 16, 16),
  (9, 17, 17),
  (9, 18, 18),
  (9, 19, 24),
  (9, 20, 25),
  (9, 21, 41),
  (9, 22, 43),
  (9, 23, 44),
  (9, 24, 45);
