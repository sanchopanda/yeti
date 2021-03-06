<form class="form container <?php if (count($errors)) {
                                print('form-invalid');
                            }; ?>" action="sign-up.php" method="post" enctype="multipart/form-data">
    <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?php if ($errors['email']) {
                                print('form__item--invalid');
                            }; ?>">
        <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value='<?= $newUser['email']; ?>'>
        <span class="form__error"><?php
                                    print($errors['email']);
                                    ?></span>
    </div>
    <div class="form__item <?php if ($errors['password']) {
                                print('form__item--invalid');
                            }; ?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль">
        <span class="form__error"><?php
                                    print($errors['password']);
                                    ?></span>
    </div>
    <div class="form__item <?php if ($errors['name']) {
                                print('form__item--invalid');
                            }; ?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value='<?= $newUser['name']; ?>'>
        <span class="form__error"><?php
                                    print($errors['name']);
                                    ?></span>
    </div>
    <div class="form__item <?php if ($errors['contact']) {
                                print('form__item--invalid');
                            }; ?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="contact" placeholder="Напишите как с вами связаться"
            value='<?= $newUser['contact']; ?>'></textarea>
        <span class="form__error"><?php
                                    print($errors['contact']);
                                    ?></span>
    </div>
    <div class="form__item form__item--file form__item--last <?php if ($errors['image']) {
                                                                    print('form__item--invalid');
                                                                } else if ($newUser['path']) {
                                                                    print('form__item--uploaded');
                                                                } ?>">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/<?php print($newUser['path']); ?>" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="image" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
            <span class="form__error"><?php
                                        print($errors['image']);
                                        ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>