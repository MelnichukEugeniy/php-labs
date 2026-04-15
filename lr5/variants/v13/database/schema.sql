-- Users table (auth module)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) DEFAULT '',
    city VARCHAR(50) DEFAULT '',
    gender VARCHAR(10) DEFAULT '',
    about TEXT DEFAULT '',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Motorcycles table (CRUD module — Магазин мотоциклів)
CREATE TABLE IF NOT EXISTS motorcycles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    model VARCHAR(150) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    category VARCHAR(50) DEFAULT '',
    price INTEGER DEFAULT 0,
    engine_cc INTEGER DEFAULT 0,
    power_hp INTEGER DEFAULT 0,
    description TEXT DEFAULT '',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Seed motorcycles
INSERT INTO motorcycles (model, brand, category, price, engine_cc, power_hp, description) VALUES
    ('CBR1000RR-R', 'Honda', 'Спортивні', 950000, 999, 215, 'Високопродуктивний спортбайк з передовою аеродинамікою та потужним двигуном.'),
    ('S1000RR', 'BMW', 'Спортивні', 1100000, 999, 207, 'Легендарний спортбайк з вражаючою потугою та керованістю.'),
    ('Rebel 500', 'Honda', 'Крейзори', 450000, 471, 47, 'Класичний крейзер для новачків з комфортною посадкою та надійністю.'),
    ('Street Glide', 'Harley-Davidson', 'Крейзори', 1800000, 1870, 114, 'Культовий американський крейзер з легендарною укладкою.'),
    ('CRF450R', 'Honda', 'Кросові', 550000, 449, 58, 'Потужний кроссовий мотоцикл для збірок по бездоріжжю.'),
    ('Ninja 400', 'Kawasaki', 'Спортивно-туристичні', 350000, 399, 45, 'Легкий і маневрений мотоцикл для початківців.'),
    ('Gold Wing', 'Honda', 'Туристичні', 1600000, 1833, 125, 'Люксонний туристичний мотоцикл з максимальним комфортом.'),
    ('Mustang Bobber', 'Royal Enfield', 'Крейзори', 320000, 648, 48, 'Компактний крейзер з класичним дизайном та економним двигуном.'),
    ('MT-09', 'Yamaha', 'Нейкеди', 750000, 889, 119, 'Агресивний нейкед з потужним трьохціліндровим двигуном.'),
    ('Africa Twin', 'Honda', 'Ендуро', 950000, 1084, 101, 'Універсальний ендуро для подорожей по будь-якій місцевості.');
