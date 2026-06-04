INSERT INTO categories (name)
SELECT 'Informatique'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Informatique'
);

INSERT INTO categories (name)
SELECT 'Livre'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Livre'
);

INSERT INTO categories (name)
SELECT 'Hi-Fi'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Hi-Fi'
);

DELETE FROM categories
WHERE name NOT IN ('Informatique', 'Livre', 'Hi-Fi')
AND id NOT IN (
    SELECT category_id FROM products
);

INSERT INTO users (
    first_name,
    last_name,
    address,
    postal_code,
    birth_date,
    email,
    username,
    password_hash,
    role
)
SELECT
    'Admin',
    'Projet',
    'Adresse admin',
    '1000',
    '2000-01-01',
    'admin@projet.local',
    'admin',
    '$2y$10$xcl/ynwe1UWegh87X.gxg.wdSZVzu2k0CtOuAj.WY5jlU4uFsCiHS',
    'admin'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE username = 'admin' OR email = 'admin@projet.local'
);

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Ordinateur portable Lenovo IdeaPad', 'PC portable 15 pouces pour bureautique et cours', 649.99, 1
FROM categories c
WHERE c.name = 'Informatique'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Ordinateur portable Lenovo IdeaPad');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Souris sans fil Logitech', 'Souris ergonomique USB sans fil', 24.99, 1
FROM categories c
WHERE c.name = 'Informatique'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Souris sans fil Logitech');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Clavier mecanique compact', 'Clavier AZERTY compact avec touches retroeclairees', 59.90, 1
FROM categories c
WHERE c.name = 'Informatique'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Clavier mecanique compact');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Ecran 24 pouces Full HD', 'Moniteur Full HD pour travail et multimedia', 129.99, 1
FROM categories c
WHERE c.name = 'Informatique'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Ecran 24 pouces Full HD');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Cle USB 64 Go', 'Cle USB rapide pour documents et sauvegardes', 12.99, 1
FROM categories c
WHERE c.name = 'Informatique'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Cle USB 64 Go');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'PHP et MySQL pour debutants', 'Guide pratique pour apprendre le developpement web', 29.90, 1
FROM categories c
WHERE c.name = 'Livre'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'PHP et MySQL pour debutants');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Clean Code', 'Principes pour ecrire un code clair et maintenable', 39.90, 1
FROM categories c
WHERE c.name = 'Livre'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Clean Code');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Algorithmique illustree', 'Introduction visuelle aux algorithmes essentiels', 27.50, 1
FROM categories c
WHERE c.name = 'Livre'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Algorithmique illustree');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'HTML CSS JavaScript', 'Manuel complet pour creer des interfaces web', 32.00, 1
FROM categories c
WHERE c.name = 'Livre'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'HTML CSS JavaScript');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Gestion de projet agile', 'Methodes Scrum et Kanban expliquees simplement', 24.90, 1
FROM categories c
WHERE c.name = 'Livre'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Gestion de projet agile');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Casque audio Sony', 'Casque Hi-Fi confortable avec son clair', 79.99, 1
FROM categories c
WHERE c.name = 'Hi-Fi'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Casque audio Sony');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Enceinte Bluetooth JBL', 'Enceinte portable avec autonomie longue duree', 89.99, 1
FROM categories c
WHERE c.name = 'Hi-Fi'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Enceinte Bluetooth JBL');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Ecouteurs intra auriculaires', 'Ecouteurs filaires avec isolation sonore', 19.90, 1
FROM categories c
WHERE c.name = 'Hi-Fi'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Ecouteurs intra auriculaires');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Amplificateur audio compact', 'Amplificateur stereo pour installation domestique', 149.90, 1
FROM categories c
WHERE c.name = 'Hi-Fi'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Amplificateur audio compact');

INSERT INTO products (category_id, name, description, unit_price, is_active)
SELECT c.id, 'Platine vinyle Audio-Technica', 'Platine vinyle automatique pour collection musicale', 199.00, 1
FROM categories c
WHERE c.name = 'Hi-Fi'
AND NOT EXISTS (SELECT 1 FROM products WHERE name = 'Platine vinyle Audio-Technica');
