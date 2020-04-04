
-- добавление категорий
INSERT INTO categories (category_name)
VALUES ("Доски и лыжи"), ("Крепления"), ("Ботинки"), ("Одежда"), ("Инструменты"), ("Разное");

-- добавление пользователей
INSERT INTO users (reg_date, email, name, password, avatar, contact)
VALUES ("2018-05-09 10:10:30", "ignat.v@gmail.com", "Игнат", "$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka", "img/ignat.jpg", "Russia"),
       ("2018-05-09 11:15:20", "kitty_93@li.ru", "Леночка", "$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa", "img/kitty.jpg", "Russia"),
       ("2018-05-09 11:15:20", "warrior07@mail.ru", "Руслан", "$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW", "img/warrior.jpg", "Russia");



-- добавление объявлений
INSERT INTO lots (start_date, title, description, image, start_price, finish_date, step, count_favor, author_id, winner_id, category_id)
VALUES ("2018-05-09 12:15:10", "2014 Rossignol District Snowboard", "no description", "img/lot-1.jpg", 10999, "2018-06-30 12:15:10", 100, 1, 1, NULL, 1),
       ("2018-05-09 12:30:30", "DC Ply Mens 2016/2017 Snowboard", "no description", "img/lot-2.jpg", 159999, "2018-06-30 12:30:30", 100, 1, 1, NULL, 2),
       ("2018-05-09 12:45:10", "Крепления Union Contact Pro 2015 года размер L/XL", "no description", "img/lot-3.jpg", 8000, "2018-06-30 12:45:10", 100, 2, 1, NULL, 3),
       ("2018-05-09 14:10:25", "Ботинки для сноуборда DC Mutiny Charocal", "no description", "img/lot-4.jpg", 10999, "2018-06-30 14:10:25", 100, 3, 2, NULL, 4),
       ("2018-05-09 14:20:15", "Куртка для сноуборда DC Mutiny Charocal", "no description", "img/lot-5.jpg", 7500, "2018-06-30 14:20:15", 100, 4, 2, NULL, 5),
       ("2018-05-09 14:50:45", "Маска Oakley Canopy", "no description", "img/lot-6.jpg", 5400, "2018-06-30 14:50:45", 100, 6, 2, NULL, 6);


-- добавление ставок
INSERT INTO bets (date, current_price, user_id, lot_id)
VALUES ("2018-05-09 15:15:10", 15000, 1, 1),
       ("2018-05-09 17:25:30", 17500, 2, 1),
       ("2018-05-09 19:23:11", 275000, 2, 2),
       ("2018-05-09 16:15:45", 210000, 1, 2);