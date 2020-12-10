<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $model->title ?></title>
    <meta name="description" content="<?= $model->description ?>">

    <meta name="author" content="Sergei MILITER Tarasov https://htmlcssjs.pro">

    <link rel="preload" href="<?= $model->layoutCSS ?>" as="style">
    <link rel="preload" href="<?= $model->mainCSS ?>" as="style">
    <link rel="preload" href="<?= $model->mainJS ?>" as="script">

    <link rel="stylesheet" href="<?= $model->layoutCSS ?>">

</head>

<body>

    <?php if (DEV) {
        require 'D:\WebDevelopment\Projects\LIBS\scss\layout\design-grid\design-grid.php';
        // require VIEWS . '/layouts/designGrid.php';
    } ?>


    <header id="header" class="header">
        <?php require $model->header; ?>
    </header>


    <main id="main" class="main">
        <?php require $model->mainContent; ?>
    </main>


    <aside id="aside" class="aside">
        <?php require $model->aside; ?>
    </aside>


    <footer id="footer" class="footer">
        <?php require $model->footer; ?>
    </footer>


    <link rel="stylesheet" href="<?= $model->mainCSS ?>">

    <?php if ($model->pageCSS) : ?>
        <?php foreach ($model->pageCSS as $pageCSS) : ?>
            <link rel="stylesheet" href="<?= $pageCSS ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <script defer src="<?= $model->mainJS ?>"></script>

    <?php if ($model->pageJS) : ?>
        <?php foreach ($model->pageJS as $pageJS) : ?>
            <script defer src="<?= $pageJS ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>
