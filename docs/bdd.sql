-- ----------------------------------------------------------------------------
-- 1) Création de la base de données (modifier le nom si besoin)
-- ----------------------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS vinyles_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE vinyles_db;

-- ----------------------------------------------------------------------------
-- 2) Table "category"
-- ----------------------------------------------------------------------------
CREATE TABLE category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------------------
-- 3) Table "brand"
-- ----------------------------------------------------------------------------
CREATE TABLE brand (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------------------
-- 4) Table "type"
-- ----------------------------------------------------------------------------
CREATE TABLE type (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------------------
-- 5) Table "product"
-- ----------------------------------------------------------------------------
CREATE TABLE product (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    description TEXT NULL,
    -- Clés étrangères :
    category_id INT UNSIGNED,
    brand_id INT UNSIGNED,
    type_id INT UNSIGNED,
    
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_product_category
        FOREIGN KEY (category_id) 
        REFERENCES category(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    CONSTRAINT fk_product_brand
        FOREIGN KEY (brand_id) 
        REFERENCES brand(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    
    CONSTRAINT fk_product_type
        FOREIGN KEY (type_id)
        REFERENCES type(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- ----------------------------------------------------------------------------
-- 6) Table "user" (pour le Back-Office)
-- ----------------------------------------------------------------------------
-- 2 rôles possibles : "admin" ou "catalog_manager"


CREATE TABLE user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(191) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'catalog_manager') NOT NULL DEFAULT 'catalog_manager',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------------------
-- 7) Table "order" (pour les commandes)
-- ----------------------------------------------------------------------------

CREATE TABLE `order` (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    status ENUM('paid','shipped','canceled','returned') NOT NULL DEFAULT 'paid',
    total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------------------
-- 8) Table "order_item" (relation N-N entre "order" et "product")
-- ----------------------------------------------------------------------------


CREATE TABLE order_item (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    price_each DECIMAL(10, 2) NOT NULL DEFAULT 0.00, -- prix unitaire au moment de l'achat

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_orderitem_order
        FOREIGN KEY (order_id) 
        REFERENCES `order` (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_orderitem_product
        FOREIGN KEY (product_id)
        REFERENCES product(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- ----------------------------------------------------------------------------
-- 9) Quelques données de démo (optionnel)
-- ----------------------------------------------------------------------------

INSERT INTO category (name) VALUES
  ('Détente'),
  ('En ville'),
  ('Au travail'),
  ('Chaussons'),
  ('Escarpins');

INSERT INTO brand (name) VALUES
  ('Brand A'),
  ('Brand B'),
  ('Brand C');

INSERT INTO type (name) VALUES
  ('Type 1'),
  ('Type 2'),
  ('Talons aiguilles');

INSERT INTO product (name, price, category_id, brand_id, type_id, description)
VALUES
  ('Produit 1', 9.99, 1, 1, 1, 'Description du produit 1'),
  ('Produit 2', 19.99, 1, 2, 2, 'Description du produit 2'),
  ('Produit 3', 29.99, 2, 1, 3, 'Description du produit 3'),
  ('Produit 4', 39.99, 4, 2, 1, 'Description du produit 4');

INSERT INTO user (email, password, role) VALUES
  ('admin@vinyles.com', 'hashedpassword1', 'admin'),
  ('manager@vinyles.com', 'hashedpassword2', 'catalog_manager');

INSERT INTO `order` (status, total_amount) VALUES
  ('paid', 59.98),
  ('shipped', 19.99);

INSERT INTO order_item (order_id, product_id, quantity, price_each) VALUES
  (1, 1, 1, 9.99),
  (1, 2, 1, 19.99),
  (1, 3, 1, 29.99),
  (2, 2, 1, 19.99);

-- ----------------------------------------------------------------------------
-- Fin du script
-- ----------------------------------------------------------------------------
