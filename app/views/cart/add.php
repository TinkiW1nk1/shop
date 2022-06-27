<?php /*session_destroy() */?>

<?php if(!empty($_SESSION['cart'])): ?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Фото</th>
            <th>Назва</th>
            <th>Кількість</th>
            <th>Ціна</th>
            <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <tr>
            <td><a href="product/<?= $item['alias']?>"</a><img src="images/<?php $item['img'] ?>" alt=""></td>
            <td><a href="product/<?= $item['alias']?>"</a><?= $item['title']?></td>
            <td><?= $item['qty']?></td>
            <td><?= $item['price']?></td>
            <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
        </tr>
        <?php endforeach; ?>
             <tr>
                <td>Ітого:</td>
                <td colspan="4" class="text-right cart-qty"><?=$_SESSION['cart.qty']?></td>
             </tr>
            <tr>
                <td>Сумма</td>
                <td colspan="4" class="text-right cart-sum"><?= $_SESSION['cart.sum']?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php else: ?>
<h3>Корзина пуста</h3>
<?php endif; ?>
