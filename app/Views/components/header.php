<?php
?>

<div class="header__wrapper">
    <a class="header__logo" href="/"></a>
    <nav class="header__nav">
        <?php foreach ($model->headerNav as $link) : ?>
            <a class="header__link" href="<?= $link['page_url'] ?>"><?= $link['label'] ?></a>
        <?php endforeach; ?>
    </nav>

        <div class="town-selector">
            Город
            <select name="town" id="town-select">
                <?php foreach ($model->townsList as $town) : ?>
                    <option value="<?= $town ?>" <?= $town === $_SESSION['town'] ? 'selected' : '' ?>>
                        <?= $town ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if ($model->guest) : ?>
            <button class="btn_enter" type="button" data-popup=".login">Войти</button>
        <?php else : ?>
            <div class="user">
                <span>Привет <strong><?= $model->userData['username'] ?></strong>!</span>
                <div class="user__preferences">
                    <span>Баланс: <?= $model->userData['balance'] ?> р.</span>
                    <a href="/user">Личный кабинет</a>
                    <?php if ($model->organizator) : ?>
                        <a href="/user#purchases">Мои закупки</a>
                    <?php endif; ?>
                    <a href="/user#orders">Мои заказы</a>
                    <a href="/user#profile">Личная информация</a>
                    <button class="btn_logout" type="button" data-href="/api/logout">Выйти</button>
                </div>
            </div>
        <?php endif; ?>
</div>
