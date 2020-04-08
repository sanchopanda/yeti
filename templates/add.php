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
                value='<?= $lot['lot-name']; ?>'>
            <span class="form__error"><?php
                                        print($errors['lot-name']);
                                        ?></span>
        </div>
        <div class="form__item">
            <label for="category">Категория</label>
            <select id="category" name="category">
                <?php foreach ($categories as $key => $cat) : ?>
                <option><?= $cat['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide <?php if ($errors['message']) {
                                                print('form__item--invalid');
                                            }; ?>">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"><?= $lot['message']; ?></textarea>
        <span class="form__error"><?php
                                    print($errors['message']);
                                    ?></span>
    </div>
    <div class="form__item form__item--file <?php if ($errors['lot-image']) {
                                                print('form__item--invalid');
                                            } else if ($lot['path']) {
                                                print('form__item--uploaded');
                                            } ?>">
        <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/<?php print($lot['path']); ?>" width="113" height="113" alt="Изображение лота">
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
        <div class="form__item form__item--small <?php if ($errors['lot-rate']) {
                                                        print('form__item--invalid');
                                                    }; ?>">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?php if (is_numeric($lot['lot-rate'])) {
                                                                                            print($lot['lot-rate']);
                                                                                        } ?>">
            <span class="form__error"><?php
                                        print($errors['lot-rate']);
                                        ?></span>
        </div>
        <div class="form__item form__item--small <?php if ($errors['lot-step']) {
                                                        print('form__item--invalid');
                                                    }; ?>">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?php if (is_numeric($lot['lot-step'])) {
                                                                                            print($lot['lot-step']);
                                                                                        } ?>">
            <span class="form__error"><?php
                                        print($errors['lot-step']);
                                        ?></span>
        </div>
        <div class="form__item <?php if ($errors['lot-date']) {
                                    print('form__item--invalid');
                                }; ?>">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date">
            <span class="form__error"><?php
                                        print($errors['lot-date']);
                                        ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>