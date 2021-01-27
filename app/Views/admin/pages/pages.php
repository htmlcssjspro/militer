<h1><?= $Model->h1 ?></h1>
<section class="admin__pages">
    <?php foreach ($Model->pagesData as $pageData) : ?>
        <form action="/admin/api/updatesitemap" method="POST">
            <fieldset>
                <legend><?= $pageData['label'] ?></legend>
                <label>
                    <span>label</span>
                    <span><input type="text" name="label" value="<?= $pageData['label'] ?>"></span>
                </label>
                <label>
                    <span>page_url</span>
                    <span><input type="text" name="page_url" value="<?= $pageData['page_url'] ?>"></span>
                </label>
                <label>
                    <span>title</span>
                    <span><input type="text" name="title" value="<?= $pageData['title'] ?>"></span>
                </label>
                <label>
                    <span>description</span>
                    <span><input type="text" name="description" value="<?= $pageData['description'] ?>"></span>
                </label>
                <label>
                    <span>h1</span>
                    <span><input type="text" name="h1" value="<?= $pageData['h1'] ?>"></span>
                </label>
                <button type="submit">Обновить</button>
            </fieldset>
        </form>
    <?php endforeach; ?>
</section>
