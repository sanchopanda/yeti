CREATE DATABASE yeticave DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(128)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_date DATETIME,
    email CHAR(64),
    name CHAR(64),
    password CHAR(64),
    avatar CHAR(128),
    contact CHAR(64)
);

CREATE UNIQUE INDEX email ON users(email);

CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    start_date DATETIME,
    title CHAR(128),
    description CHAR(128),
    image CHAR(128),
    start_price CHAR(64),
    finish_date DATETIME,
    step CHAR(64),
    count_favor CHAR(64),
    author_id INT,
    winner_id INT,
    category_id INT,
    FOREIGN KEY (author_id) REFERENCES users(id),
    FOREIGN KEY (winner_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME,
    current_price CHAR(64),
    user_id INT,
    lot_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (lot_id) REFERENCES lots(id)
);