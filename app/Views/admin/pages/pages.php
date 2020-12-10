<secction class="admin__pages">
    AdminPages


    <?php foreach($model->pagesData as $pageData): ?>
    <form>
        <input type="text" name="url" value="<?= $pageData['label'] ?>">
        <input type="text" name="page_url" value="<?= $pageData['page_url'] ?>">
        <input type="text" name="title" value="<?= $pageData['title'] ?>">
        <input type="text" name="description" value="<?= $pageData['description'] ?>">
    </form>
    <?php endforeach; ?>
</secction>
