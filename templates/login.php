<main>
    <form class="form container<?php if (count($errors)) {
                                    print(' form-invalid');
                                }; ?>" action="/login.php" method="post">
        <!-- form--invalid -->
        <h2>Вход</h2>
        <div class="form__item <?php if ($errors['email']) {
                                    print('form__item--invalid');
                                }; ?>">
            <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value='<?= $form['email']; ?>'>
            <span class="form__error"><?= $errors['email'] ?></span>
        </div>
        <div class="form__item form__item--last <?php if ($errors['password']) {
                                                    print('form__item--invalid');
                                                }; ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= $errors['password'] ?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>