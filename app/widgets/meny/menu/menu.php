<li>
    <a href="?id=<?= $id; ?>"><?= $category['title']; ?></a>
    <?php if(isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHTML($category['childs']); ?>
        </ul>
    <?php endif; ?>
</li>