<form class="form form--add-lot container <?php if (count($errors)) {
                                                print('form-invalid');
                                            }; ?>" action="add.php" method="post" enctype="multipart/form-data">

    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?php if ($errors['lot-name']) {
                                    print('form__item--invalid');
                                }; ?>">
            <!-- form__item--invalid -->
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота"
                value='<?= $lot_member['name']; ?>'>
            <span class="form__error"><?php
                                        print($errors['lot-name']);
                                        ?></span>
        </div>
        <div class="form__item">
            <label for="category">Категория</label>
            <select id="category" name="category">
                <?php $index = 0;
                while ($index < count($categories)) : ?>
                <option><?= $categories[$index]; ?></option>
                <?php $index = $index + 1; ?>
                <?php endwhile; ?>
            </select>
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide <?php if ($errors['message']) {
                                                print('form__item--invalid');
                                            }; ?>">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"></textarea>
        <span class="form__error"><?php
                                    print($errors['lot-name']);
                                    ?></span>
    </div>
    <div class="form__item form__item--file <?php if ($errors['lot-image']) {
                                                print('form__item--invalid');
                                            } else if($path){
                                                print('form__item--uploaded');
                                            } ?>">
        <!-- form__item--uploaded -->
        <label>Изображение <?php print($path); ?></label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/<?php print($path); ?>" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="lot-image" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
            <span class="form__error"><?php
                                        print($errors['lot-image']);
                                        ?></span>
        </div>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0">
            <span class="form__error">Введите начальную цену</span>
        </div>
        <div class="form__item form__item--small">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0">
            <span class="form__error">Введите шаг ставки</span>
        </div>
        <div class="form__item">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date">
            <span class="form__error">Введите дату завершения торгов</span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>