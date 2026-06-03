INSERT INTO categories (name)
SELECT 'Électronique'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Électronique'
);

INSERT INTO categories (name)
SELECT 'Vêtements'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Vêtements'
);

INSERT INTO categories (name)
SELECT 'Maison'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Maison'
);

INSERT INTO categories (name)
SELECT 'Sport'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Sport'
);

INSERT INTO categories (name)
SELECT 'Autre'
WHERE NOT EXISTS (
    SELECT 1 FROM categories WHERE name = 'Autre'
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
