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