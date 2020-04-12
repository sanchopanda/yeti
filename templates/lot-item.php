<?php
session_start();
?>
<section class="lot-item container">
    <h2><?= $lot['title'] ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?= $lot['image'] ?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?= $lot['category_id'] ?></span></p>
            <p class="lot-item__description"><?= $lot['description'] ?> </p>
        </div>
        <div class="lot-item__right">
            <?php if ($_SESSION['user']) : ?>
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    10:54:12
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= $lot['bets_price'] ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= $lot['bets_price'] + $lot['step'] ?></span>
                    </div>
                </div>
                <form class="lot-item__form" action="lot.php" method="post">
                    <p class="lot-item__form-item">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="number" name="cost"
                            placeholder="<?= $lot['bets_price'] + $lot['step'] ?>">
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <?php endif; ?>
            <div class="history">
                <h3>История ставок (<span>10</span>)</h3>

                <table class="history__list">
                    <?php foreach ($bets as $key => $item) : ?>
                    <tr class="history__item">
                        <td class="history__name"><?= $item['name']; ?></td>
                        <td class="history__price"><?= $item['current_price']; ?> р</td>
                        <td class="history__time"><?= $item['date']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>
</section>