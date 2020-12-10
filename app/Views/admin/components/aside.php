<?php foreach ($model->adminAsideData as $link) : ?>
    <a href="<?= $link['page_url'] ?>"><?= $link['label'] ?></a>
<?php endforeach; ?>
