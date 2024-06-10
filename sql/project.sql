CREATE TABLE catalog (
    entity_id INT NOT NULL,
    category_name VARCHAR(255) NOT NULL,
    sku VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    short_description LONGTEXT DEFAULT NULL,
    description LONGTEXT DEFAULT NULL,
    price FLOAT DEFAULT 0,
    link VARCHAR(255) DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    brand VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    caffeine_type VARCHAR(255) NOT NULL,
    count INT DEFAULT 0,
    flavored VARCHAR(255) NOT NULL,
    seasonal VARCHAR(255) NOT NULL,
    in_stock VARCHAR(255) NOT NULL,
    facebook boolean DEFAULT 0,
    is_k_cup boolean DEFAULT 0,

    PRIMARY KEY (entity_id)
);
